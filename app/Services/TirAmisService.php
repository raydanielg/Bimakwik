<?php

namespace App\Services;

use App\Models\TirAmisReport;
use App\Models\TirAmisIntegrationLog;
use App\Models\Claim;
use App\Models\CustomerPolicy;
use App\Services\CommissionService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class TirAmisService
{
    protected string $baseUrl;
    protected string $clientCode;
    protected string $clientKey;
    protected string $companyCode;
    protected string $systemCode;
    protected string $callbackUrl;
    protected bool $enabled;
    protected bool $signEnabled;
    protected string $certPath;
    protected string $certPassword;
    protected int $timeout;

    public function __construct()
    {
        $config = config('tiramis');
        $mode = $config['mode'] ?? 'sandbox';
        $this->enabled = $config['enabled'] ?? false;
        $this->baseUrl = $config['endpoints'][$mode] ?? '';
        $this->clientCode = $config['client']['code'] ?? '';
        $this->clientKey = $config['client']['key'] ?? '';
        $this->companyCode = $config['client']['company_code'] ?? '';
        $this->systemCode = $config['client']['system_code'] ?? '';
        $this->callbackUrl = $config['client']['callback_url'] ?? route('tiramis.callback');
        $this->signEnabled = $config['digital_signature']['enabled'] ?? false;
        $this->certPath = $config['digital_signature']['cert_path'] ?? '';
        $this->certPassword = $config['digital_signature']['cert_password'] ?? '';
        $this->timeout = $config['timeout'] ?? 60;
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    // ==================== COVER NOTE (Non-Life, Non-Motor) ====================

    public function submitCoverNote(array $data, string $companyCode, ?string $salesCode = null): array
    {
        $requestId = 'REQ-' . strtoupper(Str::random(12));
        $xml = $this->buildCoverNoteRefReq($requestId, $data);
        return $this->send($requestId, 'CoverNoteRefReq', $xml, $companyCode, $salesCode, 'covernote');
    }

    // ==================== MOTOR COVER NOTE (Non-Fleet) ====================

    public function submitMotorCoverNote(array $data, string $companyCode, ?string $salesCode = null): array
    {
        $requestId = 'REQ-' . strtoupper(Str::random(12));
        $xml = $this->buildMotorCoverNoteRefReq($requestId, $data);
        return $this->send($requestId, 'MotorCoverNoteRefReq', $xml, $companyCode, $salesCode, 'motor_covernote');
    }

    // ==================== CLAIM NOTIFICATION ====================

    public function submitClaimNotification(Claim $claim, string $companyCode, ?string $salesCode = null): array
    {
        $requestId = 'REQ-' . strtoupper(Str::random(12));
        $xml = $this->buildClaimNotificationRefReq($requestId, $claim);
        return $this->send($requestId, 'ClaimNotificationRefReq', $xml, $companyCode, $salesCode, 'claim_notification', $claim);
    }

    // ==================== CLAIM INTIMATION ====================

    public function submitClaimIntimation(Claim $claim, array $extra = []): array
    {
        $requestId = 'REQ-' . strtoupper(Str::random(12));
        $xml = $this->buildClaimIntimationReq($requestId, $claim, $extra);
        $companyCode = $claim->policy?->insurer?->company_code ?? $this->companyCode;
        return $this->send($requestId, 'ClaimIntimationReq', $xml, $companyCode, null, 'claim_intimation', $claim);
    }

    // ==================== POLICY SUBMISSION ====================

    public function submitPolicy(CustomerPolicy $policy, array $coverNoteRefs): array
    {
        $requestId = 'REQ-' . strtoupper(Str::random(12));
        $xml = $this->buildPolicyReq($requestId, $policy, $coverNoteRefs);
        $companyCode = $policy->insurer?->company_code ?? $this->companyCode;
        return $this->send($requestId, 'PolicyReq', $xml, $companyCode, null, 'policy');
    }

    // ==================== GENERIC SEND ====================

    protected function send(string $requestId, string $messageType, string $xmlContent, string $companyCode, ?string $salesCode, string $reportType, ?Claim $claim = null): array
    {
        $reportNumber = 'TIR-' . strtoupper(Str::random(16));

        $report = TirAmisReport::create([
            'claim_id' => $claim?->id,
            'company_code' => $companyCode,
            'sales_code' => $salesCode,
            'report_number' => $reportNumber,
            'report_type' => $reportType,
            'report_data' => $xmlContent,
            'status' => 'pending',
            'submitted_by_type' => 'system',
            'submitted_by_id' => null,
        ]);

        if (!$this->enabled) {
            $report->update(['status' => 'simulated', 'response_code' => 'TIRA001']);
            $this->log($messageType, $reportType, $report->id, $companyCode, $salesCode, 'simulated', $xmlContent, null, 200);
            return ['success' => true, 'simulated' => true, 'report' => $report, 'request_id' => $requestId];
        }

        try {
            $tiraMsg = $this->wrapMessage($xmlContent, $messageType);
            $signature = $this->signMessage($tiraMsg);

            $finalXml = $this->buildTiraMsg($messageType, $xmlContent, $signature);

            $response = Http::timeout($this->timeout)
                ->withHeaders($this->getHeaders())
                ->withBody($finalXml, 'application/xml')
                ->post($this->baseUrl);

            $statusCode = $response->status();
            $responseBody = $response->body();

            $parsed = $this->parseResponse($responseBody, $messageType . 'ReqAck');
            $ackStatus = $parsed['status_code'] ?? 'TIRA002';

            if ($ackStatus === 'TIRA001') {
                $report->update([
                    'status' => 'sent',
                    'sent_at' => now(),
                    'response_code' => $ackStatus,
                    'response_message' => $parsed['status_desc'] ?? 'Acknowledged',
                ]);
                $this->log($messageType, $reportType, $report->id, $companyCode, $salesCode, 'success', $finalXml, $responseBody, $statusCode);
                return ['success' => true, 'report' => $report, 'request_id' => $requestId, 'ack_id' => $parsed['ack_id'] ?? null];
            }

            $report->update([
                'status' => 'failed',
                'response_code' => $ackStatus,
                'response_message' => $parsed['status_desc'] ?? $responseBody,
            ]);
            $this->log($messageType, $reportType, $report->id, $companyCode, $salesCode, 'failed', $finalXml, $responseBody, $statusCode);
            return ['success' => false, 'report' => $report, 'error' => $parsed['status_desc'] ?? 'TIRAMIS rejected request'];

        } catch (\Exception $e) {
            $report->update(['status' => 'failed', 'response_message' => $e->getMessage()]);
            $this->log($messageType, $reportType, $report->id, $companyCode, $salesCode, 'error', $xmlContent, ['error' => $e->getMessage()], 0);
            Log::error("TIRAMIS $messageType failed: " . $e->getMessage());
            return ['success' => false, 'report' => $report, 'error' => $e->getMessage()];
        }
    }

    // ==================== MESSAGE WRAPPING ====================

    protected function buildTiraMsg(string $messageType, string $content, string $signature): string
    {
        $xml = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
        $xml .= "<TiraMsg>\n";
        $xml .= $content;
        $xml .= "<MsgSignature>$signature</MsgSignature>\n";
        $xml .= "</TiraMsg>";
        return $xml;
    }

    protected function wrapMessage(string $innerXml, string $messageType): string
    {
        return "<$messageType>\n$innerXml\n</$messageType>";
    }

    // ==================== DIGITAL SIGNATURE ====================

    protected function signMessage(string $data): string
    {
        if (!$this->signEnabled || !file_exists($this->certPath)) {
            return base64_encode('SIMULATED_SIGNATURE_' . md5($data));
        }

        try {
            $certStore = file_get_contents($this->certPath);
            openssl_pkcs12_read($certStore, $certs, $this->certPassword);
            $privateKey = openssl_get_privatekey($certs['pkey'], $this->certPassword);
            $signature = '';
            openssl_sign($data, $signature, $privateKey, OPENSSL_ALGO_SHA1);
            openssl_free_key($privateKey);
            return base64_encode($signature);
        } catch (\Exception $e) {
            Log::error('TIRAMIS signing failed: ' . $e->getMessage());
            return base64_encode('SIGN_FAILED_' . md5($data));
        }
    }

    public function verifySignature(string $data, string $signature): bool
    {
        $pubKeyPath = config('tiramis.digital_signature.public_key_path');
        if (!file_exists($pubKeyPath)) return false;

        try {
            $pubKey = file_get_contents($pubKeyPath);
            $key = openssl_get_publickey($pubKey);
            $result = openssl_verify($data, base64_decode($signature), $key, OPENSSL_ALGO_SHA1);
            openssl_free_key($key);
            return $result === 1;
        } catch (\Exception $e) {
            return false;
        }
    }

    // ==================== HEADERS ====================

    protected function getHeaders(): array
    {
        return [
            'Content-Type' => 'application/xml',
            'ClientCode' => $this->clientCode,
            'ClientKey' => $this->clientKey,
        ];
    }

    // ==================== XML BUILDERS ====================

    protected function buildCoverNoteRefReq(string $requestId, array $data): string
    {
        $xml = "  <CoverNoteRefReq>\n";
        $xml .= "    <CoverNoteHdr>\n";
        $xml .= "      <RequestId>$requestId</RequestId>\n";
        $xml .= '      <CompanyCode>' . htmlspecialchars($this->clientCode) . "</CompanyCode>\n";
        $xml .= '      <SystemCode>' . htmlspecialchars($this->systemCode) . "</SystemCode>\n";
        $xml .= '      <CallBackUrl>' . htmlspecialchars($this->callbackUrl) . "</CallBackUrl>\n";
        $xml .= '      <InsurerCompanyCode>' . htmlspecialchars($data['insurer_company_code'] ?? $this->companyCode) . "</InsurerCompanyCode>\n";
        $xml .= '      <TranCompanyCode>' . htmlspecialchars($data['tran_company_code'] ?? $this->companyCode) . "</TranCompanyCode>\n";
        $xml .= '      <CoverNoteType>' . ($data['cover_note_type'] ?? '1') . "</CoverNoteType>\n";
        $xml .= "    </CoverNoteHdr>\n";
        $xml .= "    <CoverNoteDtl>\n";
        $xml .= '      <CoverNoteNumber>' . htmlspecialchars($data['cover_note_number'] ?? '') . "</CoverNoteNumber>\n";
        $xml .= '      <PrevCoverNoteReferenceNumber>' . htmlspecialchars($data['prev_ref'] ?? '') . "</PrevCoverNoteReferenceNumber>\n";
        $xml .= '      <SalePointCode>' . htmlspecialchars($data['sale_point_code'] ?? 'SP001') . "</SalePointCode>\n";
        $xml .= '      <CoverNoteStartDate>' . ($data['start_date'] ?? now()->format('Y-m-d\TH:i:s')) . "</CoverNoteStartDate>\n";
        $xml .= '      <CoverNoteEndDate>' . ($data['end_date'] ?? now()->addYear()->format('Y-m-d\T23:59:59')) . "</CoverNoteEndDate>\n";
        $xml .= '      <CoverNoteDesc>' . htmlspecialchars($data['description'] ?? '') . "</CoverNoteDesc>\n";
        $xml .= '      <OperativeClause>' . htmlspecialchars($data['operative_clause'] ?? '') . "</OperativeClause>\n";
        $xml .= '      <PaymentMode>' . ($data['payment_mode'] ?? '1') . "</PaymentMode>\n";
        $xml .= '      <CurrencyCode>' . ($data['currency'] ?? 'TZS') . "</CurrencyCode>\n";
        $xml .= '      <ExchangeRate>' . ($data['exchange_rate'] ?? '1.00') . "</ExchangeRate>\n";
        $xml .= '      <TotalPremiumExcludingTax>' . ($data['premium_excl_tax'] ?? '0.00') . "</TotalPremiumExcludingTax>\n";
        $xml .= '      <TotalPremiumIncludingTax>' . ($data['premium_incl_tax'] ?? '0.00') . "</TotalPremiumIncludingTax>\n";
        $xml .= '      <CommisionPaid>' . ($data['commission_paid'] ?? '0.00') . "</CommisionPaid>\n";
        $xml .= '      <CommisionRate>' . ($data['commission_rate'] ?? '0.00') . "</CommisionRate>\n";
        $xml .= '      <OfficerName>' . htmlspecialchars($data['officer_name'] ?? 'System') . "</OfficerName>\n";
        $xml .= '      <OfficerTitle>' . htmlspecialchars($data['officer_title'] ?? 'Underwriter') . "</OfficerTitle>\n";
        $xml .= '      <ProductCode>' . htmlspecialchars($data['product_code'] ?? '') . "</ProductCode>\n";
        $xml .= "    </CoverNoteDtl>\n";
        $xml .= "  </CoverNoteRefReq>\n";
        return $xml;
    }

    protected function buildMotorCoverNoteRefReq(string $requestId, array $data): string
    {
        $isFleet = !empty($data['fleet_id']);
        $root = "  <MotorCoverNoteRefReq>\n";
        $xml = $root;
        $xml .= "    <CoverNoteHdr>\n";
        $xml .= "      <RequestId>$requestId</RequestId>\n";
        $xml .= '      <CompanyCode>' . htmlspecialchars($this->clientCode) . "</CompanyCode>\n";
        $xml .= '      <SystemCode>' . htmlspecialchars($this->systemCode) . "</SystemCode>\n";
        $xml .= '      <CallBackUrl>' . htmlspecialchars($this->callbackUrl) . "</CallBackUrl>\n";
        $xml .= '      <InsurerCompanyCode>' . htmlspecialchars($data['insurer_company_code'] ?? $this->companyCode) . "</InsurerCompanyCode>\n";
        $xml .= '      <TranCompanyCode>' . htmlspecialchars($data['tran_company_code'] ?? $this->companyCode) . "</TranCompanyCode>\n";
        $xml .= '      <CoverNoteType>' . ($data['cover_note_type'] ?? '1') . "</CoverNoteType>\n";
        $xml .= "    </CoverNoteHdr>\n";
        $xml .= "    <CoverNoteDtl>\n";

        if ($isFleet) {
            $xml .= "      <FleetHdr>\n";
            $xml .= '        <FleetId>' . htmlspecialchars($data['fleet_id']) . "</FleetId>\n";
            $xml .= '        <FleetType>' . ($data['fleet_type'] ?? '1') . "</FleetType>\n";
            $xml .= '        <FleetSize>' . ($data['fleet_size'] ?? '0') . "</FleetSize>\n";
            $xml .= '        <ComprehensiveInsured>' . ($data['comprehensive_insured'] ?? '0') . "</ComprehensiveInsured>\n";
            $xml .= '        <SalePointCode>' . htmlspecialchars($data['sale_point_code'] ?? 'SP001') . "</SalePointCode>\n";
            $xml .= '        <CoverNoteStartDate>' . ($data['start_date'] ?? now()->format('Y-m-d\TH:i:s')) . "</CoverNoteStartDate>\n";
            $xml .= '        <CoverNoteEndDate>' . ($data['end_date'] ?? now()->addYear()->format('Y-m-d\T23:59:59')) . "</CoverNoteEndDate>\n";
            $xml .= '        <PaymentMode>' . ($data['payment_mode'] ?? '1') . "</PaymentMode>\n";
            $xml .= '        <CurrencyCode>' . ($data['currency'] ?? 'TZS') . "</CurrencyCode>\n";
            $xml .= '        <ExchangeRate>' . ($data['exchange_rate'] ?? '1.00') . "</ExchangeRate>\n";
            $xml .= '        <TotalPremiumExcludingTax>' . ($data['premium_excl_tax'] ?? '0.00') . "</TotalPremiumExcludingTax>\n";
            $xml .= '        <TotalPremiumIncludingTax>' . ($data['premium_incl_tax'] ?? '0.00') . "</TotalPremiumIncludingTax>\n";
            $xml .= '        <CommisionPaid>' . ($data['commission_paid'] ?? '0.00') . "</CommisionPaid>\n";
            $xml .= '        <CommisionRate>' . ($data['commission_rate'] ?? '0.00') . "</CommisionRate>\n";
            $xml .= '        <OfficerName>' . htmlspecialchars($data['officer_name'] ?? 'System') . "</OfficerName>\n";
            $xml .= '        <OfficerTitle>' . htmlspecialchars($data['officer_title'] ?? 'Underwriter') . "</OfficerTitle>\n";
            $xml .= '        <ProductCode>' . htmlspecialchars($data['product_code'] ?? '') . "</ProductCode>\n";
            $xml .= "      </FleetHdr>\n";
        } else {
            $xml .= '      <CoverNoteNumber>' . htmlspecialchars($data['cover_note_number'] ?? '') . "</CoverNoteNumber>\n";
            $xml .= '      <PrevCoverNoteReferenceNumber>' . htmlspecialchars($data['prev_ref'] ?? '') . "</PrevCoverNoteReferenceNumber>\n";
            $xml .= '      <SalePointCode>' . htmlspecialchars($data['sale_point_code'] ?? 'SP001') . "</SalePointCode>\n";
            $xml .= '      <CoverNoteStartDate>' . ($data['start_date'] ?? now()->format('Y-m-d\TH:i:s')) . "</CoverNoteStartDate>\n";
            $xml .= '      <CoverNoteEndDate>' . ($data['end_date'] ?? now()->addYear()->format('Y-m-d\T23:59:59')) . "</CoverNoteEndDate>\n";
            $xml .= '      <CoverNoteDesc>' . htmlspecialchars($data['description'] ?? '') . "</CoverNoteDesc>\n";
            $xml .= '      <OperativeClause>' . htmlspecialchars($data['operative_clause'] ?? '') . "</OperativeClause>\n";
            $xml .= '      <PaymentMode>' . ($data['payment_mode'] ?? '1') . "</PaymentMode>\n";
            $xml .= '      <CurrencyCode>' . ($data['currency'] ?? 'TZS') . "</CurrencyCode>\n";
            $xml .= '      <ExchangeRate>' . ($data['exchange_rate'] ?? '1.00') . "</ExchangeRate>\n";
            $xml .= '      <TotalPremiumExcludingTax>' . ($data['premium_excl_tax'] ?? '0.00') . "</TotalPremiumExcludingTax>\n";
            $xml .= '      <TotalPremiumIncludingTax>' . ($data['premium_incl_tax'] ?? '0.00') . "</TotalPremiumIncludingTax>\n";
            $xml .= '      <CommisionPaid>' . ($data['commission_paid'] ?? '0.00') . "</CommisionPaid>\n";
            $xml .= '      <CommisionRate>' . ($data['commission_rate'] ?? '0.00') . "</CommisionRate>\n";
            $xml .= '      <OfficerName>' . htmlspecialchars($data['officer_name'] ?? 'System') . "</OfficerName>\n";
            $xml .= '      <OfficerTitle>' . htmlspecialchars($data['officer_title'] ?? 'Underwriter') . "</OfficerTitle>\n";
            $xml .= '      <ProductCode>' . htmlspecialchars($data['product_code'] ?? '') . "</ProductCode>\n";
        }

        if (!empty($data['motor'])) {
            $xml .= "      <MotorDtl>\n";
            $xml .= '        <MotorCategory>' . ($data['motor']['category'] ?? '1') . "</MotorCategory>\n";
            $xml .= '        <MotorType>' . ($data['motor']['type'] ?? '1') . "</MotorType>\n";
            $xml .= '        <RegistrationNumber>' . htmlspecialchars($data['motor']['registration'] ?? '') . "</RegistrationNumber>\n";
            $xml .= '        <ChassisNumber>' . htmlspecialchars($data['motor']['chassis'] ?? '') . "</ChassisNumber>\n";
            $xml .= '        <Make>' . htmlspecialchars($data['motor']['make'] ?? '') . "</Make>\n";
            $xml .= '        <Model>' . htmlspecialchars($data['motor']['model'] ?? '') . "</Model>\n";
            $xml .= '        <ModelNumber>' . htmlspecialchars($data['motor']['model_number'] ?? '') . "</ModelNumber>\n";
            $xml .= '        <BodyType>' . htmlspecialchars($data['motor']['body_type'] ?? '') . "</BodyType>\n";
            $xml .= '        <Color>' . htmlspecialchars($data['motor']['color'] ?? '') . "</Color>\n";
            $xml .= '        <EngineNumber>' . htmlspecialchars($data['motor']['engine_number'] ?? '') . "</EngineNumber>\n";
            $xml .= '        <EngineCapacity>' . htmlspecialchars($data['motor']['engine_capacity'] ?? '') . "</EngineCapacity>\n";
            $xml .= '        <FuelUsed>' . htmlspecialchars($data['motor']['fuel'] ?? '') . "</FuelUsed>\n";
            $xml .= '        <NumberOfAxles>' . ($data['motor']['axles'] ?? '') . "</NumberOfAxles>\n";
            $xml .= '        <SittingCapacity>' . ($data['motor']['sitting_capacity'] ?? '') . "</SittingCapacity>\n";
            $xml .= '        <YearOfManufacture>' . ($data['motor']['year'] ?? '') . "</YearOfManufacture>\n";
            $xml .= '        <TareWeight>' . ($data['motor']['tare_weight'] ?? '') . "</TareWeight>\n";
            $xml .= '        <GrossWeight>' . ($data['motor']['gross_weight'] ?? '') . "</GrossWeight>\n";
            $xml .= '        <MotorUsage>' . ($data['motor']['usage'] ?? '1') . "</MotorUsage>\n";
            $xml .= '        <OwnerName>' . htmlspecialchars($data['motor']['owner_name'] ?? '') . "</OwnerName>\n";
            $xml .= '        <OwnerCategory>' . ($data['motor']['owner_category'] ?? '1') . "</OwnerCategory>\n";
            $xml .= '        <OwnerAddress>' . htmlspecialchars($data['motor']['owner_address'] ?? '') . "</OwnerAddress>\n";
            $xml .= "      </MotorDtl>\n";
        }

        $xml .= "    </CoverNoteDtl>\n";
        $xml .= "  </MotorCoverNoteRefReq>\n";
        return $xml;
    }

    protected function buildClaimNotificationRefReq(string $requestId, Claim $claim): string
    {
        $policy = $claim->policy;
        $xml = "  <ClaimNotificationRefReq>\n";
        $xml .= "    <ClaimNotificationHdr>\n";
        $xml .= "      <RequestId>$requestId</RequestId>\n";
        $xml .= '      <CompanyCode>' . htmlspecialchars($this->clientCode) . "</CompanyCode>\n";
        $xml .= '      <SystemCode>' . htmlspecialchars($this->systemCode) . "</SystemCode>\n";
        $xml .= '      <CallBackUrl>' . htmlspecialchars($this->callbackUrl) . "</CallBackUrl>\n";
        $xml .= '      <InsurerCompanyCode>' . htmlspecialchars($this->companyCode) . "</InsurerCompanyCode>\n";
        $xml .= '      <TranCompanyCode>' . htmlspecialchars($this->companyCode) . "</TranCompanyCode>\n";
        $xml .= "    </ClaimNotificationHdr>\n";
        $xml .= "    <ClaimNotificationDtl>\n";
        $xml .= '      <ClaimNotificationNumber>' . htmlspecialchars($claim->claim_number ?? 'CLM-' . $claim->id) . "</ClaimNotificationNumber>\n";
        $xml .= '      <CoverNoteReferenceNumber>' . htmlspecialchars($policy?->cover_note_ref ?? '') . "</CoverNoteReferenceNumber>\n";
        $xml .= '      <ClaimReportDate>' . ($claim->created_at->format('Y-m-d\TH:i:s')) . "</ClaimReportDate>\n";
        $xml .= '      <ClaimFormDullyFilled>Y</ClaimFormDullyFilled>';
        $xml .= '      <LossDate>' . ($claim->accident_date?->format('Y-m-d\TH:i:s') ?? $claim->created_at->format('Y-m-d\TH:i:s')) . "</LossDate>\n";
        $xml .= '      <LossNature>' . htmlspecialchars($claim->loss_nature ?? $claim->description ?? '') . "</LossNature>\n";
        $xml .= '      <LossType>' . htmlspecialchars($claim->loss_type ?? $claim->claim_type ?? '') . "</LossType>\n";
        $xml .= '      <LossLocation>' . htmlspecialchars($claim->loss_location ?? '') . "</LossLocation>\n";
        $xml .= '      <OfficerName>System</OfficerName>';
        $xml .= '      <OfficerTitle>System</OfficerTitle>';
        $xml .= "    </ClaimNotificationDtl>\n";
        $xml .= "  </ClaimNotificationRefReq>\n";
        return $xml;
    }

    protected function buildClaimIntimationReq(string $requestId, Claim $claim, array $extra): string
    {
        $xml = "  <ClaimIntimationReq>\n";
        $xml .= "    <ClaimIntimationHdr>\n";
        $xml .= "      <RequestId>$requestId</RequestId>\n";
        $xml .= '      <CompanyCode>' . htmlspecialchars($this->clientCode) . "</CompanyCode>\n";
        $xml .= '      <SystemCode>' . htmlspecialchars($this->systemCode) . "</SystemCode>\n";
        $xml .= '      <CallBackUrl>' . htmlspecialchars($this->callbackUrl) . "</CallBackUrl>\n";
        $xml .= '      <InsurerCompanyCode>' . htmlspecialchars($this->companyCode) . "</InsurerCompanyCode>\n";
        $xml .= "    </ClaimIntimationHdr>\n";
        $xml .= "    <ClaimIntimationDtl>\n";
        $xml .= '      <ClaimIntimationNumber>' . htmlspecialchars($extra['intimation_number'] ?? 'INT-' . $claim->id) . "</ClaimIntimationNumber>\n";
        $xml .= '      <ClaimReferenceNumber>' . htmlspecialchars($extra['claim_ref'] ?? '') . "</ClaimReferenceNumber>\n";
        $xml .= '      <CoverNoteReferenceNumber>' . htmlspecialchars($extra['cover_note_ref'] ?? '') . "</CoverNoteReferenceNumber>\n";
        $xml .= '      <ClaimIntimationDate>' . now()->format('Y-m-d\TH:i:s') . "</ClaimIntimationDate>\n";
        $xml .= '      <CurrencyCode>TZS</CurrencyCode>';
        $xml .= '      <ExchangeRate>1.00</ExchangeRate>';
        $xml .= '      <ClaimEstimatedAmount>' . ($claim->claimed_amount ?? '0.00') . "</ClaimEstimatedAmount>\n";
        $xml .= '      <ClaimReserveAmount>' . ($extra['reserve_amount'] ?? $claim->claimed_amount ?? '0.00') . "</ClaimReserveAmount>\n";
        $xml .= '      <ClaimReserveMethod>Chain Ladder</ClaimReserveMethod>';
        $xml .= '      <LossAssessmentOption>' . ($extra['assessment_option'] ?? '1') . "</LossAssessmentOption>\n";
        $xml .= "    </ClaimIntimationDtl>\n";
        $xml .= "  </ClaimIntimationReq>\n";
        return $xml;
    }

    protected function buildPolicyReq(string $requestId, CustomerPolicy $policy, array $coverNoteRefs): string
    {
        $xml = "  <PolicyReq>\n";
        $xml .= "    <PolicyHdr>\n";
        $xml .= "      <RequestId>$requestId</RequestId>\n";
        $xml .= '      <CompanyCode>' . htmlspecialchars($this->clientCode) . "</CompanyCode>\n";
        $xml .= '      <SystemCode>' . htmlspecialchars($this->systemCode) . "</SystemCode>\n";
        $xml .= '      <CallBackUrl>' . htmlspecialchars($this->callbackUrl) . "</CallBackUrl>\n";
        $xml .= '      <InsurerCompanyCode>' . htmlspecialchars($this->companyCode) . "</InsurerCompanyCode>\n";
        $xml .= "    </PolicyHdr>\n";
        $xml .= "    <PolicyDtl>\n";
        $xml .= '      <PolicyNumber>' . htmlspecialchars($policy->policy_number ?? 'POL-' . $policy->id) . "</PolicyNumber>\n";
        $xml .= '      <PolicyOperativeClause>' . htmlspecialchars($policy->operative_clause ?? '') . "</PolicyOperativeClause>\n";
        $xml .= '      <SpecialConditions>' . htmlspecialchars($policy->special_conditions ?? '') . "</SpecialConditions>\n";
        $xml .= '      <Exclusions>' . htmlspecialchars($policy->exclusions ?? '') . "</Exclusions>\n";
        $xml .= "      <AppliedCoverNotes>\n";
        foreach ($coverNoteRefs as $ref) {
            $xml .= '        <CoverNoteReferenceNumber>' . htmlspecialchars($ref) . "</CoverNoteReferenceNumber>\n";
        }
        $xml .= "      </AppliedCoverNotes>\n";
        $xml .= "    </PolicyDtl>\n";
        $xml .= "  </PolicyReq>\n";
        return $xml;
    }

    // ==================== RESPONSE PARSING ====================

    protected function parseResponse(string $xml, string $expectedRoot): array
    {
        $result = ['status_code' => 'TIRA002', 'status_desc' => 'Failed to parse response'];

        try {
            $sxml = simplexml_load_string($xml);
            if (!$sxml) return $result;

            $children = $sxml->children();
            foreach ($children as $child) {
                $name = $child->getName();
                if (str_contains($name, 'Ack')) {
                    $result['ack_id'] = (string) $child->AcknowledgementId;
                    $result['status_code'] = (string) $child->AcknowledgementStatusCode;
                    $result['status_desc'] = (string) $child->AcknowledgementStatusDesc;
                } elseif (str_contains($name, 'Res')) {
                    $result['response_id'] = (string) $child->ResponseId;
                    $result['status_code'] = (string) $child->ResponseStatusCode;
                    $result['status_desc'] = (string) $child->ResponseStatusDesc;
                    if (isset($child->CoverNoteReferenceNumber)) {
                        $result['cover_note_ref'] = (string) $child->CoverNoteReferenceNumber;
                    }
                    if (isset($child->StickerNumber)) {
                        $result['sticker_number'] = (string) $child->StickerNumber;
                    }
                    if (isset($child->ClaimReferenceNumber)) {
                        $result['claim_ref'] = (string) $child->ClaimReferenceNumber;
                    }
                }
            }
        } catch (\Exception $e) {
            Log::warning('TIRAMIS XML parse error: ' . $e->getMessage());
        }

        return $result;
    }

    public function handleCallback(string $xml): array
    {
        try {
            $sxml = simplexml_load_string($xml);
            if (!$sxml) return ['success' => false, 'error' => 'Invalid XML'];

            $children = $sxml->children();
            foreach ($children as $child) {
                $name = $child->getName();
                if (!str_contains($name, 'Res') || str_contains($name, 'Ack')) continue;

                $reportNumber = (string) $child->CoverNoteReferenceNumber;
                $statusCode = (string) $child->ResponseStatusCode;
                $statusDesc = (string) $child->ResponseStatusDesc;

                $report = TirAmisReport::where('report_number', $reportNumber)->first();
                if ($report) {
                    $report->update([
                        'status' => $statusCode === 'TIRA001' ? 'sent' : 'failed',
                        'response_code' => $statusCode,
                        'response_message' => $statusDesc,
                    ]);
                }

                $ackXml = $this->buildCallbackAck($name, (string) $child->ResponseId);

                return [
                    'success' => $statusCode === 'TIRA001',
                    'report' => $report,
                    'status_code' => $statusCode,
                    'status_desc' => $statusDesc,
                    'ack_xml' => $ackXml,
                ];
            }

            return ['success' => false, 'error' => 'No response element found'];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    protected function buildCallbackAck(string $responseType, string $responseId): string
    {
        $ackType = str_replace('Res', 'ResAck', $responseType);
        $ackId = 'ACK-' . strtoupper(Str::random(12));

        $xml = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
        $xml .= "<TiraMsg>\n";
        $xml .= "  <$ackType>\n";
        $xml .= "    <AcknowledgementId>$ackId</AcknowledgementId>\n";
        $xml .= "    <ResponseId>$responseId</ResponseId>\n";
        $xml .= "    <AcknowledgementStatusCode>TIRA001</AcknowledgementStatusCode>\n";
        $xml .= "    <AcknowledgementStatusDesc>Successful</AcknowledgementStatusDesc>\n";
        $xml .= "  </$ackType>\n";
        $xml .= "  <MsgSignature>" . base64_encode('ACK_' . md5($responseId)) . "</MsgSignature>\n";
        $xml .= "</TiraMsg>";

        return $xml;
    }

    // ==================== LOGGING ====================

    protected function log(string $action, string $entityType, $entityId, ?string $companyCode, ?string $salesCode, string $status, $requestPayload, $responsePayload, ?int $httpCode): void
    {
        try {
            TirAmisIntegrationLog::create([
                'action' => $action,
                'entity_type' => $entityType,
                'entity_id' => $entityId,
                'company_code' => $companyCode,
                'sales_code' => $salesCode,
                'status' => $status,
                'request_payload' => is_string($requestPayload) ? $requestPayload : json_encode($requestPayload),
                'response_payload' => $responsePayload ? (is_string($responsePayload) ? $responsePayload : json_encode($responsePayload)) : null,
                'http_status_code' => $httpCode,
                'ip_address' => request()->ip(),
            ]);
        } catch (\Exception $e) {
            Log::warning('Failed to log TIRAMIS integration: ' . $e->getMessage());
        }
    }

    // ==================== SUBMIT POLICY COVER NOTE TO TIRA ====================

    public function submitPolicyCoverNote(\App\Models\CustomerPolicy $policy): array
    {
        $companyCode = $policy->company_code ?? $this->companyCode;
        $salePointCode = $policy->sale_point_code ?? 'SP001';
        $insurer = $policy->insurer;

        // Calculate commission from policy's commission transactions
        $totalCommission = $policy->commissionTransactions->sum('commission_amount');
        $commissionRate = 0;
        if ($policy->premium_amount > 0 && $totalCommission > 0) {
            $commissionRate = ($totalCommission / $policy->premium_amount) * 100;
        }

        $data = [
            'cover_note_type' => '1',
            'cover_note_number' => $policy->policy_number ?? 'POL-' . $policy->id,
            'sale_point_code' => $salePointCode,
            'start_date' => $policy->start_date?->format('Y-m-d\TH:i:s') ?? now()->format('Y-m-d\TH:i:s'),
            'end_date' => $policy->end_date?->format('Y-m-d\T23:59:59') ?? now()->addYear()->format('Y-m-d\T23:59:59'),
            'description' => 'Policy cover note for ' . ($policy->product?->product_name ?? 'Insurance'),
            'operative_clause' => 'Standard cover',
            'payment_mode' => '1',
            'currency' => 'TZS',
            'exchange_rate' => '1.00',
            'premium_excl_tax' => (string) ($policy->premium_amount ?? 0),
            'premium_incl_tax' => (string) ($policy->premium_amount ?? 0),
            'commission_paid' => number_format($totalCommission, 2, '.', ''),
            'commission_rate' => number_format($commissionRate, 2, '.', ''),
            'officer_name' => 'System',
            'officer_title' => 'System',
            'product_code' => $policy->product?->product_code ?? '',
            'insurer_company_code' => $insurer?->company_code ?? $companyCode,
            'tran_company_code' => $companyCode,
        ];

        $salesCode = $policy->agent?->sales_code ?? $policy->broker?->sales_code ?? null;

        return $this->submitCoverNote($data, $companyCode, $salesCode);
    }

    // ==================== BACKWARD COMPAT: Submit Claim ====================

    public function submitClaim(Claim $claim, string $companyCode, ?string $salesCode = null): array
    {
        return $this->submitClaimNotification($claim, $companyCode, $salesCode);
    }

    public function submitBatchClaims(array $claimIds, string $companyCode): array
    {
        $results = [];
        foreach ($claimIds as $id) {
            $claim = Claim::find($id);
            if ($claim) {
                $results[] = $this->submitClaimNotification($claim, $companyCode);
            }
        }
        return $results;
    }

    public function checkReportStatus(string $reportNumber): ?TirAmisReport
    {
        if (!$this->enabled) return null;

        try {
            $response = Http::timeout($this->timeout)
                ->withHeaders($this->getHeaders())
                ->get($this->baseUrl . '/reports/' . $reportNumber . '/status');

            if ($response->successful()) {
                $parsed = $this->parseResponse($response->body(), 'StatusRes');
                $report = TirAmisReport::where('report_number', $reportNumber)->first();
                if ($report && isset($parsed['status_code'])) {
                    $report->update([
                        'status' => $parsed['status_code'] === 'TIRA001' ? 'sent' : 'failed',
                        'response_code' => $parsed['status_code'],
                        'response_message' => $parsed['status_desc'],
                    ]);
                }
                return $report;
            }
        } catch (\Exception $e) {
            Log::error('TIRAMIS status check failed: ' . $e->getMessage());
        }
        return null;
    }
}

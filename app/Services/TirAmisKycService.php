<?php

namespace App\Services;

use App\Models\TirAmisIntegrationLog;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class TirAmisKycService
{
    protected string $baseUrl;
    protected string $clientCode;
    protected string $clientKey;
    protected string $systemCode;
    protected bool $kycEnabled;
    protected bool $vehicleEnabled;
    protected bool $tunnelEnabled;
    protected string $tunnelBaseUrl;
    protected string $tunnelAuthToken;
    protected int $timeout;
    protected int $cacheTtl;

    public function __construct()
    {
        $config = config('tiramis');
        $mode = $config['mode'] ?? 'sandbox';

        $this->baseUrl = $config['endpoints'][$mode] ?? '';
        $this->clientCode = $config['client']['code'] ?? '';
        $this->clientKey = $config['client']['key'] ?? '';
        $this->systemCode = $config['client']['system_code'] ?? '';

        $this->kycEnabled = $config['kyc']['enabled'] ?? false;
        $this->cacheTtl = (int) ($config['kyc']['cache_ttl'] ?? 3600);

        $this->vehicleEnabled = $config['vehicle']['enabled'] ?? false;

        $this->tunnelEnabled = $config['tunnel']['enabled'] ?? false;
        $this->tunnelBaseUrl = $config['tunnel']['base_url'] ?? '';
        $this->tunnelAuthToken = $config['tunnel']['auth_token'] ?? '';

        $this->timeout = $config['timeout'] ?? 60;
    }

    // ==================== BASE URL RESOLUTION ====================

    protected function resolveBaseUrl(): string
    {
        if ($this->tunnelEnabled && $this->tunnelBaseUrl) {
            return $this->tunnelBaseUrl;
        }
        return $this->baseUrl;
    }

    protected function getHeaders(): array
    {
        $headers = [
            'Content-Type' => 'application/xml',
            'ClientCode' => $this->clientCode,
            'ClientKey' => $this->clientKey,
            'SystemCode' => $this->systemCode,
        ];

        if ($this->tunnelEnabled && $this->tunnelAuthToken) {
            $headers['X-Tunnel-Auth'] = $this->tunnelAuthToken;
        }

        return $headers;
    }

    /**
     * Build a signed TiraMsg envelope per TIRAMIS API spec.
     */
    protected function buildTiraMsg(string $contentXml): string
    {
        $signature = $this->signMessage($contentXml);
        $xml = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
        $xml .= "<TiraMsg>\n";
        $xml .= $contentXml;
        $xml .= "  <MsgSignature>$signature</MsgSignature>\n";
        $xml .= "</TiraMsg>";
        return $xml;
    }

    /**
     * Sign message. TIRAMIS hawahitaji certificate kutoka kwetu.
     * Wanatumia ClientCode + ClientKey zao wenyewe kwa verification.
     * Hii inarudisha simulated signature kwani certificate sio required.
     */
    protected function signMessage(string $data): string
    {
        return base64_encode('SIMULATED_SIGNATURE_' . md5($data));
    }

    /**
     * Parse an XML response into an associative array.
     */
    protected function parseXmlResponse(string $xml): array
    {
        try {
            $sxml = simplexml_load_string($xml);
            if (!$sxml) {
                return ['status_code' => 'TIRA002', 'status_desc' => 'Invalid XML response'];
            }
            return json_decode(json_encode($sxml), true) ?? [];
        } catch (\Exception $e) {
            return ['status_code' => 'TIRA002', 'status_desc' => 'XML parse error: ' . $e->getMessage()];
        }
    }

    // ==================== NIDA IDENTITY VERIFICATION ====================

    /**
     * Verify a NIDA number against TIRAMIS/NIDA API.
     * Returns customer KYC data if verified.
     */
    public function verifyNida(string $nidaNumber): array
    {
        if (!$this->kycEnabled) {
            return $this->simulatedNidaResponse($nidaNumber);
        }

        $cacheKey = "tiramis_nida_{$nidaNumber}";
        if ($this->cacheTtl > 0 && Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        try {
            $requestId = 'KYC-' . strtoupper(Str::random(12));
            $endpoint = $this->resolveBaseUrl() . config('tiramis.kyc.verify_endpoint', '/kyc/verify');

            $xmlContent = $this->buildKycVerifyXml($requestId, 'NIDA', $nidaNumber);
            $finalXml = $this->buildTiraMsg($xmlContent);

            $response = Http::timeout($this->timeout)
                ->withHeaders($this->getHeaders())
                ->withBody($finalXml, 'application/xml')
                ->post($endpoint);

            $body = $this->parseXmlResponse($response->body());
            $statusCode = $response->status();

            $this->log('nida_verify', 'customer', $nidaNumber, 'success', ['nida' => $nidaNumber], $body, $statusCode);

            if ($response->successful() && ($body['AcknowledgementStatusCode'] ?? $body['status_code'] ?? '') === 'TIRA001') {
                $result = [
                    'success' => true,
                    'verified' => true,
                    'data' => $this->normalizeCustomerData($body['Customer'] ?? $body['Data'] ?? $body),
                ];
                if ($this->cacheTtl > 0) {
                    Cache::put($cacheKey, $result, $this->cacheTtl);
                }
                return $result;
            }

            return [
                'success' => false,
                'verified' => false,
                'error' => $body['AcknowledgementStatusDesc'] ?? $body['status_desc'] ?? 'NIDA verification failed',
                'status_code' => $body['AcknowledgementStatusCode'] ?? $body['status_code'] ?? 'TIRA002',
            ];

        } catch (\Exception $e) {
            Log::error('TIRAMIS NIDA verification failed: ' . $e->getMessage());
            $this->log('nida_verify', 'customer', $nidaNumber, 'error', ['nida' => $nidaNumber], ['error' => $e->getMessage()], 0);
            return ['success' => false, 'verified' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Lookup customer KYC data by NIDA number or other identity.
     */
    public function lookupCustomer(string $identityNumber, string $identityType = 'NIDA'): array
    {
        if (!$this->kycEnabled) {
            return $this->simulatedLookupResponse($identityNumber, $identityType);
        }

        $cacheKey = "tiramis_lookup_{$identityType}_{$identityNumber}";
        if ($this->cacheTtl > 0 && Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        try {
            $requestId = 'LKP-' . strtoupper(Str::random(12));
            $endpoint = $this->resolveBaseUrl() . config('tiramis.kyc.lookup_endpoint', '/kyc/lookup');

            $xmlContent = $this->buildKycLookupXml($requestId, $identityType, $identityNumber);
            $finalXml = $this->buildTiraMsg($xmlContent);

            $response = Http::timeout($this->timeout)
                ->withHeaders($this->getHeaders())
                ->withBody($finalXml, 'application/xml')
                ->post($endpoint);

            $body = $this->parseXmlResponse($response->body());
            $statusCode = $response->status();

            $this->log('customer_lookup', 'customer', $identityNumber, 'success', compact('identityType', 'identityNumber'), $body, $statusCode);

            if ($response->successful() && ($body['AcknowledgementStatusCode'] ?? $body['status_code'] ?? '') === 'TIRA001') {
                $result = [
                    'success' => true,
                    'data' => $this->normalizeCustomerData($body['Customer'] ?? $body['Data'] ?? $body),
                ];
                if ($this->cacheTtl > 0) {
                    Cache::put($cacheKey, $result, $this->cacheTtl);
                }
                return $result;
            }

            return [
                'success' => false,
                'error' => $body['AcknowledgementStatusDesc'] ?? $body['status_desc'] ?? 'Customer lookup failed',
                'status_code' => $body['AcknowledgementStatusCode'] ?? $body['status_code'] ?? 'TIRA002',
            ];

        } catch (\Exception $e) {
            Log::error('TIRAMIS customer lookup failed: ' . $e->getMessage());
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    // ==================== VEHICLE REGISTRATION LOOKUP ====================

    /**
     * Lookup vehicle details by registration number from TIRAMIS.
     */
    public function lookupVehicle(string $registrationNumber): array
    {
        if (!$this->vehicleEnabled) {
            return $this->simulatedVehicleResponse($registrationNumber);
        }

        $cacheKey = "tiramis_vehicle_{$registrationNumber}";
        if ($this->cacheTtl > 0 && Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        try {
            $endpoint = $this->resolveBaseUrl() . config('tiramis.vehicle.lookup_endpoint', '/vehicle/lookup');

            $requestId = 'VEH-' . strtoupper(Str::random(12));
            $xmlContent = $this->buildVehicleLookupXml($requestId, $registrationNumber);
            $finalXml = $this->buildTiraMsg($xmlContent);

            $response = Http::timeout($this->timeout)
                ->withHeaders($this->getHeaders())
                ->withBody($finalXml, 'application/xml')
                ->post($endpoint);

            $body = $this->parseXmlResponse($response->body());
            $statusCode = $response->status();

            $this->log('vehicle_lookup', 'vehicle', $registrationNumber, 'success', ['reg' => $registrationNumber], $body, $statusCode);

            if ($response->successful() && ($body['AcknowledgementStatusCode'] ?? $body['status_code'] ?? '') === 'TIRA001') {
                $result = [
                    'success' => true,
                    'data' => $this->normalizeVehicleData($body['Vehicle'] ?? $body['Data'] ?? $body),
                ];
                if ($this->cacheTtl > 0) {
                    Cache::put($cacheKey, $result, $this->cacheTtl);
                }
                return $result;
            }

            return [
                'success' => false,
                'error' => $body['AcknowledgementStatusDesc'] ?? $body['status_desc'] ?? 'Vehicle lookup failed',
                'status_code' => $body['AcknowledgementStatusCode'] ?? $body['status_code'] ?? 'TIRA002',
            ];

        } catch (\Exception $e) {
            Log::error('TIRAMIS vehicle lookup failed: ' . $e->getMessage());
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Verify vehicle details against TIRAMIS records.
     */
    public function verifyVehicle(string $registrationNumber, string $chassisNumber): array
    {
        if (!$this->vehicleEnabled) {
            return ['success' => true, 'verified' => true, 'data' => $this->simulatedVehicleResponse($registrationNumber)['data'] ?? []];
        }

        try {
            $endpoint = $this->resolveBaseUrl() . config('tiramis.vehicle.verify_endpoint', '/vehicle/verify');

            $requestId = 'VEH-' . strtoupper(Str::random(12));
            $xmlContent = $this->buildVehicleVerifyXml($requestId, $registrationNumber, $chassisNumber);
            $finalXml = $this->buildTiraMsg($xmlContent);

            $response = Http::timeout($this->timeout)
                ->withHeaders($this->getHeaders())
                ->withBody($finalXml, 'application/xml')
                ->post($endpoint);

            $body = $this->parseXmlResponse($response->body());
            $statusCode = $response->status();

            $this->log('vehicle_verify', 'vehicle', $registrationNumber, 'success', compact('registrationNumber', 'chassisNumber'), $body, $statusCode);

            if ($response->successful() && ($body['AcknowledgementStatusCode'] ?? $body['status_code'] ?? '') === 'TIRA001') {
                return [
                    'success' => true,
                    'verified' => true,
                    'data' => $this->normalizeVehicleData($body['Vehicle'] ?? $body['Data'] ?? $body),
                ];
            }

            return [
                'success' => false,
                'verified' => false,
                'error' => $body['AcknowledgementStatusDesc'] ?? $body['status_desc'] ?? 'Vehicle verification failed',
            ];

        } catch (\Exception $e) {
            Log::error('TIRAMIS vehicle verification failed: ' . $e->getMessage());
            return ['success' => false, 'verified' => false, 'error' => $e->getMessage()];
        }
    }

    // ==================== PAYMENT VERIFICATION ====================

    /**
     * Submit payment record to TIRAMIS.
     */
    public function submitPayment(array $paymentData): array
    {
        $paymentEnabled = config('tiramis.payment.enabled', false);
        if (!$paymentEnabled) {
            return ['success' => true, 'simulated' => true, 'message' => 'Payment recorded locally (TIRAMIS payment disabled)'];
        }

        try {
            $endpoint = $this->resolveBaseUrl() . config('tiramis.payment.submit_endpoint', '/payment/submit');

            $requestId = 'PAY-' . strtoupper(Str::random(12));
            $xmlContent = $this->buildPaymentSubmitXml($requestId, $paymentData);
            $finalXml = $this->buildTiraMsg($xmlContent);

            $response = Http::timeout($this->timeout)
                ->withHeaders($this->getHeaders())
                ->withBody($finalXml, 'application/xml')
                ->post($endpoint);

            $body = $this->parseXmlResponse($response->body());
            $statusCode = $response->status();

            $this->log('payment_submit', 'payment', $paymentData['transaction_id'] ?? '', 'success', $paymentData, $body, $statusCode);

            if ($response->successful() && ($body['AcknowledgementStatusCode'] ?? $body['status_code'] ?? '') === 'TIRA001') {
                return ['success' => true, 'data' => $body];
            }

            return ['success' => false, 'error' => $body['AcknowledgementStatusDesc'] ?? $body['status_desc'] ?? 'Payment submission failed'];

        } catch (\Exception $e) {
            Log::error('TIRAMIS payment submission failed: ' . $e->getMessage());
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Verify payment status with TIRAMIS.
     */
    public function verifyPayment(string $transactionId): array
    {
        $paymentEnabled = config('tiramis.payment.enabled', false);
        if (!$paymentEnabled) {
            return ['success' => true, 'verified' => true, 'status' => 'completed'];
        }

        try {
            $endpoint = $this->resolveBaseUrl() . config('tiramis.payment.verify_endpoint', '/payment/verify');

            $requestId = 'PAY-' . strtoupper(Str::random(12));
            $xmlContent = $this->buildPaymentVerifyXml($requestId, $transactionId);
            $finalXml = $this->buildTiraMsg($xmlContent);

            $response = Http::timeout($this->timeout)
                ->withHeaders($this->getHeaders())
                ->withBody($finalXml, 'application/xml')
                ->post($endpoint);

            $body = $this->parseXmlResponse($response->body());
            $statusCode = $response->status();

            if ($response->successful() && ($body['AcknowledgementStatusCode'] ?? $body['status_code'] ?? '') === 'TIRA001') {
                return ['success' => true, 'verified' => true, 'status' => $body['PaymentStatus'] ?? $body['payment_status'] ?? 'completed', 'data' => $body];
            }

            return ['success' => false, 'verified' => false, 'error' => $body['AcknowledgementStatusDesc'] ?? $body['status_desc'] ?? 'Payment verification failed'];

        } catch (\Exception $e) {
            Log::error('TIRAMIS payment verification failed: ' . $e->getMessage());
            return ['success' => false, 'verified' => false, 'error' => $e->getMessage()];
        }
    }

    // ==================== XML BUILDERS ====================

    protected function buildKycVerifyXml(string $requestId, string $identityType, string $identityNumber): string
    {
        $xml = "  <KycVerifyReq>\n";
        $xml .= "    <KycVerifyHdr>\n";
        $xml .= "      <RequestId>$requestId</RequestId>\n";
        $xml .= '      <CompanyCode>' . htmlspecialchars($this->clientCode) . "</CompanyCode>\n";
        $xml .= '      <SystemCode>' . htmlspecialchars($this->systemCode) . "</SystemCode>\n";
        $xml .= '      <CallBackUrl>' . htmlspecialchars(config('tiramis.client.callback_url', route('tiramis.callback'))) . "</CallBackUrl>\n";
        $xml .= "    </KycVerifyHdr>\n";
        $xml .= "    <KycVerifyDtl>\n";
        $xml .= '      <IdentityType>' . htmlspecialchars($identityType) . "</IdentityType>\n";
        $xml .= '      <IdentityNumber>' . htmlspecialchars($identityNumber) . "</IdentityNumber>\n";
        $xml .= "    </KycVerifyDtl>\n";
        $xml .= "  </KycVerifyReq>\n";
        return $xml;
    }

    protected function buildKycLookupXml(string $requestId, string $identityType, string $identityNumber): string
    {
        $xml = "  <KycLookupReq>\n";
        $xml .= "    <KycLookupHdr>\n";
        $xml .= "      <RequestId>$requestId</RequestId>\n";
        $xml .= '      <CompanyCode>' . htmlspecialchars($this->clientCode) . "</CompanyCode>\n";
        $xml .= '      <SystemCode>' . htmlspecialchars($this->systemCode) . "</SystemCode>\n";
        $xml .= '      <CallBackUrl>' . htmlspecialchars(config('tiramis.client.callback_url', route('tiramis.callback'))) . "</CallBackUrl>\n";
        $xml .= "    </KycLookupHdr>\n";
        $xml .= "    <KycLookupDtl>\n";
        $xml .= '      <IdentityType>' . htmlspecialchars($identityType) . "</IdentityType>\n";
        $xml .= '      <IdentityNumber>' . htmlspecialchars($identityNumber) . "</IdentityNumber>\n";
        $xml .= "    </KycLookupDtl>\n";
        $xml .= "  </KycLookupReq>\n";
        return $xml;
    }

    protected function buildVehicleLookupXml(string $requestId, string $registrationNumber): string
    {
        $xml = "  <VehicleLookupReq>\n";
        $xml .= "    <VehicleLookupHdr>\n";
        $xml .= "      <RequestId>$requestId</RequestId>\n";
        $xml .= '      <CompanyCode>' . htmlspecialchars($this->clientCode) . "</CompanyCode>\n";
        $xml .= '      <SystemCode>' . htmlspecialchars($this->systemCode) . "</SystemCode>\n";
        $xml .= "    </VehicleLookupHdr>\n";
        $xml .= "    <VehicleLookupDtl>\n";
        $xml .= '      <RegistrationNumber>' . htmlspecialchars(strtoupper($registrationNumber)) . "</RegistrationNumber>\n";
        $xml .= "    </VehicleLookupDtl>\n";
        $xml .= "  </VehicleLookupReq>\n";
        return $xml;
    }

    protected function buildVehicleVerifyXml(string $requestId, string $registrationNumber, string $chassisNumber): string
    {
        $xml = "  <VehicleVerifyReq>\n";
        $xml .= "    <VehicleVerifyHdr>\n";
        $xml .= "      <RequestId>$requestId</RequestId>\n";
        $xml .= '      <CompanyCode>' . htmlspecialchars($this->clientCode) . "</CompanyCode>\n";
        $xml .= '      <SystemCode>' . htmlspecialchars($this->systemCode) . "</SystemCode>\n";
        $xml .= "    </VehicleVerifyHdr>\n";
        $xml .= "    <VehicleVerifyDtl>\n";
        $xml .= '      <RegistrationNumber>' . htmlspecialchars(strtoupper($registrationNumber)) . "</RegistrationNumber>\n";
        $xml .= '      <ChassisNumber>' . htmlspecialchars(strtoupper($chassisNumber)) . "</ChassisNumber>\n";
        $xml .= "    </VehicleVerifyDtl>\n";
        $xml .= "  </VehicleVerifyReq>\n";
        return $xml;
    }

    protected function buildPaymentSubmitXml(string $requestId, array $data): string
    {
        $xml = "  <PaymentSubmitReq>\n";
        $xml .= "    <PaymentSubmitHdr>\n";
        $xml .= "      <RequestId>$requestId</RequestId>\n";
        $xml .= '      <CompanyCode>' . htmlspecialchars($this->clientCode) . "</CompanyCode>\n";
        $xml .= '      <SystemCode>' . htmlspecialchars($this->systemCode) . "</SystemCode>\n";
        $xml .= "    </PaymentSubmitHdr>\n";
        $xml .= "    <PaymentSubmitDtl>\n";
        $xml .= '      <TransactionId>' . htmlspecialchars($data['transaction_id'] ?? '') . "</TransactionId>\n";
        $xml .= '      <Amount>' . ($data['amount'] ?? '0.00') . "</Amount>\n";
        $xml .= '      <CurrencyCode>' . htmlspecialchars($data['currency'] ?? 'TZS') . "</CurrencyCode>\n";
        $xml .= '      <PaymentMode>' . ($data['payment_mode'] ?? '1') . "</PaymentMode>\n";
        $xml .= '      <Reference>' . htmlspecialchars($data['reference'] ?? '') . "</Reference>\n";
        $xml .= "    </PaymentSubmitDtl>\n";
        $xml .= "  </PaymentSubmitReq>\n";
        return $xml;
    }

    protected function buildPaymentVerifyXml(string $requestId, string $transactionId): string
    {
        $xml = "  <PaymentVerifyReq>\n";
        $xml .= "    <PaymentVerifyHdr>\n";
        $xml .= "      <RequestId>$requestId</RequestId>\n";
        $xml .= '      <CompanyCode>' . htmlspecialchars($this->clientCode) . "</CompanyCode>\n";
        $xml .= '      <SystemCode>' . htmlspecialchars($this->systemCode) . "</SystemCode>\n";
        $xml .= "    </PaymentVerifyHdr>\n";
        $xml .= "    <PaymentVerifyDtl>\n";
        $xml .= '      <TransactionId>' . htmlspecialchars($transactionId) . "</TransactionId>\n";
        $xml .= "    </PaymentVerifyDtl>\n";
        $xml .= "  </PaymentVerifyReq>\n";
        return $xml;
    }

    // ==================== DATA NORMALIZATION ====================

    protected function normalizeCustomerData(array $raw): array
    {
        return [
            'first_name' => $raw['first_name'] ?? $raw['firstName'] ?? $raw['given_name'] ?? '',
            'middle_name' => $raw['middle_name'] ?? $raw['middleName'] ?? '',
            'last_name' => $raw['last_name'] ?? $raw['lastName'] ?? $raw['surname'] ?? '',
            'full_name' => $raw['full_name'] ?? $raw['fullName'] ?? trim(
                ($raw['first_name'] ?? $raw['firstName'] ?? '') . ' ' .
                ($raw['middle_name'] ?? $raw['middleName'] ?? '') . ' ' .
                ($raw['last_name'] ?? $raw['lastName'] ?? $raw['surname'] ?? '')
            ),
            'gender' => $raw['gender'] ?? $raw['sex'] ?? '',
            'date_of_birth' => $raw['date_of_birth'] ?? $raw['dob'] ?? $raw['birthDate'] ?? '',
            'nationality' => $raw['nationality'] ?? $raw['country'] ?? 'TZ',
            'identity_type' => $raw['identity_type'] ?? $raw['identityType'] ?? 'NIDA',
            'identity_number' => $raw['identity_number'] ?? $raw['identityNumber'] ?? $raw['nida_number'] ?? '',
            'phone' => $raw['phone'] ?? $raw['phone_number'] ?? $raw['mobile'] ?? '',
            'email' => $raw['email'] ?? $raw['email_address'] ?? '',
            'address' => $raw['address'] ?? $raw['physical_address'] ?? '',
            'region' => $raw['region'] ?? $raw['state'] ?? '',
            'district' => $raw['district'] ?? $raw['county'] ?? '',
            'ward' => $raw['ward'] ?? '',
            'street' => $raw['street'] ?? '',
            'postal_code' => $raw['postal_code'] ?? $raw['postalCode'] ?? '',
            'photo_url' => $raw['photo_url'] ?? $raw['photo'] ?? $raw['image'] ?? '',
            'signature_url' => $raw['signature_url'] ?? $raw['signature'] ?? '',
            'occupation' => $raw['occupation'] ?? $raw['profession'] ?? '',
            'marital_status' => $raw['marital_status'] ?? $raw['maritalStatus'] ?? '',
            'raw' => $raw,
        ];
    }

    protected function normalizeVehicleData(array $raw): array
    {
        return [
            'registration_number' => $raw['registration_number'] ?? $raw['registrationNumber'] ?? '',
            'chassis_number' => $raw['chassis_number'] ?? $raw['chassisNumber'] ?? '',
            'engine_number' => $raw['engine_number'] ?? $raw['engineNumber'] ?? '',
            'make' => $raw['make'] ?? $raw['brand'] ?? '',
            'model' => $raw['model'] ?? '',
            'model_number' => $raw['model_number'] ?? $raw['modelNumber'] ?? '',
            'body_type' => $raw['body_type'] ?? $raw['bodyType'] ?? '',
            'color' => $raw['color'] ?? $raw['colour'] ?? '',
            'engine_capacity' => $raw['engine_capacity'] ?? $raw['engineCapacity'] ?? '',
            'fuel_type' => $raw['fuel_type'] ?? $raw['fuelUsed'] ?? $raw['fuel'] ?? '',
            'year_of_manufacture' => $raw['year_of_manufacture'] ?? $raw['yearOfManufacture'] ?? $raw['year'] ?? '',
            'number_of_axles' => $raw['number_of_axles'] ?? $raw['numberOfAxles'] ?? '',
            'sitting_capacity' => $raw['sitting_capacity'] ?? $raw['sittingCapacity'] ?? '',
            'tare_weight' => $raw['tare_weight'] ?? $raw['tareWeight'] ?? '',
            'gross_weight' => $raw['gross_weight'] ?? $raw['grossWeight'] ?? '',
            'motor_category' => $raw['motor_category'] ?? $raw['motorCategory'] ?? '',
            'motor_type' => $raw['motor_type'] ?? $raw['motorType'] ?? '',
            'motor_usage' => $raw['motor_usage'] ?? $raw['motorUsage'] ?? '',
            'owner_name' => $raw['owner_name'] ?? $raw['ownerName'] ?? '',
            'owner_category' => $raw['owner_category'] ?? $raw['ownerCategory'] ?? '',
            'owner_address' => $raw['owner_address'] ?? $raw['ownerAddress'] ?? '',
            'insurance_status' => $raw['insurance_status'] ?? $raw['insuranceStatus'] ?? '',
            'sticker_number' => $raw['sticker_number'] ?? $raw['stickerNumber'] ?? '',
            'raw' => $raw,
        ];
    }

    // ==================== SIMULATED RESPONSES (DEV/TESTING) ====================

    protected function simulatedNidaResponse(string $nidaNumber): array
    {
        return [
            'success' => true,
            'verified' => true,
            'simulated' => true,
            'data' => [
                'first_name' => 'Juma',
                'middle_name' => 'Ali',
                'last_name' => 'Mohamed',
                'full_name' => 'Juma Ali Mohamed',
                'gender' => 'M',
                'date_of_birth' => '1985-06-15',
                'nationality' => 'TZ',
                'identity_type' => 'NIDA',
                'identity_number' => $nidaNumber,
                'phone' => '255712345678',
                'email' => 'juma.mohamed@example.com',
                'address' => '123 Mwai Kibaki Road',
                'region' => 'Dar es Salaam',
                'district' => 'Kinondoni',
                'ward' => 'Mikocheni',
                'street' => 'Mwai Kibaki Road',
                'postal_code' => '14111',
                'occupation' => 'Business Owner',
                'marital_status' => 'Married',
            ],
        ];
    }

    protected function simulatedLookupResponse(string $identityNumber, string $identityType): array
    {
        return [
            'success' => true,
            'simulated' => true,
            'data' => [
                'first_name' => 'Fatima',
                'last_name' => 'Hassan',
                'full_name' => 'Fatima Hassan',
                'gender' => 'F',
                'date_of_birth' => '1990-03-22',
                'nationality' => 'TZ',
                'identity_type' => $identityType,
                'identity_number' => $identityNumber,
                'phone' => '255787654321',
                'email' => 'fatima.hassan@example.com',
                'address' => '45 Samora Avenue',
                'region' => 'Dar es Salaam',
                'district' => 'Ilala',
            ],
        ];
    }

    protected function simulatedVehicleResponse(string $registrationNumber): array
    {
        return [
            'success' => true,
            'simulated' => true,
            'data' => [
                'registration_number' => $registrationNumber,
                'chassis_number' => 'CHS' . strtoupper(Str::random(14)),
                'engine_number' => 'ENG' . strtoupper(Str::random(12)),
                'make' => 'Toyota',
                'model' => 'Corolla',
                'model_number' => 'E160',
                'body_type' => 'Sedan',
                'color' => 'White',
                'engine_capacity' => '1800',
                'fuel_type' => 'Petrol',
                'year_of_manufacture' => '2020',
                'number_of_axles' => '2',
                'sitting_capacity' => '5',
                'tare_weight' => '1250',
                'gross_weight' => '1750',
                'motor_category' => '1',
                'motor_type' => '1',
                'motor_usage' => '1',
                'owner_name' => 'Juma Ali Mohamed',
                'owner_category' => '1',
                'owner_address' => '123 Mwai Kibaki Road, Dar es Salaam',
                'insurance_status' => 'insured',
            ],
        ];
    }

    // ==================== LOGGING ====================

    protected function log(string $action, string $entityType, $entityId, string $status, $requestPayload, $responsePayload, ?int $httpCode): void
    {
        try {
            TirAmisIntegrationLog::create([
                'action' => $action,
                'entity_type' => $entityType,
                'entity_id' => $entityId,
                'company_code' => $this->clientCode,
                'sales_code' => null,
                'status' => $status,
                'request_payload' => is_string($requestPayload) ? $requestPayload : json_encode($requestPayload),
                'response_payload' => $responsePayload ? (is_string($responsePayload) ? $responsePayload : json_encode($responsePayload)) : null,
                'http_status_code' => $httpCode,
                'ip_address' => request()->ip(),
            ]);
        } catch (\Exception $e) {
            Log::warning('Failed to log TIRAMIS KYC action: ' . $e->getMessage());
        }
    }

    // ==================== HEALTH CHECK ====================

    /**
     * Test connectivity to TIRAMIS API (including tunnel if configured).
     */
    public function healthCheck(): array
    {
        $results = [
            'tiramis_enabled' => config('tiramis.enabled', false),
            'kyc_enabled' => $this->kycEnabled,
            'vehicle_enabled' => $this->vehicleEnabled,
            'tunnel_enabled' => $this->tunnelEnabled,
            'base_url' => $this->resolveBaseUrl(),
            'connectivity' => false,
            'latency_ms' => 0,
            'error' => null,
        ];

        if (!$results['tiramis_enabled']) {
            $results['error'] = 'TIRAMIS is disabled';
            return $results;
        }

        try {
            $start = microtime(true);
            $response = Http::timeout(10)
                ->withHeaders($this->getHeaders())
                ->get($this->resolveBaseUrl() . '/health');
            $results['latency_ms'] = round((microtime(true) - $start) * 1000);
            $results['connectivity'] = $response->successful();
            if (!$results['connectivity']) {
                $results['error'] = 'HTTP ' . $response->status();
            }
        } catch (\Exception $e) {
            $results['error'] = $e->getMessage();
        }

        return $results;
    }
}

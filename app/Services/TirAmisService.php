<?php

namespace App\Services;

use App\Models\TirAmisReport;
use App\Models\TirAmisIntegrationLog;
use App\Models\Claim;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TirAmisService
{
    protected string $baseUrl;
    protected string $username;
    protected string $password;
    protected string $apiKey;
    protected bool $enabled;
    protected int $timeout;

    public function __construct()
    {
        $config = config('tiramis');
        $mode = $config['mode'] ?? 'sandbox';
        $this->enabled = $config['enabled'] ?? false;
        $this->baseUrl = $config['endpoints'][$mode] ?? '';
        $this->username = $config['credentials']['username'] ?? '';
        $this->password = $config['credentials']['password'] ?? '';
        $this->apiKey = $config['credentials']['api_key'] ?? '';
        $this->timeout = $config['timeout'] ?? 30;
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function submitClaim(Claim $claim, string $companyCode, ?string $salesCode = null): array
    {
        $payload = $this->buildClaimPayload($claim, $companyCode, $salesCode);
        $reportNumber = 'TIR-' . strtoupper(uniqid());

        $report = TirAmisReport::create([
            'claim_id' => $claim->id,
            'company_code' => $companyCode,
            'sales_code' => $salesCode,
            'report_number' => $reportNumber,
            'report_type' => 'claims',
            'report_data' => $payload,
            'status' => 'pending',
        ]);

        if (!$this->enabled) {
            $report->update(['status' => 'simulated', 'response_code' => 'SIM']);
            $this->log('claim_submit', 'claim', $claim->id, $companyCode, $salesCode, 'simulated', $payload, null, 200);
            return ['success' => true, 'simulated' => true, 'report' => $report];
        }

        try {
            $response = Http::timeout($this->timeout)
                ->withHeaders($this->getHeaders())
                ->post($this->baseUrl . '/claims/report', $payload);

            $statusCode = $response->status();
            $body = $response->json();

            if ($response->successful()) {
                $report->update([
                    'status' => 'sent',
                    'sent_at' => now(),
                    'response_code' => (string) $statusCode,
                    'response_message' => $body['message'] ?? 'Submitted successfully',
                ]);
                $this->log('claim_submit', 'claim', $claim->id, $companyCode, $salesCode, 'success', $payload, $body, $statusCode);
                return ['success' => true, 'report' => $report, 'response' => $body];
            }

            $report->update([
                'status' => 'failed',
                'response_code' => (string) $statusCode,
                'response_message' => $body['message'] ?? $response->body(),
            ]);
            $this->log('claim_submit', 'claim', $claim->id, $companyCode, $salesCode, 'failed', $payload, $body, $statusCode);
            return ['success' => false, 'report' => $report, 'error' => $body['message'] ?? 'Unknown error'];

        } catch (\Exception $e) {
            $report->update([
                'status' => 'failed',
                'response_message' => $e->getMessage(),
            ]);
            $this->log('claim_submit', 'claim', $claim->id, $companyCode, $salesCode, 'error', $payload, ['error' => $e->getMessage()], 0);
            Log::error('TIRAMIS claim submission failed: ' . $e->getMessage());
            return ['success' => false, 'report' => $report, 'error' => $e->getMessage()];
        }
    }

    public function submitBatchClaims(array $claimIds, string $companyCode): array
    {
        $results = [];
        foreach ($claimIds as $id) {
            $claim = Claim::find($id);
            if ($claim) {
                $results[] = $this->submitClaim($claim, $companyCode);
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
                $body = $response->json();
                $report = TirAmisReport::where('report_number', $reportNumber)->first();
                if ($report && isset($body['status'])) {
                    $report->update(['status' => $body['status'], 'response_message' => $body['message'] ?? null]);
                }
                return $report;
            }
        } catch (\Exception $e) {
            Log::error('TIRAMIS status check failed: ' . $e->getMessage());
        }
        return null;
    }

    protected function buildClaimPayload(Claim $claim, string $companyCode, ?string $salesCode): array
    {
        return [
            'company_code' => $companyCode,
            'sales_code' => $salesCode ?? '',
            'claim_number' => $claim->claim_number ?? 'CLM-' . $claim->id,
            'claim_type' => $claim->claim_type,
            'claimed_amount' => (float) ($claim->claimed_amount ?? 0),
            'accident_date' => $claim->accident_date?->toDateString(),
            'description' => $claim->description,
            'status' => $claim->status,
            'fraud_score' => $claim->fraud_score ?? 0,
            'submitted_at' => now()->toIso8601String(),
        ];
    }

    protected function getHeaders(): array
    {
        return [
            'Authorization' => 'Bearer ' . $this->apiKey,
            'X-Username' => $this->username,
            'X-Api-Key' => $this->apiKey,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];
    }

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
}

<?php

namespace App\Services;

use App\Models\PaymentTransaction;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SelcomPaymentService
{
    protected string $vendor;
    protected string $apiKey;
    protected string $apiSecret;
    protected string $baseUrl;
    protected bool $enabled;

    public function __construct(?string $vendor = null)
    {
        $this->vendor = $vendor ?? config('services.selcom.vendor', env('SELCOM_BIMAKWIK_VENDOR'));
        $this->apiKey = $this->resolveKey('API_KEY');
        $this->apiSecret = $this->resolveKey('API_SECRET');
        $this->enabled = env('SELCOM_ENABLED', false);
        $this->baseUrl = env('SELCOM_ENV', 'sandbox') === 'production'
            ? 'https://apigw.selcommobile.com/v1'
            : 'https://apigw.selcommobile.com:10000';
    }

    protected function resolveKey(string $suffix): string
    {
        if (str_contains($this->vendor, '60418282')) {
            return env('SELCOM_BIMAKWIK_' . $suffix, '');
        }
        if (str_contains($this->vendor, '60973914')) {
            return env('SELCOM_MAMAMIA_' . $suffix, '');
        }
        return env('SELCOM_BIMAKWIK_' . $suffix, '');
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function createOrder(float $amount, string $reference, ?string $currency = 'TZS', ?string $msisdn = null): array
    {
        $payload = [
            'vendor' => $this->vendor,
            'order_id' => $reference,
            'buyer_email' => '',
            'buyer_name' => '',
            'buyer_phone' => $msisdn ?? '',
            'amount' => $amount,
            'currency' => $currency,
            'no_of_items' => 1,
            'webhook' => route('payment.selcom.webhook'),
            'success_url' => route('payment.selcom.success'),
            'cancel_url' => route('payment.selcom.cancel'),
        ];

        try {
            $response = Http::withBasicAuth($this->apiKey, $this->apiSecret)
                ->withHeaders(['Content-Type' => 'application/json'])
                ->post($this->baseUrl . '/checkout/create-order', $payload);

            if ($response->successful()) {
                $body = $response->json();
                return ['success' => true, 'data' => $body, 'order_id' => $body['order_id'] ?? null];
            }

            Log::error('Selcom createOrder failed', ['status' => $response->status(), 'body' => $response->body()]);
            return ['success' => false, 'error' => $response->json()['message'] ?? 'Selcom order failed'];
        } catch (\Exception $e) {
            Log::error('Selcom createOrder exception: ' . $e->getMessage());
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function checkOrderStatus(string $orderId): array
    {
        try {
            $response = Http::withBasicAuth($this->apiKey, $this->apiSecret)
                ->get($this->baseUrl . '/checkout/order-status/' . $orderId);

            if ($response->successful()) {
                return ['success' => true, 'data' => $response->json()];
            }
            return ['success' => false, 'error' => $response->json()['message'] ?? 'Status check failed'];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function handleWebhook(array $payload): array
    {
        $orderId = $payload['order_id'] ?? null;
        $transactionId = $payload['trans_id'] ?? null;
        $status = $payload['status'] ?? null;
        $reference = $payload['reference'] ?? $orderId;

        if (!$reference) {
            return ['success' => false, 'error' => 'No reference provided'];
        }

        $transaction = PaymentTransaction::where('reference', $reference)->first();
        if (!$transaction) {
            Log::warning('Selcom webhook: transaction not found', ['reference' => $reference]);
            return ['success' => false, 'error' => 'Transaction not found'];
        }

        $newStatus = match ($status) {
            'COMPLETED', 'SUCCESS' => 'completed',
            'FAILED', 'CANCELLED' => 'failed',
            'PENDING' => 'pending',
            default => $transaction->status,
        };

        $transaction->update([
            'transaction_id' => $transactionId ?? $transaction->transaction_id,
            'status' => $newStatus,
            'verified_at' => in_array($newStatus, ['completed', 'failed']) ? now() : $transaction->verified_at,
            'metadata' => array_merge($transaction->metadata ?? [], ['selcom_webhook' => $payload]),
        ]);

        return ['success' => true, 'transaction' => $transaction, 'status' => $newStatus];
    }
}

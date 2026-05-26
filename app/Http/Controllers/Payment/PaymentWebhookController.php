<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentWebhook;
use App\Models\PaymentTransaction;
use Illuminate\Support\Facades\Log;

class PaymentWebhookController extends Controller
{
    public function index()
    {
        $webhooks = collect();
        try {
            $webhooks = PaymentWebhook::with('paymentGateway', 'transaction')
                ->latest()
                ->paginate(15);
        } catch (\Exception $e) {}
        return view('payment.webhooks.index', compact('webhooks'));
    }

    public function show(PaymentWebhook $webhook)
    {
        return view('payment.webhooks.show', compact('webhook'));
    }

    public function handle(Request $request, $gatewayCode)
    {
        try {
            $payload = $request->all();
            $event = $request->header('X-Webhook-Event') ?? 'payment.updated';

            $webhook = PaymentWebhook::create([
                'payment_gateway_id' => $this->getGatewayId($gatewayCode),
                'event_type' => $event,
                'payload' => $payload,
                'processed' => false,
            ]);

            // Process the webhook based on event type
            $this->processWebhook($webhook);

            return response()->json(['status' => 'success'], 200);
        } catch (\Exception $e) {
            Log::error('Webhook processing failed: ' . $e->getMessage());
            return response()->json(['status' => 'error'], 500);
        }
    }

    public function retry(PaymentWebhook $webhook)
    {
        try {
            $webhook->update(['processed' => false]);
            $this->processWebhook($webhook);
            return back()->with('success', 'Webhook reprocessed successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to reprocess webhook');
        }
    }

    public function destroy(PaymentWebhook $webhook)
    {
        try {
            $webhook->delete();
            return redirect()->route('payment.webhooks.index')->with('success', 'Webhook deleted');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete webhook');
        }
    }

    private function getGatewayId($code)
    {
        try {
            $gateway = \App\Models\PaymentGateway::where('code', $code)->first();
            return $gateway?->id;
        } catch (\Exception $e) {
            return null;
        }
    }

    private function processWebhook(PaymentWebhook $webhook)
    {
        try {
            $payload = $webhook->payload;
            $eventType = $webhook->event_type;

            switch ($eventType) {
                case 'payment.completed':
                    $this->handlePaymentCompleted($payload);
                    break;
                case 'payment.failed':
                    $this->handlePaymentFailed($payload);
                    break;
                case 'payment.refunded':
                    $this->handlePaymentRefunded($payload);
                    break;
                default:
                    Log::info('Unhandled webhook event: ' . $eventType);
            }

            $webhook->update([
                'processed' => true,
                'processed_at' => now(),
                'response' => ['status' => 'processed'],
            ]);
        } catch (\Exception $e) {
            Log::error('Webhook processing error: ' . $e->getMessage());
            $webhook->update([
                'response' => ['error' => $e->getMessage()],
            ]);
        }
    }

    private function handlePaymentCompleted($payload)
    {
        try {
            $transactionId = $payload['transaction_id'] ?? null;
            if ($transactionId) {
                $transaction = PaymentTransaction::where('transaction_id', $transactionId)->first();
                if ($transaction) {
                    $transaction->update([
                        'status' => 'completed',
                        'verified_at' => now(),
                    ]);
                }
            }
        } catch (\Exception $e) {
            Log::error('Payment completion handling failed: ' . $e->getMessage());
        }
    }

    private function handlePaymentFailed($payload)
    {
        try {
            $transactionId = $payload['transaction_id'] ?? null;
            if ($transactionId) {
                $transaction = PaymentTransaction::where('transaction_id', $transactionId)->first();
                if ($transaction) {
                    $transaction->update(['status' => 'failed']);
                }
            }
        } catch (\Exception $e) {
            Log::error('Payment failure handling failed: ' . $e->getMessage());
        }
    }

    private function handlePaymentRefunded($payload)
    {
        try {
            $transactionId = $payload['transaction_id'] ?? null;
            if ($transactionId) {
                $transaction = PaymentTransaction::where('transaction_id', $transactionId)->first();
                if ($transaction) {
                    $transaction->update(['status' => 'refunded']);
                }
            }
        } catch (\Exception $e) {
            Log::error('Payment refund handling failed: ' . $e->getMessage());
        }
    }
}

<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentGateway;
use App\Models\PaymentTransaction;

class PaymentGatewayController extends Controller
{
    public function index()
    {
        $gateways = collect();
        try {
            $gateways = PaymentGateway::latest()->paginate(15);
        } catch (\Exception $e) {}
        return view('payment.gateways.index', compact('gateways'));
    }

    public function create()
    {
        return view('payment.gateways.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:payment_gateways',
            'type' => 'required|in:mobile_money,card,bank_transfer',
            'api_key' => 'nullable|string',
            'api_secret' => 'nullable|string',
            'merchant_id' => 'nullable|string',
            'environment' => 'required|in:sandbox,production',
            'supported_currencies' => 'nullable|array',
            'fees' => 'nullable|array',
        ]);

        try {
            PaymentGateway::create($validated);
            return redirect()->route('payment.gateways.index')->with('success', 'Payment gateway created successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to create payment gateway');
        }
    }

    public function show(PaymentGateway $gateway)
    {
        return view('payment.gateways.show', compact('gateway'));
    }

    public function edit(PaymentGateway $gateway)
    {
        return view('payment.gateways.edit', compact('gateway'));
    }

    public function update(Request $request, PaymentGateway $gateway)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:payment_gateways,code,' . $gateway->id,
            'type' => 'required|in:mobile_money,card,bank_transfer',
            'is_active' => 'boolean',
            'api_key' => 'nullable|string',
            'api_secret' => 'nullable|string',
            'merchant_id' => 'nullable|string',
            'environment' => 'required|in:sandbox,production',
            'supported_currencies' => 'nullable|array',
            'fees' => 'nullable|array',
        ]);

        try {
            $gateway->update($validated);
            return redirect()->route('payment.gateways.index')->with('success', 'Payment gateway updated successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update payment gateway');
        }
    }

    public function toggleStatus(PaymentGateway $gateway)
    {
        try {
            $gateway->update(['is_active' => !$gateway->is_active]);
            return back()->with('success', 'Payment gateway status updated');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update status');
        }
    }

    public function destroy(PaymentGateway $gateway)
    {
        try {
            $gateway->delete();
            return redirect()->route('payment.gateways.index')->with('success', 'Payment gateway deleted successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete payment gateway');
        }
    }

    public function initiatePayment(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:1000',
            'currency' => 'required|string',
            'payment_method' => 'required|string',
            'policy_id' => 'nullable|exists:customer_policies,id',
            'reference' => 'required|string',
        ]);

        try {
            $gateway = PaymentGateway::active()->first();
            if (!$gateway) {
                return back()->with('error', 'No active payment gateway available');
            }

            $transaction = PaymentTransaction::create([
                'user_id' => auth()->id(),
                'policy_id' => $validated['policy_id'] ?? null,
                'amount' => $validated['amount'],
                'currency' => $validated['currency'],
                'payment_method' => $validated['payment_method'],
                'payment_gateway' => $gateway->code,
                'reference' => $validated['reference'],
                'status' => 'pending',
                'payment_date' => now(),
            ]);

            // Here you would integrate with the actual payment gateway API
            // For now, we'll simulate the payment process

            return redirect()->route('payment.transactions.show', $transaction->id)
                ->with('success', 'Payment initiated successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to initiate payment');
        }
    }
}

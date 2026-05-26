<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentTransaction;
use App\Models\User;

class OfflinePaymentController extends Controller
{
    public function index()
    {
        $payments = collect();
        try {
            $payments = PaymentTransaction::where('payment_method', 'offline')
                ->with('user', 'policy')
                ->latest()
                ->paginate(15);
        } catch (\Exception $e) {}
        return view('payment.offline.index', compact('payments'));
    }

    public function create()
    {
        return view('payment.offline.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'policy_id' => 'nullable|exists:customer_policies,id',
            'amount' => 'required|numeric|min:1000',
            'currency' => 'required|string',
            'reference' => 'required|string',
            'payment_proof' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'notes' => 'nullable|string',
        ]);

        try {
            $transaction = PaymentTransaction::create([
                'user_id' => $validated['user_id'],
                'policy_id' => $validated['policy_id'] ?? null,
                'amount' => $validated['amount'],
                'currency' => $validated['currency'],
                'payment_method' => 'offline',
                'payment_gateway' => 'manual',
                'reference' => $validated['reference'],
                'status' => 'pending',
                'payment_date' => now(),
                'metadata' => [
                    'notes' => $validated['notes'] ?? null,
                    'payment_proof' => $request->file('payment_proof')?->store('payment-proofs'),
                ],
            ]);

            return redirect()->route('payment.offline.index')->with('success', 'Offline payment recorded');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to record offline payment');
        }
    }

    public function approve(PaymentTransaction $transaction)
    {
        try {
            $transaction->update([
                'status' => 'completed',
                'verified_at' => now(),
            ]);
            return back()->with('success', 'Payment approved successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to approve payment');
        }
    }

    public function reject(PaymentTransaction $transaction, Request $request)
    {
        $validated = $request->validate([
            'reason' => 'required|string',
        ]);

        try {
            $transaction->update([
                'status' => 'failed',
                'metadata' => array_merge($transaction->metadata ?? [], [
                    'rejection_reason' => $validated['reason'],
                ]),
            ]);
            return back()->with('success', 'Payment rejected');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to reject payment');
        }
    }

    public function show(PaymentTransaction $transaction)
    {
        return view('payment.offline.show', compact('transaction'));
    }
}

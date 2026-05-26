<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentTransaction;
use App\Models\User;

class PaymentTransactionController extends Controller
{
    public function index()
    {
        $transactions = collect();
        $stats = [
            'total' => 0,
            'successful' => 0,
            'pending' => 0,
            'failed' => 0,
            'total_amount' => 0,
        ];

        try {
            $transactions = PaymentTransaction::with('user', 'policy')->latest()->paginate(15);
            $stats = [
                'total' => PaymentTransaction::count() ?? 0,
                'successful' => PaymentTransaction::successful()->count() ?? 0,
                'pending' => PaymentTransaction::pending()->count() ?? 0,
                'failed' => PaymentTransaction::failed()->count() ?? 0,
                'total_amount' => PaymentTransaction::successful()->sum('amount') ?? 0,
            ];
        } catch (\Exception $e) {}

        return view('payment.transactions.index', compact('transactions', 'stats'));
    }

    public function show(PaymentTransaction $transaction)
    {
        return view('payment.transactions.show', compact('transaction'));
    }

    public function create()
    {
        return view('payment.transactions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'policy_id' => 'nullable|exists:customer_policies,id',
            'amount' => 'required|numeric|min:1000',
            'currency' => 'required|string',
            'payment_method' => 'required|string',
            'payment_gateway' => 'required|string',
            'reference' => 'required|string',
        ]);

        try {
            PaymentTransaction::create([
                ...$validated,
                'status' => 'pending',
                'payment_date' => now(),
            ]);
            return redirect()->route('payment.transactions.index')->with('success', 'Payment transaction created');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to create transaction');
        }
    }

    public function updateStatus(Request $request, PaymentTransaction $transaction)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,completed,failed,refunded',
            'transaction_id' => 'nullable|string',
        ]);

        try {
            $transaction->update($validated);
            if ($validated['status'] === 'completed') {
                $transaction->update(['verified_at' => now()]);
            }
            return back()->with('success', 'Transaction status updated');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update status');
        }
    }

    public function refund(PaymentTransaction $transaction)
    {
        try {
            $transaction->update(['status' => 'refunded']);
            return back()->with('success', 'Payment refunded successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to refund payment');
        }
    }

    public function destroy(PaymentTransaction $transaction)
    {
        try {
            $transaction->delete();
            return redirect()->route('payment.transactions.index')->with('success', 'Transaction deleted');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete transaction');
        }
    }

    public function myTransactions()
    {
        $transactions = collect();
        try {
            $transactions = PaymentTransaction::where('user_id', auth()->id())
                ->with('policy')
                ->latest()
                ->paginate(15);
        } catch (\Exception $e) {}
        return view('payment.transactions.my', compact('transactions'));
    }
}

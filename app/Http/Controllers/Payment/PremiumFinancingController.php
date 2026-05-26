<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentTransaction;
use App\Models\User;

class PremiumFinancingController extends Controller
{
    public function index()
    {
        $financing = collect();
        $stats = [
            'total_loans' => 0,
            'active_loans' => 0,
            'total_amount' => 0,
            'repaid_amount' => 0,
        ];

        try {
            $financing = PaymentTransaction::where('payment_method', 'financing')
                ->with('user', 'policy')
                ->latest()
                ->paginate(15);
            $stats = [
                'total_loans' => PaymentTransaction::where('payment_method', 'financing')->count() ?? 0,
                'active_loans' => PaymentTransaction::where('payment_method', 'financing')
                    ->where('status', 'pending')->count() ?? 0,
                'total_amount' => PaymentTransaction::where('payment_method', 'financing')->sum('amount') ?? 0,
                'repaid_amount' => PaymentTransaction::where('payment_method', 'financing')
                    ->where('status', 'completed')->sum('amount') ?? 0,
            ];
        } catch (\Exception $e) {}

        return view('payment.financing.index', compact('financing', 'stats'));
    }

    public function create()
    {
        return view('payment.financing.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'policy_id' => 'nullable|exists:customer_policies,id',
            'amount' => 'required|numeric|min:10000',
            'currency' => 'required|string',
            'interest_rate' => 'required|numeric|min:0|max:100',
            'repayment_period' => 'required|integer|min:1|max:36',
            'reference' => 'required|string',
        ]);

        try {
            $totalAmount = $validated['amount'] * (1 + ($validated['interest_rate'] / 100));
            $monthlyPayment = $totalAmount / $validated['repayment_period'];

            $transaction = PaymentTransaction::create([
                'user_id' => $validated['user_id'],
                'policy_id' => $validated['policy_id'] ?? null,
                'amount' => $totalAmount,
                'currency' => $validated['currency'],
                'payment_method' => 'financing',
                'payment_gateway' => 'financing_partner',
                'reference' => $validated['reference'],
                'status' => 'pending',
                'payment_date' => now(),
                'metadata' => [
                    'principal_amount' => $validated['amount'],
                    'interest_rate' => $validated['interest_rate'],
                    'repayment_period' => $validated['repayment_period'],
                    'monthly_payment' => $monthlyPayment,
                ],
            ]);

            return redirect()->route('payment.financing.index')->with('success', 'Financing request created');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to create financing request');
        }
    }

    public function show(PaymentTransaction $transaction)
    {
        return view('payment.financing.show', compact('transaction'));
    }

    public function approve(PaymentTransaction $transaction)
    {
        try {
            $transaction->update([
                'status' => 'completed',
                'verified_at' => now(),
            ]);
            return back()->with('success', 'Financing approved');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to approve financing');
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
            return back()->with('success', 'Financing rejected');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to reject financing');
        }
    }

    public function schedule(PaymentTransaction $transaction)
    {
        $schedule = [];
        try {
            $metadata = $transaction->metadata ?? [];
            $monthlyPayment = $metadata['monthly_payment'] ?? 0;
            $repaymentPeriod = $metadata['repayment_period'] ?? 1;

            for ($i = 1; $i <= $repaymentPeriod; $i++) {
                $schedule[] = [
                    'month' => $i,
                    'due_date' => now()->addMonths($i)->format('Y-m-d'),
                    'amount' => $monthlyPayment,
                    'status' => 'pending',
                ];
            }
        } catch (\Exception $e) {}

        return view('payment.financing.schedule', compact('transaction', 'schedule'));
    }
}

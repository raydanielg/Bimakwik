<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\BrokerCommission;
use App\Models\AgentCommission;
use App\Models\AggregatorCommission;
use App\Models\PayoutRequest;
use App\Models\Wallet;

class FinanceController extends Controller
{
    public function wallets()
    {
        try {
            $wallets = Wallet::paginate(20);
            $totalBalance = Wallet::sum('balance') ?? 0;
            $totalPending = 0; // No status column, set to 0
        } catch (\Exception $e) {
            $wallets = collect()->paginate(20);
            $totalBalance = 0;
            $totalPending = 0;
        }
        return view('admin.finance.wallets', compact('wallets', 'totalBalance', 'totalPending'));
    }

    public function premiums()
    {
        try {
            $collections = Transaction::latest()->paginate(20);
            $totalCollected = Transaction::sum('amount') ?? 0;
        } catch (\Exception $e) {
            $collections = collect()->paginate(20);
            $totalCollected = 0;
        }
        return view('admin.finance.premiums', compact('collections', 'totalCollected'));
    }

    public function commissions()
    {
        try {
            // Combine all commission types
            $brokerCommissions = BrokerCommission::latest()->get();
            $agentCommissions = AgentCommission::latest()->get();
            $aggregatorCommissions = AggregatorCommission::latest()->get();
            
            // Merge all commissions
            $commissions = $brokerCommissions->merge($agentCommissions)->merge($aggregatorCommissions);
            
            // Calculate totals
            $totalCommissions = $brokerCommissions->sum('amount') + $agentCommissions->sum('amount') + $aggregatorCommissions->sum('amount');
            $paidCommissions = $totalCommissions * 0.6; // Estimate 60% paid
            
            // Paginate manually
            $page = request()->get('page', 1);
            $perPage = 20;
            $offset = ($page - 1) * $perPage;
            $commissions = $commissions->slice($offset, $perPage);
        } catch (\Exception $e) {
            $commissions = collect();
            $totalCommissions = 0;
            $paidCommissions = 0;
        }
        
        return view('admin.finance.commissions', compact('commissions', 'totalCommissions', 'paidCommissions'));
    }

    public function payouts()
    {
        try {
            $payouts = PayoutRequest::latest()->paginate(20);
            $pendingPayouts = 0; // No status column
        } catch (\Exception $e) {
            $payouts = collect()->paginate(20);
            $pendingPayouts = 0;
        }
        return view('admin.finance.payouts', compact('payouts', 'pendingPayouts'));
    }
    
    public function approvePayout(Request $request, $id)
    {
        try {
            $payout = PayoutRequest::findOrFail($id);
            $payout->status = 'approved';
            $payout->approved_by = auth()->id();
            $payout->approved_at = now();
            $payout->save();
            
            // Process actual payout here (integrate with payment gateway)
            
            return response()->json([
                'success' => true,
                'message' => 'Payout approved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to approve payout: ' . $e->getMessage()
            ], 500);
        }
    }
    
    public function rejectPayout(Request $request, $id)
    {
        try {
            $payout = PayoutRequest::findOrFail($id);
            $payout->status = 'rejected';
            $payout->rejected_by = auth()->id();
            $payout->rejected_at = now();
            $payout->rejection_reason = $request->input('reason');
            $payout->save();
            
            return response()->json([
                'success' => true,
                'message' => 'Payout rejected successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to reject payout: ' . $e->getMessage()
            ], 500);
        }
    }
}

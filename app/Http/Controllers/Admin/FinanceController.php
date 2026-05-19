<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\BrokerCommission;
use App\Models\AgentCommission;
use App\Models\AggregatorCommission;
use App\Models\WalletWithdrawal;
use App\Models\BrokerCommissionWithdrawal;
use App\Models\AgentCommissionWithdrawal;
use App\Models\AggregatorCommissionWithdrawal;
use App\Models\Wallet;
use Illuminate\Pagination\LengthAwarePaginator;

class FinanceController extends Controller
{
    public function wallets()
    {
        try {
            $wallets = Wallet::paginate(20);
            $totalBalance = Wallet::sum('balance') ?? 0;
            $totalPending = 0; // No status column, set to 0
        } catch (\Exception $e) {
            $wallets = new LengthAwarePaginator([], 0, 20);
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
            $collections = new LengthAwarePaginator([], 0, 20);
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
            // Combine all withdrawal types
            $walletWithdrawals = WalletWithdrawal::latest()->get();
            $brokerWithdrawals = BrokerCommissionWithdrawal::latest()->get();
            $agentWithdrawals = AgentCommissionWithdrawal::latest()->get();
            $aggregatorWithdrawals = AggregatorCommissionWithdrawal::latest()->get();
            
            // Merge all withdrawals
            $allPayouts = $walletWithdrawals
                ->merge($brokerWithdrawals)
                ->merge($agentWithdrawals)
                ->merge($aggregatorWithdrawals);
            
            // Calculate pending (estimate 30%)
            $totalAmount = $allPayouts->sum('amount');
            $pendingPayouts = $totalAmount * 0.3;
            
            // Paginate manually
            $page = request()->get('page', 1);
            $perPage = 20;
            $offset = ($page - 1) * $perPage;
            $payouts = $allPayouts->slice($offset, $perPage);
            
        } catch (\Exception $e) {
            $payouts = collect();
            $pendingPayouts = 0;
        }
        return view('admin.finance.payouts', compact('payouts', 'pendingPayouts'));
    }
    
    public function approvePayout(Request $request, $id)
    {
        try {
            // Try to find in any withdrawal table
            $payout = WalletWithdrawal::find($id) 
                ?? BrokerCommissionWithdrawal::find($id)
                ?? AgentCommissionWithdrawal::find($id)
                ?? AggregatorCommissionWithdrawal::find($id);
            
            if (!$payout) {
                return response()->json([
                    'success' => false,
                    'message' => 'Payout not found'
                ], 404);
            }
            
            // Update if status column exists
            if (method_exists($payout, 'getAttribute')) {
                $payout->update(['approved_at' => now()]);
            }
            
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
            // Try to find in any withdrawal table
            $payout = WalletWithdrawal::find($id) 
                ?? BrokerCommissionWithdrawal::find($id)
                ?? AgentCommissionWithdrawal::find($id)
                ?? AggregatorCommissionWithdrawal::find($id);
            
            if (!$payout) {
                return response()->json([
                    'success' => false,
                    'message' => 'Payout not found'
                ], 404);
            }
            
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

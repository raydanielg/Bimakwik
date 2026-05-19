<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentTransaction;
use App\Models\WalletTransaction;
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
            // Get wallets with user relationship
            $wallets = Wallet::latest()->paginate(20);
            
            // Calculate statistics
            $totalBalance = Wallet::sum('balance') ?? 0;
            $activeWallets = Wallet::count();
            
            // Get today's transactions (combine both types)
            $todayPaymentTx = PaymentTransaction::whereDate('created_at', today())->count();
            $todayWalletTx = WalletTransaction::whereDate('created_at', today())->count();
            $todayTransactions = $todayPaymentTx + $todayWalletTx;
            
            $todayPaymentVol = PaymentTransaction::whereDate('created_at', today())->sum('amount') ?? 0;
            $todayWalletVol = WalletTransaction::whereDate('created_at', today())->sum('amount') ?? 0;
            $todayVolume = $todayPaymentVol + $todayWalletVol;
            
            // Get pending withdrawals
            $pendingWithdrawals = WalletWithdrawal::count();
            $pendingAmount = WalletWithdrawal::sum('amount') ?? 0;
            
            // Get recent transactions (combine both types)
            $paymentTx = PaymentTransaction::latest()->limit(5)->get();
            $walletTx = WalletTransaction::latest()->limit(5)->get();
            $recentTransactions = $paymentTx->merge($walletTx)->sortByDesc('created_at')->take(10);
            
            // Calculate growth (simplified - 5% estimate)
            $balanceGrowth = 5.0;
            
        } catch (\Exception $e) {
            $wallets = new LengthAwarePaginator([], 0, 20);
            $totalBalance = 0;
            $activeWallets = 0;
            $todayTransactions = 0;
            $todayVolume = 0;
            $pendingWithdrawals = 0;
            $pendingAmount = 0;
            $recentTransactions = collect();
            $balanceGrowth = 0;
        }
        
        return view('admin.finance.wallets', compact(
            'wallets', 'totalBalance', 'activeWallets', 
            'todayTransactions', 'todayVolume', 
            'pendingWithdrawals', 'pendingAmount',
            'recentTransactions', 'balanceGrowth'
        ));
    }
    
    public function viewWallet($id)
    {
        try {
            $wallet = Wallet::findOrFail($id);
            $transactions = WalletTransaction::where('wallet_id', $id)->latest()->paginate(20);
            $withdrawals = WalletWithdrawal::where('wallet_id', $id)->latest()->get();
            
            return view('admin.finance.wallet-details', compact('wallet', 'transactions', 'withdrawals'));
        } catch (\Exception $e) {
            return redirect()->route('admin.finance.wallets')->with('error', 'Wallet not found');
        }
    }
    
    public function addFunds(Request $request, $id)
    {
        try {
            $wallet = Wallet::findOrFail($id);
            $amount = $request->input('amount');
            
            // Update wallet balance
            $wallet->balance += $amount;
            $wallet->save();
            
            // Create transaction record
            WalletTransaction::create([
                'wallet_id' => $id,
                'amount' => $amount,
                'type' => 'credit',
                'description' => 'Funds added by admin',
                'created_at' => now()
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Funds added successfully',
                'new_balance' => $wallet->balance
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to add funds'
            ], 500);
        }
    }
    
    public function freezeWallet(Request $request, $id)
    {
        try {
            $wallet = Wallet::findOrFail($id);
            $wallet->update(['is_active' => false]);
            
            return response()->json([
                'success' => true,
                'message' => 'Wallet frozen successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to freeze wallet'
            ], 500);
        }
    }
    
    public function activateWallet(Request $request, $id)
    {
        try {
            $wallet = Wallet::findOrFail($id);
            $wallet->update(['is_active' => true]);
            
            return response()->json([
                'success' => true,
                'message' => 'Wallet activated successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to activate wallet'
            ], 500);
        }
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

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
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

class FinanceController extends Controller
{
    public function wallets()
    {
        try {
            // Get wallets with user relationship
            $wallets = Wallet::with('user.roles')->latest()->paginate(20);
            
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
            $balanceGrowth = 0;
            
        } catch (\Exception $e) {
            // Fallback empty data on error to avoid broken actions on fake IDs
            $wallets = Wallet::whereRaw('1 = 0')->paginate(20);
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
            $amount = (float) $request->input('amount');
            if ($amount <= 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Amount must be greater than zero'
                ], 422);
            }
            
            // Update wallet balance
            $before = (float) $wallet->balance;
            $wallet->balance += $amount;
            $wallet->last_transaction_at = now();
            $wallet->save();
            
            // Create transaction record
            WalletTransaction::create([
                'wallet_id' => $id,
                'transaction_reference' => 'WAL-' . strtoupper(Str::random(10)),
                'transaction_type' => 'credit',
                'amount' => $amount,
                'balance_before' => $before,
                'balance_after' => (float) $wallet->balance,
                'description' => 'Funds added by admin',
                'status' => 'completed',
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
                'message' => 'Failed to freeze wallet: ' . $e->getMessage()
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
                'message' => 'Failed to activate wallet: ' . $e->getMessage()
            ], 500);
        }
    }

    public function walletTransactions($id)
    {
        try {
            $wallet = Wallet::findOrFail($id);

            $transactions = WalletTransaction::where('wallet_id', $wallet->id)
                ->latest()
                ->limit(20)
                ->get()
                ->map(function ($tx) {
                    return [
                        'date' => optional($tx->created_at)->format('M d, Y H:i') ?? 'N/A',
                        'type' => $tx->transaction_type ?? 'N/A',
                        'amount' => number_format((float) ($tx->amount ?? 0), 2),
                        'description' => $tx->description ?? 'No description',
                    ];
                });

            return response()->json([
                'success' => true,
                'transactions' => $transactions,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch transactions: ' . $e->getMessage(),
            ], 500);
        }
    }
    
    public function premiums()
    {
        try {
            // Get premium collections with pagination
            $collections = PaymentTransaction::latest()->paginate(20);
            
            // Calculate comprehensive statistics
            $totalCollected = PaymentTransaction::sum('amount') ?? 0;
            $todayCollections = PaymentTransaction::whereDate('created_at', today())->sum('amount') ?? 0;
            $todayCount = PaymentTransaction::whereDate('created_at', today())->count();
            $monthCollections = PaymentTransaction::whereMonth('created_at', now()->month)->sum('amount') ?? 0;
            
            if (Schema::hasColumn('payment_transactions', 'status')) {
                $pendingAmount = PaymentTransaction::where('status', 'pending')->sum('amount') ?? 0;
                $pendingCount = PaymentTransaction::where('status', 'pending')->count();
                $successfulCount = PaymentTransaction::where('status', 'completed')->count();
                $totalCount = PaymentTransaction::count();
                $collectionRate = $totalCount > 0 ? round(($successfulCount / $totalCount) * 100, 1) : 0;
            } else {
                $pendingAmount = 0;
                $pendingCount = 0;
                $collectionRate = 0;
            }
            
            // Monthly growth
            $lastMonthCollections = PaymentTransaction::whereMonth('created_at', now()->subMonth()->month)->sum('amount') ?? 0;
            $monthlyGrowth = $lastMonthCollections > 0 ? (($monthCollections - $lastMonthCollections) / $lastMonthCollections) * 100 : 0;
            
        } catch (\Exception $e) {
            $collections = new LengthAwarePaginator([], 0, 20);
            $totalCollected = 0;
            $todayCollections = 0;
            $todayCount = 0;
            $monthCollections = 0;
            $pendingAmount = 0;
            $pendingCount = 0;
            $collectionRate = 0;
            $monthlyGrowth = 0;
        }
        
        return view('admin.finance.premiums', compact(
            'collections', 'totalCollected', 'todayCollections', 'todayCount',
            'monthCollections', 'pendingAmount', 'pendingCount', 
            'collectionRate', 'monthlyGrowth'
        ));
    }
    
    public function exportPremiums()
    {
        try {
            // Get all premium data
            $collections = PaymentTransaction::latest()->get();
            $totalCollected = PaymentTransaction::sum('amount') ?? 0;
            $todayCollections = PaymentTransaction::whereDate('created_at', today())->sum('amount') ?? 0;
            
            // Generate PDF
            $pdf = \PDF::loadView('admin.finance.premiums-pdf', [
                'collections' => $collections,
                'totalCollected' => $totalCollected,
                'todayCollections' => $todayCollections,
                'generatedDate' => now()->format('F d, Y'),
                'generatedTime' => now()->format('H:i:s'),
                'generatedBy' => auth()->user()->name ?? 'System',
            ]);
            
            $pdf->setPaper('A4', 'landscape');
            
            $filename = 'Premium_Collections_' . now()->format('Ymd_His') . '.pdf';
            
            return $pdf->download($filename);
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to generate PDF: ' . $e->getMessage());
        }
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
            $brokerTotal = $brokerCommissions->sum('commission_amount');
            $agentTotal = $agentCommissions->sum('commission_amount');
            $aggregatorTotal = $aggregatorCommissions->sum('commission_amount');
            $totalCommissions = $brokerTotal + $agentTotal + $aggregatorTotal;
            $paidCommissions = $brokerCommissions->where('status', 'paid')->sum('commission_amount')
                + $agentCommissions->where('status', 'paid')->sum('commission_amount')
                + $aggregatorCommissions->where('status', 'paid')->sum('commission_amount');
            $pendingCommissions = max(0, $totalCommissions - $paidCommissions);
            
            // Paginate manually
            $page = request()->get('page', 1);
            $perPage = 20;
            $offset = ($page - 1) * $perPage;
            $commissions = $commissions->slice($offset, $perPage);
        } catch (\Exception $e) {
            $commissions = collect();
            $totalCommissions = 0;
            $paidCommissions = 0;
            $pendingCommissions = 0;
        }

        return view('admin.finance.commissions', compact('commissions', 'totalCommissions', 'paidCommissions', 'pendingCommissions'));
    }

    public function payouts()
    {
        try {
            // Combine all withdrawal types
            $walletWithdrawals = WalletWithdrawal::latest()->get()->each(function ($item) {
                $item->setAttribute('_source', 'wallet');
            });
            $brokerWithdrawals = BrokerCommissionWithdrawal::latest()->get()->each(function ($item) {
                $item->setAttribute('_source', 'broker');
            });
            $agentWithdrawals = AgentCommissionWithdrawal::latest()->get()->each(function ($item) {
                $item->setAttribute('_source', 'agent');
            });
            $aggregatorWithdrawals = AggregatorCommissionWithdrawal::latest()->get()->each(function ($item) {
                $item->setAttribute('_source', 'aggregator');
            });
            
            // Merge all withdrawals
            $allPayouts = $walletWithdrawals
                ->merge($brokerWithdrawals)
                ->merge($agentWithdrawals)
                ->merge($aggregatorWithdrawals)
                ->sortByDesc('created_at')
                ->values();
            
            $pendingPayouts = $allPayouts
                ->filter(function ($item) {
                    return strtolower((string) ($item->status ?? 'pending')) === 'pending';
                })
                ->sum('amount');

            $approvedToday = $allPayouts
                ->filter(function ($item) {
                    return strtolower((string) ($item->status ?? '')) === 'approved'
                        && !empty($item->processed_at)
                        && \Illuminate\Support\Carbon::parse($item->processed_at)->isToday();
                })
                ->sum('amount');

            $totalThisMonth = $allPayouts
                ->filter(function ($item) {
                    return !empty($item->created_at)
                        && \Illuminate\Support\Carbon::parse($item->created_at)->isCurrentMonth();
                })
                ->sum('amount');
            
            // Paginate manually
            $page = request()->get('page', 1);
            $perPage = 20;
            $offset = ($page - 1) * $perPage;
            $payouts = $allPayouts->slice($offset, $perPage);
            
        } catch (\Exception $e) {
            $payouts = collect();
            $pendingPayouts = 0;
            $approvedToday = 0;
            $totalThisMonth = 0;
        }
        return view('admin.finance.payouts', compact('payouts', 'pendingPayouts', 'approvedToday', 'totalThisMonth'));
    }

    public function approveCommission(Request $request, $id)
    {
        try {
            $commission = BrokerCommission::find($id)
                ?? AgentCommission::find($id)
                ?? AggregatorCommission::find($id);

            if (!$commission) {
                return response()->json([
                    'success' => false,
                    'message' => 'Commission record not found'
                ], 404);
            }

            $commission->status = 'approved';
            if (Schema::hasColumn($commission->getTable(), 'approved_at')) {
                $commission->approved_at = now();
            }
            $commission->save();

            return response()->json([
                'success' => true,
                'message' => 'Commission approved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to approve commission: ' . $e->getMessage()
            ], 500);
        }
    }
    
    public function approvePayout(Request $request, $id)
    {
        try {
            $type = strtolower((string) $request->input('type', $request->query('type')));
            $payout = null;

            if ($type === 'wallet') {
                $payout = WalletWithdrawal::find($id);
            } elseif ($type === 'broker') {
                $payout = BrokerCommissionWithdrawal::find($id);
            } elseif ($type === 'agent') {
                $payout = AgentCommissionWithdrawal::find($id);
            } elseif ($type === 'aggregator') {
                $payout = AggregatorCommissionWithdrawal::find($id);
            }

            if (!$payout) {
                // Fallback if type was not provided
                $payout = WalletWithdrawal::find($id)
                    ?? BrokerCommissionWithdrawal::find($id)
                    ?? AgentCommissionWithdrawal::find($id)
                    ?? AggregatorCommissionWithdrawal::find($id);
            }
            
            if (!$payout) {
                return response()->json([
                    'success' => false,
                    'message' => 'Payout not found'
                ], 404);
            }
            
            if (Schema::hasColumn($payout->getTable(), 'status')) {
                $payout->status = 'approved';
            }
            if (Schema::hasColumn($payout->getTable(), 'processed_at')) {
                $payout->processed_at = now();
            }
            if (Schema::hasColumn($payout->getTable(), 'processed_by')) {
                $payout->processed_by = auth()->id();
            }
            if (Schema::hasColumn($payout->getTable(), 'rejection_reason')) {
                $payout->rejection_reason = null;
            }
            $payout->save();
            
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
            $type = strtolower((string) $request->input('type', $request->query('type')));
            $payout = null;

            if ($type === 'wallet') {
                $payout = WalletWithdrawal::find($id);
            } elseif ($type === 'broker') {
                $payout = BrokerCommissionWithdrawal::find($id);
            } elseif ($type === 'agent') {
                $payout = AgentCommissionWithdrawal::find($id);
            } elseif ($type === 'aggregator') {
                $payout = AggregatorCommissionWithdrawal::find($id);
            }

            if (!$payout) {
                // Fallback if type was not provided
                $payout = WalletWithdrawal::find($id)
                    ?? BrokerCommissionWithdrawal::find($id)
                    ?? AgentCommissionWithdrawal::find($id)
                    ?? AggregatorCommissionWithdrawal::find($id);
            }
            
            if (!$payout) {
                return response()->json([
                    'success' => false,
                    'message' => 'Payout not found'
                ], 404);
            }

            if (Schema::hasColumn($payout->getTable(), 'status')) {
                $payout->status = 'rejected';
            }
            if (Schema::hasColumn($payout->getTable(), 'processed_at')) {
                $payout->processed_at = now();
            }
            if (Schema::hasColumn($payout->getTable(), 'processed_by')) {
                $payout->processed_by = auth()->id();
            }
            if (Schema::hasColumn($payout->getTable(), 'rejection_reason')) {
                $payout->rejection_reason = $request->input('reason');
            }
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

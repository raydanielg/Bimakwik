<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Commission;
use App\Models\PayoutRequest;
use App\Models\Wallet;

class FinanceController extends Controller
{
    public function walletBalances()
    {
        $wallets = Wallet::with('user')->paginate(20);
        $totalBalance = Wallet::sum('balance');
        $totalPending = PayoutRequest::where('status', 'pending')->sum('amount');
        return view('admin.finance.wallet', compact('wallets', 'totalBalance', 'totalPending'));
    }

    public function premiumCollections()
    {
        $collections = Transaction::where('type', 'premium')->with('user', 'policy')->paginate(20);
        $totalCollected = Transaction::where('type', 'premium')->sum('amount');
        return view('admin.finance.premiums', compact('collections', 'totalCollected'));
    }

    public function commissions()
    {
        $commissions = Commission::with('user', 'policy')->paginate(20);
        $totalCommissions = Commission::sum('amount');
        $paidCommissions = Commission::where('status', 'paid')->sum('amount');
        return view('admin.finance.commissions', compact('commissions', 'totalCommissions', 'paidCommissions'));
    }

    public function payoutRequests()
    {
        $payouts = PayoutRequest::with('user')->paginate(20);
        $pendingPayouts = PayoutRequest::where('status', 'pending')->sum('amount');
        return view('admin.finance.payouts', compact('payouts', 'pendingPayouts'));
    }
}

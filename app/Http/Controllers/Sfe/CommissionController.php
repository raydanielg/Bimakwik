<?php

namespace App\Http\Controllers\Sfe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use Illuminate\Support\Facades\Auth;

class CommissionController extends Controller
{
    public function index()
    {
        $wallet = Wallet::where('user_id', Auth::id())->first();
        $transactions = $wallet
            ? WalletTransaction::where('wallet_id', $wallet->id)->latest()->take(10)->get()
            : collect();

        return view('sfe.commissions.index', [
            'wallet' => $wallet,
            'transactions' => $transactions,
            'creditTotal' => $transactions->where('transaction_type', 'credit')->sum('amount'),
            'debitTotal' => $transactions->where('transaction_type', 'debit')->sum('amount'),
        ]);
    }
}

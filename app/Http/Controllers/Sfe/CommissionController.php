<?php

namespace App\Http\Controllers\Sfe;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\CommissionTransaction;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommissionController extends Controller
{
    public function index()
    {
        $wallet = Wallet::where('user_id', Auth::id())->first();
        $transactions = $wallet
            ? WalletTransaction::where('wallet_id', $wallet->id)->latest()->take(10)->get()
            : collect();

        $agent = Agent::where('user_id', Auth::id())->first();
        $commissions = $agent
            ? CommissionTransaction::where('recipient_type', 'sfe_user')
                ->where('recipient_id', $agent->id)
                ->with(['customerPolicy.customer', 'customerPolicy.product'])
                ->latest()->paginate(15)
            : collect();

        return view('sfe.commissions.index', [
            'wallet' => $wallet,
            'transactions' => $transactions,
            'creditTotal' => $transactions->where('transaction_type', 'credit')->sum('amount'),
            'debitTotal' => $transactions->where('transaction_type', 'debit')->sum('amount'),
            'commissions' => $commissions,
        ]);
    }
}

<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wallet;
use App\Models\WalletTransaction;

class CustomerWalletController extends Controller
{
    public function index()
    {
        $wallet = null;
        $transactions = collect();
        
        try {
            $wallet = Wallet::where('user_id', auth()->id())->first();
            if ($wallet) {
                $transactions = WalletTransaction::where('wallet_id', $wallet->id)
                    ->latest()
                    ->paginate(15);
            }
        } catch (\Exception $e) {}
        
        return view('customer.wallet.index', compact('wallet', 'transactions'));
    }

    public function addFunds(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:1000',
            'payment_method' => 'required|string',
        ]);

        try {
            $wallet = Wallet::where('user_id', auth()->id())->first();
            if ($wallet) {
                $wallet->balance += $validated['amount'];
                $wallet->save();
                
                WalletTransaction::create([
                    'wallet_id' => $wallet->id,
                    'type' => 'credit',
                    'amount' => $validated['amount'],
                    'description' => 'Funds added via ' . $validated['payment_method'],
                    'status' => 'completed',
                    'reference' => 'ADD-' . time(),
                ]);
            }
            return back()->with('success', 'Funds added successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to add funds');
        }
    }
}

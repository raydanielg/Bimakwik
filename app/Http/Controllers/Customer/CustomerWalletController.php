<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wallet;
use App\Models\WalletTransaction;

class CustomerWalletController extends Controller
{
    private function getOrCreateWallet()
    {
        $wallet = Wallet::where('user_id', auth()->id())->first();
        if (!$wallet) {
            $wallet = Wallet::create([
                'user_id' => auth()->id(),
                'balance' => 0,
                'currency' => 'TZS',
                'status' => 'active',
            ]);
        }
        return $wallet;
    }

    public function index()
    {
        $wallet = null;
        $transactions = collect();
        
        try {
            $wallet = $this->getOrCreateWallet();
            $transactions = WalletTransaction::where('wallet_id', $wallet->id)
                ->latest()
                ->paginate(15);
        } catch (\Exception $e) {}
        
        return view('customer.wallet.index', compact('wallet', 'transactions'));
    }

    public function addFundsPage()
    {
        $wallet = null;
        try {
            $wallet = $this->getOrCreateWallet();
        } catch (\Exception $e) {}
        return view('customer.wallet.add-funds', compact('wallet'));
    }

    public function history()
    {
        $wallet = null;
        $transactions = collect();
        try {
            $wallet = $this->getOrCreateWallet();
            $transactions = WalletTransaction::where('wallet_id', $wallet->id)
                ->latest()
                ->paginate(20);
        } catch (\Exception $e) {}
        return view('customer.wallet.history', compact('wallet', 'transactions'));
    }

    public function addFunds(Request $request)
    {
        $amount = $request->input('custom_amount') ?: $request->input('amount');
        $request->merge(['amount' => $amount]);

        $validated = $request->validate([
            'amount' => 'required|numeric|min:1000',
            'payment_method' => 'required|string',
        ]);

        try {
            $wallet = $this->getOrCreateWallet();
            $wallet->balance += $validated['amount'];
            $wallet->save();
            
            WalletTransaction::create([
                'wallet_id' => $wallet->id,
                'type' => 'credit',
                'amount' => $validated['amount'],
                'description' => 'Funds added via ' . $validated['payment_method'],
                'status' => 'completed',
                'reference' => 'ADD-' . strtoupper(substr(uniqid(), -8)),
            ]);

            return redirect()->route('customer.wallet.index')->with('success', 'TZS ' . number_format($validated['amount'], 0) . ' added to your wallet successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to add funds: ' . $e->getMessage());
        }
    }
}

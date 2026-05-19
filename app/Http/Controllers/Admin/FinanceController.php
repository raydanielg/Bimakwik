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
    public function wallets()
    {
        $wallets = Wallet::with('user')->paginate(20);
        $totalBalance = Wallet::sum('balance');
        $totalPending = PayoutRequest::where('status', 'pending')->sum('amount');
        return view('admin.finance.wallets', compact('wallets', 'totalBalance', 'totalPending'));
    }

    public function premiums()
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

    public function payouts()
    {
        $payouts = PayoutRequest::with('user')->paginate(20);
        $pendingPayouts = PayoutRequest::where('status', 'pending')->sum('amount');
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

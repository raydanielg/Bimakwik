<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerPolicy;
use App\Models\Claim;
use App\Models\Wallet;
use Illuminate\Support\Facades\DB;

class CustomerDashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        
        $stats = [
            'active_policies' => 0,
            'total_claims' => 0,
            'pending_claims' => 0,
            'wallet_balance' => 0,
        ];

        try {
            $stats['active_policies'] = CustomerPolicy::where('customer_id', $userId)
                ->where('status', 'active')->count() ?? 0;
            $stats['total_claims'] = Claim::where('customer_id', $userId)->count() ?? 0;
            $stats['pending_claims'] = Claim::where('customer_id', $userId)
                ->where('status', 'pending')->count() ?? 0;
            
            $wallet = Wallet::where('user_id', $userId)->first();
            $stats['wallet_balance'] = $wallet->balance ?? 0;
        } catch (\Exception $e) {}

        return view('customer.dashboard', compact('stats'));
    }
}

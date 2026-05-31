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

        $recentPolicies = collect();

        try {
            $customerId = DB::table('customers')->where('user_id', $userId)->value('id');

            if ($customerId) {
                $stats['active_policies'] = CustomerPolicy::where('customer_id', $customerId)
                    ->where('status', 'active')->count();
                $stats['total_claims'] = Claim::where('customer_id', $customerId)->count();
                $stats['pending_claims'] = Claim::where('customer_id', $customerId)
                    ->whereIn('status', ['submitted', 'pending', 'under_review'])->count();

                $recentPolicies = CustomerPolicy::where('customer_id', $customerId)
                    ->with(['product', 'insurer'])
                    ->latest()
                    ->take(5)
                    ->get();
            }

            $wallet = Wallet::where('user_id', $userId)->first();
            if (!$wallet) {
                $wallet = Wallet::create([
                    'user_id' => $userId,
                    'balance' => 0,
                    'currency' => 'TZS',
                    'status' => 'active',
                ]);
            }
            $stats['wallet_balance'] = $wallet->balance ?? 0;
        } catch (\Exception $e) {}

        return view('customer.dashboard', compact('stats', 'recentPolicies'));
    }
}

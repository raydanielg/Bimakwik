<?php

namespace App\Http\Controllers\Sfe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Claim;
use App\Models\Customer;
use App\Models\CustomerPolicy;
use App\Models\Product;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $customer = Customer::where('user_id', $userId)->first();
        $customerId = $customer?->id;
        $wallet = Wallet::where('user_id', $userId)->first();

        $policies = $customerId
            ? CustomerPolicy::where('customer_id', $customerId)->latest()->take(5)->get()
            : collect();

        $claims = $customerId
            ? Claim::where('customer_id', $customerId)->latest()->take(5)->get()
            : collect();

        $recentTransactions = $wallet
            ? WalletTransaction::where('wallet_id', $wallet->id)->latest()->take(5)->get()
            : collect();

        return view('sfe.dashboard', [
            'customer' => $customer,
            'wallet' => $wallet,
            'activePoliciesCount' => $policies->where('status', 'active')->count(),
            'totalPremiums' => $policies->sum('premium_amount'),
            'openClaimsCount' => $claims->whereIn('status', ['submitted', 'processing', 'under_review'])->count(),
            'approvedClaimsTotal' => $claims->sum('approved_amount'),
            'recentPolicies' => $policies,
            'recentClaims' => $claims,
            'recentTransactions' => $recentTransactions,
            'featuredProducts' => Product::where('is_active', true)->latest()->take(4)->get(),
        ]);
    }
}

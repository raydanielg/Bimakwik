<?php

namespace App\Http\Controllers\Broker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerPolicy;
use App\Models\User;
use App\Models\BrokerCommission;
use App\Models\Claim;
use App\Models\InsuranceProduct;

class BrokerHubController extends Controller
{
    public function policies()
    {
        $policies = collect(); $totalCount = 0; $activeCount = 0; $expiredCount = 0;
        try {
            $policies = CustomerPolicy::with('customer', 'product')->latest()->paginate(15);
            $totalCount = CustomerPolicy::count();
            $activeCount = CustomerPolicy::where('status', 'active')->count();
            $expiredCount = CustomerPolicy::where('status', 'expired')->count();
        } catch (\Exception $e) {}
        return view('broker.policies.index', compact('policies', 'totalCount', 'activeCount', 'expiredCount'));
    }

    public function customers()
    {
        $customers = collect();
        try { $customers = User::role('customer')->with('customerProfile')->paginate(15); } catch (\Exception $e) {}
        return view('broker.customers.index', compact('customers'));
    }

    public function commissions()
    {
        $commissions = collect(); $totalEarned = 0; $pendingAmount = 0;
        try {
            $commissions = BrokerCommission::latest()->paginate(15);
            $totalEarned = BrokerCommission::where('status', 'paid')->sum('amount') ?? 0;
            $pendingAmount = BrokerCommission::where('status', 'pending')->sum('amount') ?? 0;
        } catch (\Exception $e) {}
        return view('broker.commissions.index', compact('commissions', 'totalEarned', 'pendingAmount'));
    }

    public function reports()
    {
        $reports = collect();
        try { $reports = \App\Models\Report::latest()->paginate(15); } catch (\Exception $e) {}
        return view('broker.reports.index', compact('reports'));
    }

    public function products()
    {
        $products = collect();
        try { $products = InsuranceProduct::where('status', 'active')->latest()->paginate(15); } catch (\Exception $e) {}
        return view('broker.products.index', compact('products'));
    }

    public function claims()
    {
        $claims = collect();
        try { $claims = Claim::with('customer')->latest()->paginate(15); } catch (\Exception $e) {}
        return view('broker.claims.index', compact('claims'));
    }
}

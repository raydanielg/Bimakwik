<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerPolicy;
use App\Models\User;
use App\Models\AgentCommission;
use App\Models\Claim;
use App\Models\InsuranceProduct;

class AgentHubController extends Controller
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
        return view('agent.policies.index', compact('policies', 'totalCount', 'activeCount', 'expiredCount'));
    }

    public function customers()
    {
        $customers = collect();
        try { $customers = User::role('customer')->with('customerProfile')->paginate(15); } catch (\Exception $e) {}
        return view('agent.customers.index', compact('customers'));
    }

    public function commissions()
    {
        $commissions = collect(); $totalEarned = 0; $pendingAmount = 0;
        try {
            $commissions = AgentCommission::latest()->paginate(15);
            $totalEarned = AgentCommission::where('status', 'paid')->sum('amount') ?? 0;
            $pendingAmount = AgentCommission::where('status', 'pending')->sum('amount') ?? 0;
        } catch (\Exception $e) {}
        return view('agent.commissions.index', compact('commissions', 'totalEarned', 'pendingAmount'));
    }

    public function reports()
    {
        $reports = collect();
        try { $reports = \App\Models\Report::latest()->paginate(15); } catch (\Exception $e) {}
        return view('agent.reports.index', compact('reports'));
    }

    public function products()
    {
        $products = collect();
        try { $products = InsuranceProduct::where('status', 'active')->latest()->paginate(15); } catch (\Exception $e) {}
        return view('agent.products.index', compact('products'));
    }

    public function claims()
    {
        $claims = collect();
        try { $claims = Claim::with('customer')->latest()->paginate(15); } catch (\Exception $e) {}
        return view('agent.claims.index', compact('claims'));
    }
}

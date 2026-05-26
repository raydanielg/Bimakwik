<?php

namespace App\Http\Controllers\Aggregator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerPolicy;
use App\Models\User;
use App\Models\BrokerCommission;
use App\Models\AgentCommission;
use App\Models\Claim;
use App\Models\InsuranceProduct;

class AggregatorHubController extends Controller
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
        return view('aggregator.policies.index', compact('policies', 'totalCount', 'activeCount', 'expiredCount'));
    }

    public function customers()
    {
        $customers = collect();
        try { $customers = User::role('customer')->with('customerProfile')->paginate(15); } catch (\Exception $e) {}
        return view('aggregator.customers.index', compact('customers'));
    }

    public function commissions()
    {
        $brokerComm = collect(); $agentComm = collect(); $totalEarned = 0; $pendingAmount = 0;
        try {
            $brokerComm = BrokerCommission::latest()->paginate(15);
            $agentComm = AgentCommission::latest()->paginate(15);
            $totalEarned = BrokerCommission::where('status', 'paid')->sum('amount') + AgentCommission::where('status', 'paid')->sum('amount') ?? 0;
            $pendingAmount = BrokerCommission::where('status', 'pending')->sum('amount') + AgentCommission::where('status', 'pending')->sum('amount') ?? 0;
        } catch (\Exception $e) {}
        return view('aggregator.commissions.index', compact('brokerComm', 'agentComm', 'totalEarned', 'pendingAmount'));
    }

    public function reports()
    {
        $reports = collect();
        try { $reports = \App\Models\Report::latest()->paginate(15); } catch (\Exception $e) {}
        return view('aggregator.reports.index', compact('reports'));
    }

    public function brokers()
    {
        $brokers = collect();
        try { $brokers = User::role('broker')->with('brokerProfile')->paginate(15); } catch (\Exception $e) {}
        return view('aggregator.brokers.index', compact('brokers'));
    }

    public function agents()
    {
        $agents = collect();
        try { $agents = User::role(['sfe', 'bancassurance'])->with('agentProfile')->paginate(15); } catch (\Exception $e) {}
        return view('aggregator.agents.index', compact('agents'));
    }

    public function products()
    {
        $products = collect();
        try { $products = InsuranceProduct::where('status', 'active')->latest()->paginate(15); } catch (\Exception $e) {}
        return view('aggregator.products.index', compact('products'));
    }
}

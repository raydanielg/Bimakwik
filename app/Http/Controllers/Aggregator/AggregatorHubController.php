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
use App\Models\Aggregator;
use App\Models\AggregatorCommission;
use App\Models\AggregatorCommissionWithdrawal;
use App\Models\AggregatorReferralLink;
use App\Models\AggregatorReferralClick;
use App\Models\AggregatorReferralSale;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AggregatorHubController extends Controller
{
    private function getAggregator()
    {
        return Aggregator::where('user_id', Auth::id())->first();
    }

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

    // ─── Market Monitoring ────────────────────────────────────────────────────

    public function trafficMetrics()
    {
        $totalClicks = 0; $totalLinks = 0; $clicksThisMonth = 0; $recentClicks = collect(); $dailyData = []; $labels = [];
        try {
            $aggregator = $this->getAggregator();
            if ($aggregator) {
                $links = AggregatorReferralLink::where('aggregator_id', $aggregator->id)->pluck('id');
                $totalLinks = $links->count();
                $totalClicks = AggregatorReferralClick::whereIn('referral_link_id', $links)->count();
                $clicksThisMonth = AggregatorReferralClick::whereIn('referral_link_id', $links)
                    ->where('created_at', '>=', Carbon::now()->startOfMonth())->count();
                $recentClicks = AggregatorReferralClick::whereIn('referral_link_id', $links)->latest()->take(20)->get();
                $daily = AggregatorReferralClick::whereIn('referral_link_id', $links)
                    ->where('created_at', '>=', Carbon::now()->subDays(14))
                    ->selectRaw('DATE(created_at) as day, COUNT(*) as total')
                    ->groupBy('day')->orderBy('day')->get();
                $labels = $daily->pluck('day')->toArray();
                $dailyData = $daily->pluck('total')->toArray();
            }
        } catch (\Exception $e) {}
        return view('aggregator.market.traffic', compact('totalClicks', 'totalLinks', 'clicksThisMonth', 'recentClicks', 'labels', 'dailyData'));
    }

    public function leadGeneration()
    {
        $totalLeads = 0; $convertedLeads = 0; $conversionRate = 0; $recentSales = collect();
        try {
            $aggregator = $this->getAggregator();
            if ($aggregator) {
                $links = AggregatorReferralLink::where('aggregator_id', $aggregator->id)->pluck('id');
                $totalLeads = AggregatorReferralClick::whereIn('referral_link_id', $links)->count();
                $convertedLeads = AggregatorReferralSale::whereIn('referral_link_id', $links)->count();
                $conversionRate = $totalLeads > 0 ? round(($convertedLeads / $totalLeads) * 100, 1) : 0;
                $recentSales = AggregatorReferralSale::whereIn('referral_link_id', $links)->latest()->paginate(15);
            }
        } catch (\Exception $e) {}
        return view('aggregator.market.leads', compact('totalLeads', 'convertedLeads', 'conversionRate', 'recentSales'));
    }

    public function aiMarketInsights()
    {
        $topProducts = collect(); $labels = []; $monthlyData = []; $totalPolicies = 0; $totalBrokers = 0;
        try {
            $topProducts = InsuranceProduct::withCount(['customerPolicies as policies_count'])->orderByDesc('policies_count')->take(6)->get();
            $totalPolicies = \App\Models\CustomerPolicy::count();
            $totalBrokers = \App\Models\User::role('broker')->count();
            $monthly = AggregatorCommission::where('created_at', '>=', Carbon::now()->subMonths(6))
                ->selectRaw('DATE_FORMAT(created_at, "%b %Y") as month, SUM(amount) as total')
                ->groupByRaw('DATE_FORMAT(created_at, "%b %Y")')
                ->orderBy('created_at')->get();
            $labels = $monthly->pluck('month')->toArray();
            $monthlyData = $monthly->pluck('total')->toArray();
        } catch (\Exception $e) {}
        return view('aggregator.market.ai-insights', compact('topProducts', 'labels', 'monthlyData', 'totalPolicies', 'totalBrokers'));
    }

    // ─── Product Comparison ───────────────────────────────────────────────────

    public function productCompare()
    {
        $products = collect();
        try { $products = InsuranceProduct::where('status', 'active')->with(['productBenefits', 'productCategory'])->get(); } catch (\Exception $e) {}
        return view('aggregator.products.compare', compact('products'));
    }

    public function productSideBySide()
    {
        $products = collect();
        try { $products = InsuranceProduct::where('status', 'active')->with(['productBenefits', 'productCategory'])->get(); } catch (\Exception $e) {}
        return view('aggregator.products.side-by-side', compact('products'));
    }

    public function productAiCompare()
    {
        $products = collect();
        try { $products = InsuranceProduct::where('status', 'active')->with(['productBenefits'])->get(); } catch (\Exception $e) {}
        return view('aggregator.products.ai-compare', compact('products'));
    }

    // ─── Finance / Wallet ─────────────────────────────────────────────────────

    public function wallet()
    {
        $wallet = null; $recentTransactions = collect(); $totalCommission = 0; $pendingWithdrawals = collect();
        try {
            $wallet = Wallet::where('user_id', Auth::id())->first();
            if ($wallet) {
                $recentTransactions = WalletTransaction::where('wallet_id', $wallet->id)->latest()->take(10)->get();
            }
            $aggregator = $this->getAggregator();
            if ($aggregator) {
                $totalCommission = AggregatorCommission::where('aggregator_id', $aggregator->id)->sum('amount');
                $pendingWithdrawals = AggregatorCommissionWithdrawal::where('aggregator_id', $aggregator->id)->latest()->paginate(10);
            }
        } catch (\Exception $e) {}
        return view('aggregator.wallet.index', compact('wallet', 'recentTransactions', 'totalCommission', 'pendingWithdrawals'));
    }
}

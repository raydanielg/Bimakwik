<?php

namespace App\Http\Controllers\Aggregator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerPolicy;
use App\Models\User;
use App\Models\BrokerCommission;
use App\Models\AgentCommission;
use App\Models\PaymentTransaction;
use App\Models\Claim;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPolicies = 0;
        $activePolicies = 0;
        $totalBrokers = 0;
        $totalAgents = 0;
        $totalCommission = 0;
        $pendingCommission = 0;
        $totalClaims = 0;
        $monthlyRevenue = [];
        $recentPolicies = collect();
        $topBrokers = collect();

        try {
            $totalPolicies = CustomerPolicy::count() ?? 0;
            $activePolicies = CustomerPolicy::where('status', 'active')->count() ?? 0;
            $totalBrokers = User::role('broker')->count() ?? 0;
            $totalAgents = User::role(['sfe', 'bancassurance'])->count() ?? 0;

            $totalCommission = BrokerCommission::where('status', 'paid')->sum('commission_amount') + AgentCommission::where('status', 'paid')->sum('commission_amount') ?? 0;
            $pendingCommission = BrokerCommission::where('status', 'pending')->sum('commission_amount') + AgentCommission::where('status', 'pending')->sum('commission_amount') ?? 0;

            $totalClaims = Claim::count() ?? 0;

            $monthlyRevenue = PaymentTransaction::where('created_at', '>=', Carbon::now()->subMonths(12))
                ->select(DB::raw("strftime('%Y-%m', created_at) as month"), DB::raw('COALESCE(SUM(amount), 0) as total'))
                ->groupBy('month')
                ->orderBy('month')
                ->get() ?? collect();

            $recentPolicies = CustomerPolicy::with('customer', 'product')->latest()->limit(5)->get() ?? collect();

            $topBrokers = User::role('broker')->with('brokerProfile')->limit(5)->get() ?? collect();

        } catch (\Exception $e) {
            // Fallback to defaults if queries fail
        }

        return view('aggregator.dashboard', compact(
            'totalPolicies',
            'activePolicies',
            'totalBrokers',
            'totalAgents',
            'totalCommission',
            'pendingCommission',
            'totalClaims',
            'monthlyRevenue',
            'recentPolicies',
            'topBrokers'
        ));
    }
}

<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerPolicy;
use App\Models\User;
use App\Models\AgentCommission;
use App\Models\PaymentTransaction;
use App\Models\Claim;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AgentDashboardController extends Controller
{
    public function index()
    {
        $totalPolicies = 0;
        $activePolicies = 0;
        $totalCustomers = 0;
        $totalCommission = 0;
        $pendingCommission = 0;
        $totalClaims = 0;
        $monthlyRevenue = [];
        $recentPolicies = collect();
        $topProducts = collect();

        try {
            $totalPolicies = CustomerPolicy::count() ?? 0;
            $activePolicies = CustomerPolicy::where('status', 'active')->count() ?? 0;
            $totalCustomers = User::role('customer')->count() ?? 0;

            $totalCommission = AgentCommission::where('status', 'paid')->sum('commission_amount') ?? 0;
            $pendingCommission = AgentCommission::where('status', 'pending')->sum('commission_amount') ?? 0;

            $totalClaims = Claim::count() ?? 0;

            $monthlyRevenue = PaymentTransaction::where('created_at', '>=', Carbon::now()->subMonths(12))
                ->select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'), DB::raw('COALESCE(SUM(amount), 0) as total'))
                ->groupBy('month')
                ->orderBy('month')
                ->get() ?? collect();

            $recentPolicies = CustomerPolicy::with(['customer', 'product'])->latest()->limit(5)->get() ?? collect();

            $topProducts = \App\Models\InsuranceProduct::withCount('customerPolicies')
                ->orderBy('customer_policies_count', 'desc')
                ->limit(5)
                ->get() ?? collect();

        } catch (\Exception $e) {
            // Fallback to defaults if queries fail
        }

        return view('agent.dashboard', compact(
            'totalPolicies',
            'activePolicies',
            'totalCustomers',
            'totalCommission',
            'pendingCommission',
            'totalClaims',
            'monthlyRevenue',
            'recentPolicies',
            'topProducts'
        ));
    }
}

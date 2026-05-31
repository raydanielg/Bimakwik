<?php

namespace App\Http\Controllers\Broker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerPolicy;
use App\Models\User;
use App\Models\BrokerCommission;
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
        $totalCustomers = 0;
        $totalCommission = 0;
        $pendingCommission = 0;
        $totalClaims = 0;
        $monthlyRevenue = [];
        $recentPolicies = collect();
        $topProducts = collect();

        try {
            $totalPolicies = CustomerPolicy::whereHas('customer', function($q) {
                $q->whereHas('roles', function($r) { $r->where('name', 'broker'); });
            })->count() ?? 0;

            $activePolicies = CustomerPolicy::where('status', 'active')
                ->whereHas('customer', function($q) {
                    $q->whereHas('roles', function($r) { $r->where('name', 'broker'); });
                })->count() ?? 0;

            $totalCustomers = User::role('customer')->count() ?? 0;

            $totalCommission = BrokerCommission::sum('commission_amount') ?? 0;
            $pendingCommission = BrokerCommission::where('status', 'pending')->sum('commission_amount') ?? 0;

            $totalClaims = Claim::count() ?? 0;

            $monthlyRevenue = PaymentTransaction::where('created_at', '>=', Carbon::now()->subMonths(12))
                ->select(DB::raw("strftime('%Y-%m', created_at) as month"), DB::raw('COALESCE(SUM(amount), 0) as total'))
                ->groupBy('month')
                ->orderBy('month')
                ->get() ?? collect();

            $recentPolicies = CustomerPolicy::with('customer', 'product')
                ->whereHas('customer', function($q) {
                    $q->whereHas('roles', function($r) { $r->where('name', 'broker'); });
                })
                ->latest()
                ->limit(5)
                ->get() ?? collect();

            $topProducts = \App\Models\InsuranceProduct::withCount('customerPolicies')
                ->orderBy('customer_policies_count', 'desc')
                ->limit(5)
                ->get() ?? collect();

        } catch (\Exception $e) {
            // Fallback to defaults if queries fail
        }

        return view('broker.dashboard', compact(
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

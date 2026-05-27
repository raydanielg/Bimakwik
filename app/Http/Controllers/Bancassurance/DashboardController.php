<?php

namespace App\Http\Controllers\Bancassurance;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\AgentCommission;
use App\Models\CustomerPolicy;
use App\Models\PolicyRenewal;
use App\Models\InsuranceProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $agent = Agent::where('user_id', $userId)->first();

        if (!$agent) {
            return view('bancassurance.dashboard', [
                'agent' => null,
                'totalSales' => 0,
                'totalCommission' => 0,
                'policiesSold' => 0,
                'pendingRenewals' => 0,
                'recentPolicies' => collect(),
                'monthlySalesData' => [],
                'monthLabels' => [],
            ]);
        }

        $agentId = $agent->id;

        // Total sales (premium amount from commissions)
        $totalSales = AgentCommission::where('agent_id', $agentId)->sum('premium_amount');

        // Total commission earned
        $totalCommission = AgentCommission::where('agent_id', $agentId)
            ->where('status', 'paid')
            ->sum('commission_amount');

        // Policies sold count
        $policiesSold = AgentCommission::where('agent_id', $agentId)->distinct('customer_policy_id')->count('customer_policy_id');

        // Pending renewals for customers this agent sold to
        $agentPolicyIds = AgentCommission::where('agent_id', $agentId)->pluck('customer_policy_id');
        $pendingRenewals = PolicyRenewal::whereIn('customer_policy_id', $agentPolicyIds)
            ->where('status', 'pending')
            ->count();

        // Recent policies sold by this agent (via commissions)
        $recentPolicies = AgentCommission::where('agent_id', $agentId)
            ->with(['customerPolicy.customer.user', 'insuranceProduct'])
            ->latest()
            ->take(10)
            ->get();

        // Monthly sales data for chart (last 7 days for weekly view)
        $weekDays = [];
        $weekSales = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $weekDays[] = $date->format('D');
            $weekSales[] = round(AgentCommission::where('agent_id', $agentId)
                ->whereDate('created_at', $date->toDateString())
                ->sum('premium_amount') / 1000000, 2);
        }

        // Monthly labels and data for the monthly chart
        $monthLabels = [];
        $monthSales = [];
        for ($i = 3; $i >= 0; $i--) {
            $weekStart = Carbon::now()->subWeeks($i)->startOfWeek();
            $weekEnd = Carbon::now()->subWeeks($i)->endOfWeek();
            $monthLabels[] = 'Week ' . (4 - $i);
            $monthSales[] = round(AgentCommission::where('agent_id', $agentId)
                ->whereBetween('created_at', [$weekStart, $weekEnd])
                ->sum('premium_amount') / 1000000, 2);
        }

        return view('bancassurance.dashboard', [
            'agent' => $agent,
            'totalSales' => $totalSales,
            'totalCommission' => $totalCommission,
            'policiesSold' => $policiesSold,
            'pendingRenewals' => $pendingRenewals,
            'recentPolicies' => $recentPolicies,
            'weeklyLabels' => $weekDays,
            'weeklySales' => $weekSales,
            'monthlyLabels' => $monthLabels,
            'monthlySales' => $monthSales,
        ]);
    }
}

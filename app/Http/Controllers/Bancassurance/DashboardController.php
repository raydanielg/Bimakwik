<?php

namespace App\Http\Controllers\Bancassurance;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\AgentCommission;
use App\Models\CommissionTransaction;
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
                'weeklyLabels' => [],
                'weeklySales' => [],
                'monthlyLabels' => [],
                'monthlySales' => [],
            ]);
        }

        $agentId = $agent->id;

        // Total sales (premium amount from commissions - both old and new)
        $totalSales = AgentCommission::where('agent_id', $agentId)->sum('premium_amount')
            + CommissionTransaction::where('recipient_type', 'bancassurance_user')
                ->where('recipient_id', $agentId)
                ->sum('premium_amount');

        // Total commission earned
        $oldPaid = AgentCommission::where('agent_id', $agentId)->where('status', 'paid')->sum('commission_amount');
        $newPaid = CommissionTransaction::where('recipient_type', 'bancassurance_user')
            ->where('recipient_id', $agentId)->where('status', 'paid')->sum('commission_amount');
        $totalCommission = $oldPaid + $newPaid;

        // Policies sold count
        $oldPolicies = AgentCommission::where('agent_id', $agentId)->distinct('customer_policy_id')->count('customer_policy_id');
        $newPolicies = CommissionTransaction::where('recipient_type', 'bancassurance_user')
            ->where('recipient_id', $agentId)->distinct('customer_policy_id')->count('customer_policy_id');
        $policiesSold = $oldPolicies + $newPolicies;

        // Policy IDs from both systems
        $agentPolicyIds = AgentCommission::where('agent_id', $agentId)->pluck('customer_policy_id')
            ->merge(CommissionTransaction::where('recipient_type', 'bancassurance_user')
                ->where('recipient_id', $agentId)->pluck('customer_policy_id'));
        $pendingRenewals = PolicyRenewal::whereIn('customer_policy_id', $agentPolicyIds)
            ->where('status', 'pending')
            ->count();

        // Recent policies from new system
        $recentPolicies = CommissionTransaction::where('recipient_type', 'bancassurance_user')
            ->where('recipient_id', $agentId)
            ->with(['customerPolicy.customer.user', 'customerPolicy.product'])
            ->latest()
            ->take(10)
            ->get();

        // Weekly and monthly chart data from new system
        $weekDays = [];
        $weekSales = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $weekDays[] = $date->format('D');
            $oldSum = AgentCommission::where('agent_id', $agentId)->whereDate('created_at', $date->toDateString())->sum('premium_amount');
            $newSum = CommissionTransaction::where('recipient_type', 'bancassurance_user')
                ->where('recipient_id', $agentId)->whereDate('created_at', $date->toDateString())->sum('premium_amount');
            $weekSales[] = round(($oldSum + $newSum) / 1000000, 2);
        }

        $monthLabels = [];
        $monthSales = [];
        for ($i = 3; $i >= 0; $i--) {
            $weekStart = Carbon::now()->subWeeks($i)->startOfWeek();
            $weekEnd = Carbon::now()->subWeeks($i)->endOfWeek();
            $monthLabels[] = 'Week ' . (4 - $i);
            $oldSum = AgentCommission::where('agent_id', $agentId)->whereBetween('created_at', [$weekStart, $weekEnd])->sum('premium_amount');
            $newSum = CommissionTransaction::where('recipient_type', 'bancassurance_user')
                ->where('recipient_id', $agentId)->whereBetween('created_at', [$weekStart, $weekEnd])->sum('premium_amount');
            $monthSales[] = round(($oldSum + $newSum) / 1000000, 2);
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

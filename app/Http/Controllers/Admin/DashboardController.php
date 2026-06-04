<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\InsuranceProduct;
use App\Models\Claim;
use App\Models\PaymentTransaction;
use App\Models\Wallet;
use App\Models\BrokerCommission;
use App\Models\AgentCommission;
use App\Models\AggregatorCommission;
use App\Models\CustomerPolicy;
use App\Models\PolicyRenewal;
use App\Models\PolicyCancellation;
use App\Models\KycSubmission;
use App\Models\SupportTicket;
use App\Models\Notification;
use App\Models\LoginAttempt;
use App\Models\FinancingLoan;
use App\Models\PremiumFinancingRequest;
use App\Models\WorkflowExecution;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $period = $request->get('period', '30d');
        $range = match ($period) {
            '7d' => [Carbon::now()->subDays(7), Carbon::now()],
            '90d' => [Carbon::now()->subDays(90), Carbon::now()],
            '1y' => [Carbon::now()->subYear(), Carbon::now()],
            default => [Carbon::now()->subDays(30), Carbon::now()],
        };
        $startDate = $range[0];
        $endDate = $range[1];
        $prevRange = [$startDate->copy()->subDays($startDate->diffInDays($endDate)), $startDate->copy()];

        $totalUsers = User::count();
        $newUsersPeriod = safe_count(User::whereBetween('created_at', [$startDate, $endDate]));
        $usersGrowth = growth_rate(
            safe_count(User::whereBetween('created_at', [$prevRange[0], $prevRange[1]])),
            $newUsersPeriod
        );

        $totalPolicies = safe_count(CustomerPolicy::query());
        $activePolicies = safe_count(CustomerPolicy::where('status', 'active'));
        $policiesSoldPeriod = safe_count(CustomerPolicy::whereBetween('created_at', [$startDate, $endDate]));

        $totalRevenue = safe_sum(PaymentTransaction::where('status', 'completed'), 'amount');
        $revenuePeriod = safe_sum(PaymentTransaction::where('status', 'completed')->whereBetween('created_at', [$startDate, $endDate]), 'amount');
        $revenueGrowth = growth_rate(
            safe_sum(PaymentTransaction::where('status', 'completed')->whereBetween('created_at', [$prevRange[0], $prevRange[1]]), 'amount'),
            $revenuePeriod
        );

        $totalClaims = safe_count(Claim::query());
        $pendingClaims = safe_count(Claim::where('status', 'pending'));
        $approvedClaims = safe_count(Claim::where('status', 'approved'));
        $rejectedClaims = safe_count(Claim::where('status', 'rejected'));
        $claimsPeriod = safe_count(Claim::whereBetween('created_at', [$startDate, $endDate]));
        $claimsGrowth = growth_rate(
            safe_count(Claim::whereBetween('created_at', [$prevRange[0], $prevRange[1]])),
            $claimsPeriod
        );

        $totalProducts = safe_count(InsuranceProduct::query());
        $activeProducts = safe_count(InsuranceProduct::where('is_active', true));

        $totalWallets = safe_count(Wallet::query());
        $totalWalletBalance = safe_sum(Wallet::query(), 'balance');
        $activeWallets = safe_count(Wallet::where('is_active', true));

        $brokerComm = safe_sum(BrokerCommission::query(), 'commission_amount');
        $agentComm = safe_sum(AgentCommission::query(), 'commission_amount');
        $aggregatorComm = safe_sum(AggregatorCommission::query(), 'amount');
        $totalCommissions = $brokerComm + $agentComm + $aggregatorComm;
        $pendingCommissions = safe_sum(BrokerCommission::where('status', 'pending'), 'commission_amount')
            + safe_sum(AgentCommission::where('status', 'pending'), 'commission_amount')
            + safe_sum(AggregatorCommission::where('status', 'pending'), 'amount');
        $paidCommissions = max(0, $totalCommissions - $pendingCommissions);

        $totalKyc = safe_count(KycSubmission::query());
        $pendingKyc = safe_count(KycSubmission::where('status', 'pending'));
        $approvedKyc = safe_count(KycSubmission::where('status', 'approved'));

        $totalSupportTickets = safe_count(SupportTicket::query());
        $openTickets = safe_count(SupportTicket::whereIn('status', ['open', 'pending']));

        $totalNotifications = safe_count(Notification::query());
        $unreadNotifications = 0;
        try { $unreadNotifications = Notification::where('is_read', false)->count(); } catch (\Exception $e) {}

        $monthLabels = [];
        $revenueData = [];
        $userData = [];
        $policyData = [];
        $claimData = [];
        for ($i = 11; $i >= 0; $i--) {
            $m = Carbon::now()->subMonths($i);
            $monthLabels[] = $m->format('M Y');
            $mStart = $m->copy()->startOfMonth();
            $mEnd = $m->copy()->endOfMonth();
            $revenueData[] = safe_sum(PaymentTransaction::where('status', 'completed')->whereBetween('created_at', [$mStart, $mEnd]), 'amount');
            $userData[] = safe_count(User::whereBetween('created_at', [$mStart, $mEnd]));
            $policyData[] = safe_count(CustomerPolicy::whereBetween('created_at', [$mStart, $mEnd]));
            $claimData[] = safe_count(Claim::whereBetween('created_at', [$mStart, $mEnd]));
        }

        $roleNames = ['customer', 'broker', 'agent', 'insurer', 'aggregator', 'sfe', 'bancassurance', 'service-provider', 'regulator', 'financing-partner', 'developer', 'super-admin', 'sub-admin'];
        $usersByRole = collect();
        foreach ($roleNames as $r) {
            try {
                $role = Role::where('name', $r)->first();
                $cnt = $role ? $role->users()->count() : 0;
                if ($cnt > 0) $usersByRole->push((object)['name' => $r, 'count' => $cnt]);
            } catch (\Exception $e) {}
        }
        if ($usersByRole->isEmpty()) {
            $usersByRole = collect([
                (object)['name' => 'customer', 'count' => (int)($totalUsers * 0.7)],
                (object)['name' => 'broker', 'count' => (int)($totalUsers * 0.15)],
                (object)['name' => 'agent', 'count' => (int)($totalUsers * 0.1)],
                (object)['name' => 'admin', 'count' => max(1, $totalUsers - (int)($totalUsers * 0.95))],
            ]);
        }

        $pieColors = ['#0d6efd','#198754','#ffc107','#dc3545','#0dcaf0','#6f42c1','#fd7e14','#20c997','#e83e8c','#6610f2','#d63384','#0d6efd','#198754'];

        $recentUsers = safe_get(User::latest(), 7);
        $recentClaims = safe_get(Claim::with('customer')->latest(), 5);
        $recentTransactions = safe_get(PaymentTransaction::with('user')->latest(), 5);
        $recentPolicies = safe_get(CustomerPolicy::latest(), 5);
        $recentTickets = safe_get(SupportTicket::latest(), 5);

        $paymentMethods = collect();
        try {
            $paymentMethods = PaymentTransaction::where('status', 'completed')
                ->select('payment_method', DB::raw('COUNT(*) as count'), DB::raw('COALESCE(SUM(amount),0) as total'))
                ->groupBy('payment_method')
                ->get();
        } catch (\Exception $e) {}

        $paymentStatuses = collect();
        try {
            $paymentStatuses = PaymentTransaction::select('status', DB::raw('COUNT(*) as count'))
                ->groupBy('status')->get();
        } catch (\Exception $e) {}

        $topInsurers = collect();
        try {
            $topInsurers = CustomerPolicy::select('insurer_id', DB::raw('COUNT(*) as total_policies'), DB::raw('COALESCE(SUM(premium_amount),0) as total_premium'))
                ->groupBy('insurer_id')
                ->orderByDesc('total_policies')
                ->take(5)
                ->get();
        } catch (\Exception $e) {}

        $renewalsCount = safe_count(PolicyRenewal::whereBetween('created_at', [$startDate, $endDate]));
        $cancellationsCount = safe_count(PolicyCancellation::whereBetween('created_at', [$startDate, $endDate]));

        $financingRequests = safe_count(PremiumFinancingRequest::query());
        $pendingFinancing = safe_count(PremiumFinancingRequest::where('status', 'pending'));
        $activeLoans = safe_count(FinancingLoan::where('status', 'active'));

        $loginAttempts = safe_count(LoginAttempt::where('created_at', '>=', Carbon::today()->subDays(7)));
        $failedLogins = 0;
        try { $failedLogins = LoginAttempt::where('created_at', '>=', Carbon::today()->subDays(7))->where('success', false)->count(); } catch (\Exception $e) {}

        $workflowsRunning = safe_count(WorkflowExecution::where('status', 'running'));

        return view('admin.dashboard', compact(
            'totalUsers', 'newUsersPeriod', 'usersGrowth',
            'totalPolicies', 'activePolicies', 'policiesSoldPeriod',
            'totalRevenue', 'revenuePeriod', 'revenueGrowth',
            'totalClaims', 'pendingClaims', 'approvedClaims', 'rejectedClaims', 'claimsPeriod', 'claimsGrowth',
            'totalProducts', 'activeProducts',
            'totalWallets', 'totalWalletBalance', 'activeWallets',
            'totalCommissions', 'pendingCommissions', 'paidCommissions',
            'totalKyc', 'pendingKyc', 'approvedKyc',
            'totalSupportTickets', 'openTickets',
            'totalNotifications', 'unreadNotifications',
            'monthLabels', 'revenueData', 'userData', 'policyData', 'claimData',
            'usersByRole', 'pieColors',
            'recentUsers', 'recentClaims', 'recentTransactions', 'recentPolicies', 'recentTickets',
            'paymentMethods', 'paymentStatuses', 'topInsurers',
            'renewalsCount', 'cancellationsCount',
            'financingRequests', 'pendingFinancing', 'activeLoans',
            'loginAttempts', 'failedLogins',
            'workflowsRunning',
            'period', 'startDate', 'endDate',
        ));
    }

    public function aiInsights()
    {
        $fraudDetections = 0;
        $riskScoreLabel = 'Low';
        $riskScoreClass = 'success';
        $churnRate = 0;
        $atRiskCustomers = 0;
        $revenueForecast = 0;
        $recommendations = collect();
        $alerts = collect();

        try {
            $totalClaims = safe_count(Claim::query());
            $rejectedClaims = safe_count(Claim::where('status', 'rejected'));
            $pendingClaims = safe_count(Claim::where('status', 'pending'));
            $flaggedClaims = safe_count(Claim::whereIn('status', ['flagged', 'fraud_suspected']));
            $fraudDetections = $flaggedClaims + $rejectedClaims;

            $riskRatio = $totalClaims > 0 ? (($rejectedClaims + $pendingClaims) / $totalClaims) : 0;
            if ($riskRatio >= 0.25) {
                $riskScoreLabel = 'High';
                $riskScoreClass = 'danger';
            } elseif ($riskRatio >= 0.12) {
                $riskScoreLabel = 'Medium';
                $riskScoreClass = 'warning';
            }

            $totalPolicies = safe_count(CustomerPolicy::query());
            $cancelledPolicies = safe_count(CustomerPolicy::where('status', 'cancelled'));
            $churnRate = $totalPolicies > 0 ? round(($cancelledPolicies / $totalPolicies) * 100, 1) : 0;
            $atRiskCustomers = (int) round(safe_count(User::role('customer')->where('status', 'active')) * ($churnRate / 100));

            $today = Carbon::today();
            $currentRevenue = safe_sum(PaymentTransaction::where('status', 'completed')->where('created_at', '>=', $today->copy()->subDays(30)), 'amount');
            $previousRevenue = safe_sum(PaymentTransaction::where('status', 'completed')->whereBetween('created_at', [$today->copy()->subDays(60), $today->copy()->subDays(31)]), 'amount');
            $revenueForecast = round(growth_rate($previousRevenue, $currentRevenue), 1);

            $recommendations = collect([
                [
                    'icon' => 'shield-check',
                    'color' => 'success',
                    'title' => 'Maintain Portfolio Risk Controls',
                    'desc' => 'Current risk posture is ' . strtolower($riskScoreLabel) . ' based on live claims trend.',
                ],
                [
                    'icon' => 'people',
                    'color' => 'info',
                    'title' => 'Retention Focus Segment',
                    'desc' => $atRiskCustomers . ' customers are currently in the at-risk churn segment.',
                ],
                [
                    'icon' => 'graph-up-arrow',
                    'color' => $revenueForecast >= 0 ? 'primary' : 'warning',
                    'title' => 'Revenue Momentum',
                    'desc' => '30-day revenue trend is ' . ($revenueForecast >= 0 ? 'up' : 'down') . ' by ' . abs($revenueForecast) . '%.',
                ],
            ]);

            $alerts = Claim::latest()->limit(3)->get()->map(function ($claim) {
                $severity = match ($claim->status) {
                    'rejected', 'flagged', 'fraud_suspected' => 'high',
                    'pending', 'processing' => 'medium',
                    default => 'low',
                };

                return [
                    'severity' => $severity,
                    'title' => 'Claim #' . $claim->id . ' status: ' . ucfirst($claim->status ?? 'unknown'),
                    'desc' => 'Latest update from claim workflow and adjudication queue.',
                    'time' => optional($claim->updated_at ?? $claim->created_at)->diffForHumans() ?? 'N/A',
                ];
            });
        } catch (\Exception $e) {
        }

        return view('admin.ai-insights', compact(
            'fraudDetections', 'riskScoreLabel', 'riskScoreClass', 'churnRate', 'atRiskCustomers', 'revenueForecast',
            'recommendations', 'alerts'
        ));
    }
}

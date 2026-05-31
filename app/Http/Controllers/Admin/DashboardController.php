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
use App\Models\WalletTransaction;
use App\Models\BrokerCommission;
use App\Models\AgentCommission;
use App\Models\AggregatorCommission;
use App\Models\CustomerPolicy;
use App\Models\Product;
use App\Models\PolicyRenewal;
use App\Models\PolicyCancellation;
use App\Models\KycSubmission;
use App\Models\SupportTicket;
use App\Models\Notification;
use App\Models\SystemLog;
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

        $today = Carbon::today();
        $lastMonth = Carbon::now()->subMonth();

        $totalUsers = User::count();
        $newUsersPeriod = User::whereBetween('created_at', [$startDate, $endDate])->count();
        $usersGrowth = $this->growthRate(
            User::whereBetween('created_at', [$prevRange[0], $prevRange[1]])->count(),
            $newUsersPeriod
        );

        $totalPolicies = CustomerPolicy::count();
        $activePolicies = CustomerPolicy::where('status', 'active')->count();
        $policiesSoldPeriod = CustomerPolicy::whereBetween('created_at', [$startDate, $endDate])->count();

        $totalRevenue = PaymentTransaction::where('status', 'completed')->sum('amount') ?? 0;
        $revenuePeriod = PaymentTransaction::where('status', 'completed')->whereBetween('created_at', [$startDate, $endDate])->sum('amount') ?? 0;
        $revenueGrowth = $this->growthRate(
            PaymentTransaction::where('status', 'completed')->whereBetween('created_at', [$prevRange[0], $prevRange[1]])->sum('amount') ?? 0,
            $revenuePeriod
        );

        $totalClaims = Claim::count();
        $pendingClaims = Claim::where('status', 'pending')->count();
        $approvedClaims = Claim::where('status', 'approved')->count();
        $rejectedClaims = Claim::where('status', 'rejected')->count();
        $claimsPeriod = Claim::whereBetween('created_at', [$startDate, $endDate])->count();
        $claimsGrowth = $this->growthRate(
            Claim::whereBetween('created_at', [$prevRange[0], $prevRange[1]])->count(),
            $claimsPeriod
        );

        $totalProducts = InsuranceProduct::count();
        $activeProducts = InsuranceProduct::where('is_active', true)->count();

        $totalWallets = Wallet::count();
        $totalWalletBalance = Wallet::sum('balance') ?? 0;
        $activeWallets = Wallet::where('is_active', true)->count();

        $brokerComm = BrokerCommission::sum('commission_amount') ?? 0;
        $agentComm = AgentCommission::sum('commission_amount') ?? 0;
        $aggregatorComm = AggregatorCommission::sum('amount') ?? 0;
        $totalCommissions = $brokerComm + $agentComm + $aggregatorComm;
        $pendingCommissions = BrokerCommission::where('status', 'pending')->sum('commission_amount')
            + AgentCommission::where('status', 'pending')->sum('commission_amount')
            + AggregatorCommission::where('status', 'pending')->sum('amount');
        $paidCommissions = $totalCommissions - $pendingCommissions;

        $totalKyc = KycSubmission::count();
        $pendingKyc = KycSubmission::where('status', 'pending')->count();
        $approvedKyc = KycSubmission::where('status', 'approved')->count();

        $totalSupportTickets = SupportTicket::count();
        $openTickets = SupportTicket::whereIn('status', ['open', 'pending'])->count();

        $totalNotifications = Notification::count();
        $unreadNotifications = Notification::where('is_read', false)->count();

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
            $revenueData[] = (float) (PaymentTransaction::where('status', 'completed')->whereBetween('created_at', [$mStart, $mEnd])->sum('amount') ?? 0);
            $userData[] = (int) User::whereBetween('created_at', [$mStart, $mEnd])->count();
            $policyData[] = (int) CustomerPolicy::whereBetween('created_at', [$mStart, $mEnd])->count();
            $claimData[] = (int) Claim::whereBetween('created_at', [$mStart, $mEnd])->count();
        }

        $roleNames = ['customer', 'broker', 'agent', 'insurer', 'aggregator', 'sfe', 'bancassurance', 'service-provider', 'regulator', 'financing-partner', 'developer', 'super-admin', 'sub-admin'];
        $usersByRole = collect();
        foreach ($roleNames as $r) {
            $role = Role::where('name', $r)->first();
            $cnt = $role ? $role->users()->count() : 0;
            if ($cnt > 0) {
                $usersByRole->push((object)['name' => $r, 'count' => $cnt]);
            }
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

        $recentUsers = User::latest()->take(7)->get();
        $recentClaims = Claim::with('customer')->latest()->take(5)->get();
        $recentTransactions = PaymentTransaction::with('user')->latest()->take(5)->get();
        $recentPolicies = CustomerPolicy::latest()->take(5)->get();
        $recentTickets = SupportTicket::latest()->take(5)->get();

        $paymentMethods = PaymentTransaction::where('status', 'completed')
            ->select('payment_method', DB::raw('COUNT(*) as count'), DB::raw('COALESCE(SUM(amount),0) as total'))
            ->groupBy('payment_method')
            ->get();

        $paymentStatuses = PaymentTransaction::select('status', DB::raw('COUNT(*) as count'))
            ->groupBy('status')
            ->get();

        $topInsurers = CustomerPolicy::select('insurer_id', DB::raw('COUNT(*) as total_policies'), DB::raw('COALESCE(SUM(premium_amount),0) as total_premium'))
            ->groupBy('insurer_id')
            ->orderByDesc('total_policies')
            ->take(5)
            ->get();

        $renewalsCount = PolicyRenewal::whereBetween('created_at', [$startDate, $endDate])->count();
        $cancellationsCount = PolicyCancellation::whereBetween('created_at', [$startDate, $endDate])->count();

        $financingRequests = PremiumFinancingRequest::count();
        $pendingFinancing = PremiumFinancingRequest::where('status', 'pending')->count();
        $activeLoans = FinancingLoan::where('status', 'active')->count();

        $loginAttempts = LoginAttempt::where('created_at', '>=', $today->copy()->subDays(7))->count();
        $failedLogins = LoginAttempt::where('created_at', '>=', $today->copy()->subDays(7))->where('success', false)->count();

        $workflowsRunning = WorkflowExecution::where('status', 'running')->count();

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

    private function growthRate($previous, $current): float
    {
        if ($previous > 0) {
            return round((($current - $previous) / $previous) * 100, 1);
        }
        return $current > 0 ? 100 : 0;
    }

    public function aiInsights()
    {
        return view('admin.ai-insights');
    }
}

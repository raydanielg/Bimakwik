<?php

namespace App\Http\Controllers\FinancingPartner;

use App\Http\Controllers\Controller;
use App\Models\FinancingPartner;
use App\Models\FinancingLoan;
use App\Models\FinancingDisbursement;
use App\Models\FinancingRepaymentSchedule;
use App\Models\FinancingDefault;
use App\Models\PremiumFinancingRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $partner = FinancingPartner::where('user_id', $userId)->first();

        if (!$partner) {
            return view('financing_partner.dashboard', [
                'partner' => null,
                'pendingRequests' => 0,
                'totalDisbursed' => 0,
                'repaymentsThisMonth' => 0,
                'defaultRate' => 0,
                'totalLoans' => 0,
                'activeLoans' => 0,
                'recentRequests' => collect(),
                'repaymentStats' => ['on_time' => 0, 'grace' => 0, 'overdue' => 0],
                'recoveryRate' => 0,
            ]);
        }

        $partnerId = $partner->id;

        // Pending financing requests for this partner
        $pendingRequests = PremiumFinancingRequest::where('premium_financing_partner_id', $partnerId)
            ->where('status', 'pending')
            ->count();

        // Total disbursed amount
        $totalDisbursed = FinancingDisbursement::where('financing_partner_id', $partnerId)
            ->where('status', 'completed')
            ->sum('disbursement_amount');

        // Repayments for current month
        $repaymentsThisMonth = FinancingRepaymentSchedule::whereHas('loan', function ($q) use ($partnerId) {
            $q->where('financing_partner_id', $partnerId);
        })
            ->where('status', 'paid')
            ->whereMonth('paid_at', Carbon::now()->month)
            ->whereYear('paid_at', Carbon::now()->year)
            ->sum('paid_amount');

        // Loan counts
        $totalLoans = FinancingLoan::where('financing_partner_id', $partnerId)->count();
        $activeLoans = FinancingLoan::where('financing_partner_id', $partnerId)
            ->where('status', 'active')
            ->count();

        // Default rate
        $defaultCount = FinancingDefault::whereHas('loan', function ($q) use ($partnerId) {
            $q->where('financing_partner_id', $partnerId);
        })->count();
        $defaultRate = $totalLoans > 0 ? round(($defaultCount / $totalLoans) * 100, 1) : 0;

        // Recent financing requests
        $recentRequests = PremiumFinancingRequest::with(['customer.user', 'customerPolicy.insuranceProduct'])
            ->where('premium_financing_partner_id', $partnerId)
            ->latest()
            ->take(10)
            ->get();

        // Repayment performance stats
        $totalScheduled = FinancingRepaymentSchedule::whereHas('loan', function ($q) use ($partnerId) {
            $q->where('financing_partner_id', $partnerId);
        })->whereIn('status', ['paid', 'overdue', 'pending'])->count();

        $paidOnTime = FinancingRepaymentSchedule::whereHas('loan', function ($q) use ($partnerId) {
            $q->where('financing_partner_id', $partnerId);
        })->where('status', 'paid')->where('late_fee_amount', 0)->count();

        $paidLate = FinancingRepaymentSchedule::whereHas('loan', function ($q) use ($partnerId) {
            $q->where('financing_partner_id', $partnerId);
        })->where('status', 'paid')->where('late_fee_amount', '>', 0)->count();

        $overdueCount = FinancingRepaymentSchedule::whereHas('loan', function ($q) use ($partnerId) {
            $q->where('financing_partner_id', $partnerId);
        })->where('status', 'overdue')->count();

        $totalPaid = $paidOnTime + $paidLate;
        $recoveryRate = ($totalScheduled > 0) ? round(($totalPaid / $totalScheduled) * 100, 1) : 0;
        $onTimePct = ($totalPaid > 0) ? round(($paidOnTime / max($totalPaid, 1)) * 100, 1) : 0;
        $gracePct = ($totalPaid > 0) ? round(($paidLate / max($totalPaid, 1)) * 100, 1) : 0;
        $overduePct = ($totalScheduled > 0) ? round(($overdueCount / $totalScheduled) * 100, 1) : 0;

        return view('financing_partner.dashboard', [
            'partner' => $partner,
            'pendingRequests' => $pendingRequests,
            'totalDisbursed' => $totalDisbursed,
            'repaymentsThisMonth' => $repaymentsThisMonth,
            'defaultRate' => $defaultRate,
            'totalLoans' => $totalLoans,
            'activeLoans' => $activeLoans,
            'recentRequests' => $recentRequests,
            'repaymentStats' => [
                'on_time' => $onTimePct,
                'grace' => $gracePct,
                'overdue' => $overduePct,
            ],
            'recoveryRate' => $recoveryRate,
        ]);
    }
}

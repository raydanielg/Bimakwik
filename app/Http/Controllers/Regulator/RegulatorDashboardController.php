<?php

namespace App\Http\Controllers\Regulator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerPolicy;
use App\Models\User;
use App\Models\Claim;
use App\Models\InsuranceProduct;
use App\Models\PaymentTransaction;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RegulatorDashboardController extends Controller
{
    public function index()
    {
        $totalPremiums = 0;
        $activePolicies = 0;
        $complianceAlerts = 0;
        $fraudCases = 0;
        $totalInsurers = 0;
        $totalBrokers = 0;
        $totalAgents = 0;
        $marketShare = collect();
        $recentClaims = collect();

        try {
            $totalPremiums = PaymentTransaction::sum('amount') ?? 0;
            $activePolicies = CustomerPolicy::where('status', 'active')->count() ?? 0;
            $complianceAlerts = 0; // Would be from compliance table
            $fraudCases = Claim::where('status', 'under_investigation')->count() ?? 0;

            $totalInsurers = User::role('insurer')->count() ?? 0;
            $totalBrokers = User::role('broker')->count() ?? 0;
            $totalAgents = User::role(['sfe', 'bancassurance'])->count() ?? 0;

            $marketShare = User::role('insurer')->take(10)->get() ?? collect();
            $recentClaims = Claim::with('customer')->latest()->limit(5)->get() ?? collect();

        } catch (\Exception $e) {
            // Fallback to defaults if queries fail
        }

        return view('regulator.dashboard', compact(
            'totalPremiums',
            'activePolicies',
            'complianceAlerts',
            'fraudCases',
            'totalInsurers',
            'totalBrokers',
            'totalAgents',
            'marketShare',
            'recentClaims'
        ));
    }
}

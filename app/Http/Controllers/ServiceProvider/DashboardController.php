<?php

namespace App\Http\Controllers\ServiceProvider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceProviderBill;
use App\Models\Claim;
use App\Models\PaymentTransaction;
use App\Models\CustomerPolicy;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBills = 0;
        $pendingBills = 0;
        $paidAmount = 0;
        $rejectedBills = 0;
        $totalClaims = 0;
        $pendingClaims = 0;
        $recentBills = collect();

        try {
            $totalBills = ServiceProviderBill::count() ?? 0;
            $pendingBills = ServiceProviderBill::where('status', 'pending')->count() ?? 0;
            $paidAmount = ServiceProviderBill::where('status', 'paid')->sum('amount') ?? 0;
            $rejectedBills = ServiceProviderBill::where('status', 'rejected')->count() ?? 0;

            $totalClaims = Claim::count() ?? 0;
            $pendingClaims = Claim::where('status', 'pending')->count() ?? 0;

            $recentBills = ServiceProviderBill::with('customer')->latest()->limit(5)->get() ?? collect();

        } catch (\Exception $e) {
            // Fallback to defaults if queries fail
        }

        return view('service_provider.dashboard', compact(
            'totalBills',
            'pendingBills',
            'paidAmount',
            'rejectedBills',
            'totalClaims',
            'pendingClaims',
            'recentBills'
        ));
    }
}

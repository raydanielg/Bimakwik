<?php

namespace App\Http\Controllers\ServiceProvider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceProviderPayment;
use App\Models\Claim;
use App\Models\CustomerPolicy;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $totalBills = 0;
        $pendingBills = 0;
        $paidAmount = 0;
        $rejectedBills = 0;
        $recentBills = collect();

        try {
            // Get claims/bills for this service provider
            $totalBills = Claim::count() ?? 0;
            $pendingBills = Claim::where('status', 'pending')->count() ?? 0;
            $rejectedBills = Claim::where('status', 'rejected')->count() ?? 0;
            
            // Get paid amount from payments
            $paidAmount = ServiceProviderPayment::where('status', 'completed')->sum('amount') ?? 0;
            
            // Get recent bills/claims
            $recentBills = Claim::with('customer')->latest()->limit(5)->get();

        } catch (\Exception $e) {
            // Fallback to defaults if queries fail
        }

        return view('service-provider.dashboard', compact(
            'totalBills',
            'pendingBills',
            'paidAmount',
            'rejectedBills',
            'recentBills'
        ));
    }
}

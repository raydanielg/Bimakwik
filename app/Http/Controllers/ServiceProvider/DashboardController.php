<?php

namespace App\Http\Controllers\ServiceProvider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceProviderPayment;
use App\Models\ServiceProvider;
use App\Models\Claim;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $serviceProvider = ServiceProvider::where('user_id', $userId)->first();

        $totalPayments = 0;
        $pendingPayments = 0;
        $paidAmount = 0;
        $totalClaims = 0;
        $pendingClaims = 0;
        $recentPayments = collect();

        try {
            if ($serviceProvider) {
                $spId = $serviceProvider->id;
                $totalPayments = ServiceProviderPayment::where('service_provider_id', $spId)->count();
                $pendingPayments = ServiceProviderPayment::where('service_provider_id', $spId)->where('status', 'pending')->count();
                $paidAmount = ServiceProviderPayment::where('service_provider_id', $spId)->where('status', 'paid')->sum('amount');
                $recentPayments = ServiceProviderPayment::where('service_provider_id', $spId)->with('claim')->latest()->limit(5)->get();
            }

            $totalClaims = Claim::count();
            $pendingClaims = Claim::where('status', 'pending')->count();

        } catch (\Exception $e) {
            // Fallback to defaults if queries fail
        }

        return view('service_provider.dashboard', compact(
            'totalPayments',
            'pendingPayments',
            'paidAmount',
            'totalClaims',
            'pendingClaims',
            'recentPayments',
            'serviceProvider'
        ));
    }
}

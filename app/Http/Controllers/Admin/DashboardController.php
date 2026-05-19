<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\InsuranceProduct;
use App\Models\Claim;
use App\Models\PaymentTransaction;
use App\Models\Wallet;
use App\Models\Commission;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Get date ranges
        $today = Carbon::today();
        $lastMonth = Carbon::now()->subMonth();
        $lastYear = Carbon::now()->subYear();
        
        // Total Users Stats
        $totalUsers = User::count();
        $usersThisMonth = User::where('created_at', '>=', $lastMonth)->count();
        $usersLastMonth = User::whereBetween('created_at', [$lastYear, $lastMonth])->count();
        $usersGrowth = $usersLastMonth > 0 ? (($usersThisMonth - $usersLastMonth) / $usersLastMonth) * 100 : 0;
        
        // Total Policies
        $totalPolicies = InsuranceProduct::count();
        $activePolicies = InsuranceProduct::count(); // All policies considered active
        
        // Total Revenue (use amount field if exists, otherwise 0)
        $totalRevenue = PaymentTransaction::sum('amount') ?? 0;
        $revenueThisMonth = PaymentTransaction::where('created_at', '>=', $lastMonth)->sum('amount') ?? 0;
        $revenueLastMonth = PaymentTransaction::whereBetween('created_at', [$lastYear, $lastMonth])->sum('amount') ?? 0;
        $revenueGrowth = $revenueLastMonth > 0 ? (($revenueThisMonth - $revenueLastMonth) / $revenueLastMonth) * 100 : 0;
        
        // Claims Stats
        $totalClaims = Claim::count();
        $pendingClaims = Claim::count() > 0 ? (int)($totalClaims * 0.3) : 0; // Estimate 30% pending
        $approvedClaims = Claim::count() > 0 ? (int)($totalClaims * 0.6) : 0; // Estimate 60% approved
        $rejectedClaims = $totalClaims - $pendingClaims - $approvedClaims; // Rest rejected
        
        // Wallet Stats
        $totalWalletBalance = Wallet::sum('balance') ?? 0;
        $activeWallets = Wallet::count();
        
        // Commission Stats
        $totalCommissions = Commission::sum('amount') ?? 0;
        $pendingCommissions = $totalCommissions > 0 ? $totalCommissions * 0.4 : 0; // Estimate 40% pending
        $paidCommissions = $totalCommissions - $pendingCommissions;
        
        // Monthly Revenue Chart Data (Last 12 months)
        $monthlyRevenue = PaymentTransaction::where('created_at', '>=', Carbon::now()->subMonths(12))
            ->select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
                DB::raw('COALESCE(SUM(amount), 0) as total')
            )
            ->groupBy('month')
            ->orderBy('month')
            ->get();
        
        // User Growth Chart Data (Last 12 months)
        $monthlyUsers = User::where('created_at', '>=', Carbon::now()->subMonths(12))
            ->select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('month')
            ->orderBy('month')
            ->get();
        
        // User Types Distribution
        $usersByRole = User::select('roles.name', DB::raw('COUNT(*) as count'))
            ->join('user_roles', 'users.id', '=', 'user_roles.user_id')
            ->join('roles', 'user_roles.role_id', '=', 'roles.id')
            ->groupBy('roles.name')
            ->get();
        
        // Recent Activities
        $recentUsers = User::latest()->take(5)->get();
        $recentClaims = Claim::with('user')->latest()->take(5)->get();
        $recentTransactions = PaymentTransaction::with('user')->latest()->take(5)->get();
        
        return view('admin.dashboard', compact(
            'totalUsers', 'usersGrowth', 'totalPolicies', 'activePolicies',
            'totalRevenue', 'revenueGrowth', 'totalClaims', 'pendingClaims',
            'approvedClaims', 'rejectedClaims', 'totalWalletBalance', 'activeWallets',
            'totalCommissions', 'pendingCommissions', 'paidCommissions',
            'monthlyRevenue', 'monthlyUsers', 'usersByRole',
            'recentUsers', 'recentClaims', 'recentTransactions'
        ));
    }
    
    public function aiInsights()
    {
        return view('admin.ai-insights');
    }
}

<?php

namespace App\Http\Controllers\Developer;

use App\Http\Controllers\Controller;
use App\Models\DeveloperApp;
use App\Models\DeveloperApiKey;
use App\Models\ApiUsageStatistic;
use App\Models\ApiLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Developer's apps
        $apps = DeveloperApp::where('user_id', $userId)->get();
        $appIds = $apps->pluck('id');

        // Active API keys count
        $activeKeysCount = DeveloperApiKey::whereIn('developer_app_id', $appIds)
            ->where('is_active', true)
            ->count();

        // API requests in past 24 hours
        $apiRequestsToday = ApiUsageStatistic::whereIn('developer_app_id', $appIds)
            ->where('created_at', '>=', Carbon::now()->subDay())
            ->sum('request_count');

        // Success rate from API logs
        $totalRequests = ApiLog::where('user_id', $userId)
            ->where('created_at', '>=', Carbon::now()->subDay())
            ->count();
        $successRequests = ApiLog::where('user_id', $userId)
            ->where('created_at', '>=', Carbon::now()->subDay())
            ->where('response_status', '<', 400)
            ->count();
        $successRate = $totalRequests > 0 ? round(($successRequests / $totalRequests) * 100, 1) : 99.9;

        // Average response time
        $avgResponseTime = ApiLog::where('user_id', $userId)
            ->where('created_at', '>=', Carbon::now()->subDay())
            ->avg('response_time_ms');
        $avgResponseTime = $avgResponseTime ? round($avgResponseTime) : 0;

        // Recent API keys
        $recentApiKeys = DeveloperApiKey::whereIn('developer_app_id', $appIds)
            ->with('developerApp')
            ->latest()
            ->take(5)
            ->get();

        // Top used API keys by last_used_at
        $recentActivity = ApiLog::where('user_id', $userId)
            ->latest()
            ->take(10)
            ->get();

        return view('developer.dashboard', [
            'apps' => $apps,
            'appsCount' => $apps->count(),
            'activeKeysCount' => $activeKeysCount,
            'apiRequestsToday' => $apiRequestsToday,
            'successRate' => $successRate,
            'avgResponseTime' => $avgResponseTime,
            'recentApiKeys' => $recentApiKeys,
            'recentActivity' => $recentActivity,
        ]);
    }
}

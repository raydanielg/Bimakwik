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

        // API requests in past 24 hours (via api keys belonging to user's apps)
        $apiRequestsToday = ApiUsageStatistic::whereIn('developer_api_key_id', DeveloperApiKey::whereIn('developer_app_id', $appIds)->pluck('id'))
            ->where('date', '>=', Carbon::now()->subDay()->toDateString())
            ->sum('request_count');

        // Compute success rate from api_usage_statistics error_count vs request_count
        $usageStats = ApiUsageStatistic::whereIn('developer_api_key_id', DeveloperApiKey::whereIn('developer_app_id', $appIds)->pluck('id'))
            ->where('date', '>=', Carbon::now()->subDay()->toDateString())
            ->selectRaw('SUM(request_count) as total, SUM(error_count) as errors, SUM(total_response_time_ms) as total_ms')
            ->first();
        $totalReqs = $usageStats->total ?? 0;
        $totalErrors = $usageStats->errors ?? 0;
        $successRate = $totalReqs > 0 ? round((($totalReqs - $totalErrors) / $totalReqs) * 100, 1) : 99.9;
        $avgResponseTime = ($totalReqs > 0 && $usageStats->total_ms) ? round($usageStats->total_ms / $totalReqs) : 0;

        // Recent API keys
        $recentApiKeys = DeveloperApiKey::whereIn('developer_app_id', $appIds)
            ->with('developerApp')
            ->latest()
            ->take(5)
            ->get();

        $recentActivity = collect();

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

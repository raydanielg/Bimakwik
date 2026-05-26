<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SystemSetting;
use App\Models\ApiKey;
use App\Models\DeveloperApiKey;
use App\Models\CountryConfig;
use App\Models\CountryInstance;
use App\Models\AuditLog;
use Illuminate\Pagination\LengthAwarePaginator;

class SystemTechController extends Controller
{
    public function configurations()
    {
        try {
            $configs = SystemSetting::all()->keyBy('key');
        } catch (\Exception $e) {
            $configs = collect();
        }
        return view('admin.system.configurations', compact('configs'));
    }

    public function saveConfigurations(Request $request)
    {
        try {
            $settings = $request->except('_token');
            foreach ($settings as $key => $value) {
                SystemSetting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $value, 'updated_at' => now()]
                );
            }
            return response()->json([
                'success' => true,
                'message' => 'Settings saved successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to save: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function developerPortal()
    {
        $apiKeys = collect();
        $totalKeys = 0;
        $apiCallsToday = 0;
        $successRate = 0;
        $totalApps = 0;
        try {
            $apiKeys = DeveloperApiKey::latest()->limit(20)->get();
            $totalKeys = DeveloperApiKey::count();
            $totalApps = \App\Models\DeveloperApp::count();
            
            // API stats today
            if (class_exists(\App\Models\ApiLog::class)) {
                $apiCallsToday = \App\Models\ApiLog::whereDate('created_at', today())->count();
                $successCalls = \App\Models\ApiLog::whereDate('created_at', today())
                    ->where('status_code', '<', 400)->count();
                $successRate = $apiCallsToday > 0 ? round(($successCalls / $apiCallsToday) * 100, 1) : 100;
            }
        } catch (\Exception $e) {}
        return view('admin.system.developer-portal', compact(
            'apiKeys', 'totalKeys', 'apiCallsToday', 'successRate', 'totalApps'
        ));
    }

    public function multiCountry()
    {
        $countries = collect();
        $totalCountries = 0;
        $activeCountries = 0;
        try {
            $countries = CountryInstance::latest()->get();
            $totalCountries = $countries->count();
            $activeCountries = $countries->where('status', 'active')->count();
        } catch (\Exception $e) {}
        return view('admin.system.multi-country', compact(
            'countries', 'totalCountries', 'activeCountries'
        ));
    }
    
    public function auditLogs()
    {
        try {
            // Get all logs with user relationship
            $query = AuditLog::latest();
            
            // Apply filters if present
            if (request('action')) {
                $query->where('action', request('action'));
            }
            if (request('user')) {
                $query->where('user_id', request('user'));
            }
            if (request('search')) {
                $search = request('search');
                $query->where(function($q) use ($search) {
                    $q->where('action', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%")
                      ->orWhere('ip_address', 'like', "%{$search}%");
                });
            }
            
            $logs = $query->paginate(20);
            
            // Get statistics
            $totalLogs = AuditLog::count();
            $todayLogs = AuditLog::whereDate('created_at', today())->count();
            $uniqueUsers = AuditLog::distinct('user_id')->count('user_id');
            $criticalActions = AuditLog::whereIn('action', ['delete', 'update', 'approve'])->count();
            
            // Get action breakdown
            $actionStats = AuditLog::select('action', \DB::raw('count(*) as count'))
                ->groupBy('action')
                ->orderByDesc('count')
                ->limit(5)
                ->get();
            
            // Recent critical activities
            $criticalLogs = AuditLog::whereIn('action', ['delete', 'approve', 'reject'])
                ->latest()
                ->limit(5)
                ->get();
            
        } catch (\Exception $e) {
            $logs = new LengthAwarePaginator([], 0, 20);
            $totalLogs = 0;
            $todayLogs = 0;
            $uniqueUsers = 0;
            $criticalActions = 0;
            $actionStats = collect();
            $criticalLogs = collect();
        }
        
        return view('admin.system.audit-logs', compact(
            'logs', 'totalLogs', 'todayLogs', 'uniqueUsers', 
            'criticalActions', 'actionStats', 'criticalLogs'
        ));
    }
}

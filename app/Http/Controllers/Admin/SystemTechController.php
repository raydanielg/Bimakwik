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
            $configs = SystemSetting::all();
        } catch (\Exception $e) {
            $configs = collect();
        }
        return view('admin.system.configurations', compact('configs'));
    }

    public function developerPortal()
    {
        try {
            // Combine both API key types
            $apiKeys = ApiKey::latest()->get();
            $developerKeys = DeveloperApiKey::latest()->get();
            $allKeys = $apiKeys->merge($developerKeys);
            
            // Paginate manually
            $page = request()->get('page', 1);
            $perPage = 20;
            $offset = ($page - 1) * $perPage;
            $paginatedKeys = $allKeys->slice($offset, $perPage);
            
        } catch (\Exception $e) {
            $paginatedKeys = collect();
        }
        return view('admin.system.developer-portal', compact('paginatedKeys'));
    }

    public function multiCountry()
    {
        try {
            // Combine country-related models
            $countryConfigs = CountryConfig::latest()->get();
            $countryInstances = CountryInstance::latest()->get();
            $countries = $countryConfigs->merge($countryInstances);
            
            // Paginate manually
            $page = request()->get('page', 1);
            $perPage = 20;
            $offset = ($page - 1) * $perPage;
            $paginatedCountries = $countries->slice($offset, $perPage);
            
        } catch (\Exception $e) {
            $paginatedCountries = collect();
        }
        return view('admin.system.multi-country', compact('paginatedCountries'));
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

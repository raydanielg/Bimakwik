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
            $logs = AuditLog::latest()->paginate(20);
        } catch (\Exception $e) {
            $logs = new LengthAwarePaginator([], 0, 20);
        }
        return view('admin.system.audit-logs', compact('logs'));
    }
}

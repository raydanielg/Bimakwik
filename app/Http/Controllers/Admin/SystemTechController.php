<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SystemConfiguration;
use App\Models\ApiKey;
use App\Models\Country;
use App\Models\AuditLog;

class SystemTechController extends Controller
{
    public function configurations()
    {
        $configs = SystemConfiguration::all();
        return view('admin.system.configurations', compact('configs'));
    }

    public function developerPortal()
    {
        $apiKeys = ApiKey::with('user')->paginate(20);
        return view('admin.system.developer', compact('apiKeys'));
    }

    public function multiCountry()
    {
        $countries = Country::with('currencies')->paginate(20);
        return view('admin.system.multicountry', compact('countries'));
    }

    public function auditLogs()
    {
        $logs = AuditLog::with('user')->latest()->paginate(50);
        return view('admin.system.audit', compact('logs'));
    }
}

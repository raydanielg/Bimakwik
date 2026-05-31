<?php

namespace App\Http\Controllers\Regulator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CustomerPolicy;
use App\Models\Claim;
use App\Models\InsuranceProduct;

class RegulatorReportController extends Controller
{
    public function insurers()
    {
        $insurers = collect();
        try { $insurers = User::role('insurer')->paginate(15); } catch (\Exception $e) {}
        return view('regulator.insurers.index', compact('insurers'));
    }

    public function brokers()
    {
        $brokers = collect();
        try { $brokers = User::role('broker')->withCount('policies')->paginate(15); } catch (\Exception $e) {}
        return view('regulator.brokers.index', compact('brokers'));
    }

    public function agents()
    {
        $agents = collect();
        try { $agents = User::role(['sfe', 'bancassurance'])->withCount('policies')->paginate(15); } catch (\Exception $e) {}
        return view('regulator.agents.index', compact('agents'));
    }

    public function compliance()
    {
        $alerts = collect();
        try { $alerts = \App\Models\ComplianceAlert::latest()->paginate(15); } catch (\Exception $e) {}
        return view('regulator.compliance.index', compact('alerts'));
    }

    public function oversight()
    {
        $audits = collect();
        try { $audits = \App\Models\AuditLog::latest()->paginate(15); } catch (\Exception $e) {}
        return view('regulator.oversight.index', compact('audits'));
    }

    public function reports()
    {
        $reports = collect();
        try { $reports = \App\Models\Report::latest()->paginate(15); } catch (\Exception $e) {}
        return view('regulator.reports.index', compact('reports'));
    }

    public function analytics()
    {
        $analytics = collect();
        try { $analytics = \App\Models\MarketAnalytics::latest()->paginate(15); } catch (\Exception $e) {}
        return view('regulator.analytics.index', compact('analytics'));
    }
}

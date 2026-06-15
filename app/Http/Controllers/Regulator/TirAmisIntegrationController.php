<?php

namespace App\Http\Controllers\Regulator;

use App\Http\Controllers\Controller;
use App\Models\TirAmisReport;
use App\Models\TirAmisIntegrationLog;
use App\Models\Insurer;
use App\Models\Claim;
use App\Services\TirAmisService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TirAmisIntegrationController extends Controller
{
    protected TirAmisService $tiramis;

    public function __construct(TirAmisService $tiramis)
    {
        $this->tiramis = $tiramis;
    }

    public function dashboard()
    {
        $stats = [
            'total_reports' => TirAmisReport::count(),
            'sent_reports' => TirAmisReport::where('status', 'sent')->count(),
            'failed_reports' => TirAmisReport::where('status', 'failed')->count(),
            'pending_reports' => TirAmisReport::whereIn('status', ['pending', 'simulated'])->count(),
            'total_companies' => Insurer::where('tiramis_enabled', true)->count(),
            'total_logs' => TirAmisIntegrationLog::count(),
            'successful_logs' => TirAmisIntegrationLog::where('status', 'success')->count(),
            'failed_logs' => TirAmisIntegrationLog::where('status', 'failed')->count(),
        ];

        $recentReports = TirAmisReport::with('claim')->latest()->take(10)->get();
        $recentLogs = TirAmisIntegrationLog::latest()->take(10)->get();
        $companyCodes = TirAmisReport::select('company_code', DB::raw('COUNT(*) as total'))
            ->groupBy('company_code')->orderByDesc('total')->get();

        return view('regulator.tiramis.dashboard', compact('stats', 'recentReports', 'recentLogs', 'companyCodes'));
    }

    public function companies()
    {
        $companies = Insurer::where('tiramis_enabled', true)
            ->orWhereNotNull('company_code')
            ->withCount(['products'])
            ->latest()
            ->paginate(15);

        return view('regulator.tiramis.companies', compact('companies'));
    }

    public function reports(Request $request)
    {
        $reports = TirAmisReport::with('claim')
            ->when($request->company_code, fn($q, $v) => $q->where('company_code', $v))
            ->when($request->status, fn($q, $v) => $q->where('status', $v))
            ->when($request->report_type, fn($q, $v) => $q->where('report_type', $v))
            ->when($request->date_from, fn($q, $v) => $q->whereDate('created_at', '>=', $v))
            ->when($request->date_to, fn($q, $v) => $q->whereDate('created_at', '<=', $v))
            ->latest()
            ->paginate(20);

        $companyCodes = TirAmisReport::select('company_code')->distinct()->whereNotNull('company_code')->pluck('company_code');

        return view('regulator.tiramis.reports', compact('reports', 'companyCodes'));
    }

    public function companyReports(Request $request, string $companyCode)
    {
        $reports = TirAmisReport::where('company_code', $companyCode)
            ->with('claim')
            ->when($request->status, fn($q, $v) => $q->where('status', $v))
            ->latest()
            ->paginate(20);

        $stats = [
            'total' => TirAmisReport::where('company_code', $companyCode)->count(),
            'sent' => TirAmisReport::where('company_code', $companyCode)->where('status', 'sent')->count(),
            'failed' => TirAmisReport::where('company_code', $companyCode)->where('status', 'failed')->count(),
        ];

        return view('regulator.tiramis.company-reports', compact('reports', 'stats', 'companyCode'));
    }

    public function showReport(TirAmisReport $report)
    {
        $report->load('claim');
        return view('regulator.tiramis.show', compact('report'));
    }

    public function logs(Request $request)
    {
        $logs = TirAmisIntegrationLog::latest()
            ->when($request->company_code, fn($q, $v) => $q->where('company_code', $v))
            ->when($request->status, fn($q, $v) => $q->where('status', $v))
            ->when($request->date_from, fn($q, $v) => $q->whereDate('created_at', '>=', $v))
            ->when($request->date_to, fn($q, $v) => $q->whereDate('created_at', '<=', $v))
            ->paginate(20);

        return view('regulator.tiramis.logs', compact('logs'));
    }

    public function marketOverview()
    {
        $companyStats = Insurer::where('tiramis_enabled', true)
            ->select('id', 'insurer_name', 'company_code')
            ->withCount(['products'])
            ->get()
            ->map(function ($insurer) {
                $insurer->total_reports = TirAmisReport::where('company_code', $insurer->company_code)->count();
                $insurer->sent_reports = TirAmisReport::where('company_code', $insurer->company_code)->where('status', 'sent')->count();
                $insurer->failed_reports = TirAmisReport::where('company_code', $insurer->company_code)->where('status', 'failed')->count();
                return $insurer;
            });

        return view('regulator.tiramis.market', compact('companyStats'));
    }
}

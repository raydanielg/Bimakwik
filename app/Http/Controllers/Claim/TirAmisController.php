<?php

namespace App\Http\Controllers\Claim;

use App\Http\Controllers\Controller;
use App\Models\Claim;
use App\Models\TirAmisReport;
use App\Models\TirAmisIntegrationLog;
use App\Services\TirAmisService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TirAmisController extends Controller
{
    protected TirAmisService $tiramis;

    public function __construct(TirAmisService $tiramis)
    {
        $this->tiramis = $tiramis;
    }

    public function index(Request $request)
    {
        $reports = TirAmisReport::with('claim')
            ->when($request->status, fn($q, $v) => $q->where('status', $v))
            ->when($request->company_code, fn($q, $v) => $q->where('company_code', $v))
            ->when($request->report_type, fn($q, $v) => $q->where('report_type', $v))
            ->latest()
            ->paginate(15);

        $stats = [
            'total' => TirAmisReport::count(),
            'sent' => TirAmisReport::where('status', 'sent')->count(),
            'failed' => TirAmisReport::where('status', 'failed')->count(),
            'pending' => TirAmisReport::whereIn('status', ['pending', 'simulated'])->count(),
        ];

        $companyCodes = TirAmisReport::select('company_code')->distinct()->whereNotNull('company_code')->pluck('company_code');

        return view('admin.tiramis.reports', compact('reports', 'stats', 'companyCodes'));
    }

    public function submitClaim(Request $request, Claim $claim)
    {
        $request->validate([
            'company_code' => 'required|string|max:50',
            'sales_code' => 'nullable|string|max:50',
        ]);

        $result = $this->tiramis->submitClaim(
            $claim,
            $request->company_code,
            $request->sales_code
        );

        if ($result['success']) {
            return redirect()->back()->with('success', 'Claim submitted to TIRAMIS successfully. Report #' . ($result['report']->report_number ?? ''));
        }

        return redirect()->back()->with('error', 'TIRAMIS submission failed: ' . ($result['error'] ?? 'Unknown error'));
    }

    public function batchSubmit(Request $request)
    {
        $request->validate([
            'claim_ids' => 'required|array',
            'claim_ids.*' => 'exists:claims,id',
            'company_code' => 'required|string|max:50',
        ]);

        $results = $this->tiramis->submitBatchClaims($request->claim_ids, $request->company_code);
        $success = count(array_filter($results, fn($r) => $r['success']));

        return redirect()->back()->with('success', "$success claims submitted to TIRAMIS successfully.");
    }

    public function showReport(TirAmisReport $report)
    {
        $report->load('claim');
        return view('admin.tiramis.show', compact('report'));
    }

    public function retryReport(TirAmisReport $report)
    {
        if (!$report->claim) {
            return redirect()->back()->with('error', 'Related claim not found.');
        }

        $result = $this->tiramis->submitClaim(
            $report->claim,
            $report->company_code,
            $report->sales_code
        );

        if ($result['success']) {
            return redirect()->back()->with('success', 'Report retransmitted successfully.');
        }
        return redirect()->back()->with('error', 'Retransmission failed: ' . ($result['error'] ?? ''));
    }

    public function statusCheck(Request $request, TirAmisReport $report)
    {
        $updated = $this->tiramis->checkReportStatus($report->report_number);
        if ($updated) {
            return redirect()->back()->with('success', 'Report status updated to: ' . $updated->status);
        }
        return redirect()->back()->with('info', 'Could not check status. TIRAMIS may be unavailable.');
    }

    public function logs(Request $request)
    {
        $logs = TirAmisIntegrationLog::latest()
            ->when($request->status, fn($q, $v) => $q->where('status', $v))
            ->when($request->action, fn($q, $v) => $q->where('action', $v))
            ->paginate(20);

        $actions = TirAmisIntegrationLog::select('action')->distinct()->pluck('action');

        return view('admin.tiramis.logs', compact('logs', 'actions'));
    }

    public function pendingClaims()
    {
        $claims = Claim::whereDoesntHave('tiramisReports', fn($q) => $q->whereIn('status', ['sent', 'simulated']))
            ->with('policy')
            ->latest()
            ->paginate(15);

        return view('admin.tiramis.pending', compact('claims'));
    }
}

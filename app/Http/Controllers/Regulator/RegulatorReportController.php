<?php

namespace App\Http\Controllers\Regulator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CustomerPolicy;
use App\Models\Claim;
use App\Models\InsuranceProduct;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;

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
        try { $brokers = User::role('broker')->paginate(15); } catch (\Exception $e) {}
        return view('regulator.brokers.index', compact('brokers'));
    }

    public function agents()
    {
        $agents = collect();
        try { $agents = User::role(['sfe', 'bancassurance'])->paginate(15); } catch (\Exception $e) {}
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
        try { $reports = Report::where('created_by', Auth::id())->latest()->paginate(15); } catch (\Exception $e) {}
        return view('regulator.reports.index', compact('reports'));
    }

    public function generateReport(Request $request)
    {
        $validated = $request->validate([
            'report_type' => 'required|string|max:100',
            'period' => 'nullable|string|max:100',
        ]);

        Report::create([
            'report_name' => $validated['report_type'] . ' - ' . now()->format('Y-m-d H:i'),
            'report_type' => $validated['report_type'],
            'parameters' => ['period' => $validated['period'] ?? 'Current Month'],
            'is_system' => false,
            'is_active' => true,
            'created_by' => Auth::id(),
        ]);

        return back()->with('success', 'Report generated successfully');
    }

    public function viewReport(Report $report)
    {
        abort_unless((int) $report->created_by === (int) Auth::id(), 403);

        return view('shared.reports.show', [
            'report' => $report,
            'backRoute' => 'regulator.reports',
        ]);
    }

    public function downloadReport(Report $report)
    {
        abort_unless((int) $report->created_by === (int) Auth::id(), 403);

        $content = "Report Name: " . ($report->report_name ?? 'N/A') . "\n"
            . "Report Type: " . ($report->report_type ?? 'N/A') . "\n"
            . "Generated At: " . (optional($report->created_at)->format('Y-m-d H:i:s') ?? 'N/A') . "\n"
            . "Parameters: " . json_encode($report->parameters ?? [], JSON_PRETTY_PRINT) . "\n";

        return response()->streamDownload(function () use ($content) {
            echo $content;
        }, 'report-' . $report->id . '.txt', ['Content-Type' => 'text/plain']);
    }

    public function exportReports()
    {
        $reports = Report::where('created_by', Auth::id())->latest()->get();

        return response()->streamDownload(function () use ($reports) {
            $out = fopen('php://output', 'w');
            fputcsv($out, ['Report Name', 'Type', 'Period', 'Generated At']);

            foreach ($reports as $report) {
                fputcsv($out, [
                    $report->report_name,
                    $report->report_type,
                    $report->parameters['period'] ?? 'Current Month',
                    optional($report->created_at)->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($out);
        }, 'regulator-reports.csv', ['Content-Type' => 'text/csv']);
    }

    public function analytics()
    {
        $analytics = collect();
        try { $analytics = \App\Models\MarketAnalytics::latest()->paginate(15); } catch (\Exception $e) {}
        return view('regulator.analytics.index', compact('analytics'));
    }
}

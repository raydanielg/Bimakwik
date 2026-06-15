<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerPolicy;
use App\Models\User;
use App\Models\AgentCommission;
use App\Models\AgentCustomer;
use App\Models\AgentPolicy;
use App\Models\AgentProfile;
use App\Models\Claim;
use App\Models\CommissionTransaction;
use App\Models\CustomerPolicy;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;

class AgentHubController extends Controller
{
    public function policies()
    {
        $policies = collect(); $totalCount = 0; $activeCount = 0; $expiredCount = 0;
        try {
            $policies = CustomerPolicy::with('customer', 'product')->latest()->paginate(15);
            $totalCount = CustomerPolicy::count();
            $activeCount = CustomerPolicy::where('status', 'active')->count();
            $expiredCount = CustomerPolicy::where('status', 'expired')->count();
        } catch (\Exception $e) {}
        return view('agent.policies.index', compact('policies', 'totalCount', 'activeCount', 'expiredCount'));
    }

    public function customers()
    {
        $customers = collect();
        try { $customers = User::role('customer')->with('customerProfile')->paginate(15); } catch (\Exception $e) {}
        return view('agent.customers.index', compact('customers'));
    }

    public function commissions()
    {
        $commissions = collect(); $totalEarned = 0; $pendingAmount = 0;
        try {
            $commissions = AgentCommission::latest()->paginate(15);
            $totalEarned = AgentCommission::where('status', 'paid')->sum('amount') ?? 0;
            $pendingAmount = AgentCommission::where('status', 'pending')->sum('amount') ?? 0;
        } catch (\Exception $e) {}
        return view('agent.commissions.index', compact('commissions', 'totalEarned', 'pendingAmount'));
    }

    public function reports()
    {
        $reports = collect();
        try { $reports = Report::where('created_by', Auth::id())->latest()->paginate(15); } catch (\Exception $e) {}
        return view('agent.reports.index', compact('reports'));
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
            'backRoute' => 'agent.reports',
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
        }, 'agent-reports.csv', ['Content-Type' => 'text/csv']);
    }

    public function products()
    {
        $products = collect();
        try { $products = InsuranceProduct::where('status', 'active')->latest()->paginate(15); } catch (\Exception $e) {}
        return view('agent.products.index', compact('products'));
    }

    public function claims()
    {
        $claims = collect();
        try { $claims = Claim::with('customer')->latest()->paginate(15); } catch (\Exception $e) {}
        return view('agent.claims.index', compact('claims'));
    }
}

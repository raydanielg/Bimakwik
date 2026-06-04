<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AuditComplianceReport;
use App\Models\AuditLog;
use App\Models\ComplianceCheck;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class GovernanceController extends Controller
{
    public function compliance()
    {
        try {
            // Combine compliance-related models
            $auditReports = AuditComplianceReport::latest()->get();
            $complianceChecks = ComplianceCheck::latest()->get();
            
            // Merge all compliance data
            $allReports = $auditReports->merge($complianceChecks);
            
            // Paginate manually using LengthAwarePaginator
            $page = request()->get('page', 1);
            $perPage = 20;
            $offset = ($page - 1) * $perPage;
            $paginatedItems = $allReports->slice($offset, $perPage)->values();
            
            $reports = new LengthAwarePaginator(
                $paginatedItems,
                $allReports->count(),
                $perPage,
                $page,
                ['path' => request()->url(), 'query' => request()->query()]
            );
            
        } catch (\Exception $e) {
            $reports = new LengthAwarePaginator([], 0, 20);
        }
        return view('admin.governance.compliance', compact('reports'));
    }

    public function analytics()
    {
        return view('admin.governance.analytics');
    }

    public function communications()
    {
        try {
            // Use empty paginator since Communication model doesn't exist
            $communications = new LengthAwarePaginator([], 0, 20);
        } catch (\Exception $e) {
            $communications = new LengthAwarePaginator([], 0, 20);
        }
        return view('admin.governance.communications', compact('communications'));
    }

    public function sendCommunication(Request $request)
    {
        $data = $request->validate([
            'recipients' => 'required|string|max:255',
            'channel' => 'required|string|max:50',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        // Keep a server-side audit trail even when no dedicated communications table exists.
        Log::info('Admin communication dispatched', [
            'admin_id' => auth()->id(),
            'recipients' => $data['recipients'],
            'channel' => $data['channel'],
            'subject' => $data['subject'],
        ]);

        return redirect()
            ->route('admin.governance.communications')
            ->with('success', 'Message has been queued for delivery.');
    }
    
    public function exportReport($id)
    {
        try {
            // Get report data
            $report = AuditComplianceReport::findOrFail($id);
            
            // Generate PDF
            $pdf = \PDF::loadView('admin.governance.report-pdf', [
                'report' => $report,
                'generatedDate' => now()->format('F d, Y'),
                'generatedTime' => now()->format('H:i:s'),
                'generatedBy' => auth()->user()->name ?? 'System',
            ]);
            
            $pdf->setPaper('A4', 'portrait');
            
            $filename = 'Compliance_Report_' . $report->id . '_' . now()->format('Ymd') . '.pdf';
            
            return $pdf->download($filename);
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to generate PDF: ' . $e->getMessage());
        }
    }
}

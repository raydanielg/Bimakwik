<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AuditComplianceReport;
use App\Models\AuditLog;
use App\Models\ComplianceCheck;
use Illuminate\Pagination\LengthAwarePaginator;

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
    
    public function exportReport($id)
    {
        try {
            // Get report data
            $report = AuditComplianceReport::findOrFail($id);
            
            // Generate PDF with comprehensive formatting
            $pdf = \PDF::loadView('admin.governance.report-pdf', [
                'report' => $report,
                'generatedDate' => now()->format('F d, Y'),
                'generatedTime' => now()->format('H:i:s'),
                'generatedBy' => auth()->user()->name ?? 'System',
            ]);
            
            // Set PDF options
            $pdf->setPaper('A4', 'portrait');
            $pdf->setOption('enable-local-file-access', true);
            $pdf->setOption('enable-javascript', true);
            $pdf->setOption('no-stop-slow-scripts', true);
            $pdf->setOption('enable-smart-shrinking', true);
            $pdf->setOption('margin-top', 20);
            $pdf->setOption('margin-bottom', 20);
            $pdf->setOption('margin-left', 15);
            $pdf->setOption('margin-right', 15);
            
            // Add watermark and protection
            $pdf->setOption('footer-html', view('admin.governance.pdf-footer')->render());
            $pdf->setOption('header-html', view('admin.governance.pdf-header')->render());
            
            $filename = 'Compliance_Report_' . $report->id . '_' . now()->format('Ymd') . '.pdf';
            
            return $pdf->download($filename);
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to generate PDF: ' . $e->getMessage());
        }
    }
}

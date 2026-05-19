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
            
            // Paginate manually
            $page = request()->get('page', 1);
            $perPage = 20;
            $offset = ($page - 1) * $perPage;
            $reports = $allReports->slice($offset, $perPage);
            
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
}

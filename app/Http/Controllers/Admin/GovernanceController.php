<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ComplianceReport;
use App\Models\AuditLog;
use App\Models\Communication;

class GovernanceController extends Controller
{
    public function compliance()
    {
        $reports = ComplianceReport::paginate(20);
        return view('admin.governance.compliance', compact('reports'));
    }

    public function advancedAnalytics()
    {
        return view('admin.governance.analytics');
    }

    public function communications()
    {
        $communications = Communication::with('sender', 'recipient')->paginate(20);
        return view('admin.governance.communications', compact('communications'));
    }
}

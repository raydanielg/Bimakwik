<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Claim;
use App\Models\Workflow;
use App\Models\Document;

class OperationsController extends Controller
{
    public function claimsCenter()
    {
        $claims = Claim::with('user', 'policy', 'insurer')->paginate(20);
        $pendingClaims = Claim::where('status', 'pending')->count();
        $processingClaims = Claim::where('status', 'processing')->count();
        $approvedClaims = Claim::where('status', 'approved')->count();
        return view('admin.operations.claims', compact('claims', 'pendingClaims', 'processingClaims', 'approvedClaims'));
    }

    public function workflows()
    {
        $workflows = Workflow::with('creator')->paginate(20);
        return view('admin.operations.workflows', compact('workflows'));
    }

    public function documentVault()
    {
        $documents = Document::with('uploader')->paginate(20);
        return view('admin.operations.documents', compact('documents'));
    }
}

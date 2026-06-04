<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Claim;
use App\Models\Workflow;
use Illuminate\Pagination\LengthAwarePaginator;

class OperationsController extends Controller
{
    public function claims()
    {
        try {
            $claims = Claim::latest()->paginate(20);
            $pendingClaims = Claim::whereIn('status', ['submitted', 'pending'])->count();
            $processingClaims = Claim::where('status', 'processing')->count();
            $approvedClaims = Claim::where('status', 'approved')->count();
            $rejectedClaims = Claim::where('status', 'rejected')->count();
            $totalClaims = Claim::count();
        } catch (\Exception $e) {
            $claims = new LengthAwarePaginator([], 0, 20);
            $pendingClaims = 0;
            $processingClaims = 0;
            $approvedClaims = 0;
            $rejectedClaims = 0;
            $totalClaims = 0;
        }
        return view('admin.operations.claims', compact('claims', 'pendingClaims', 'processingClaims', 'approvedClaims', 'rejectedClaims', 'totalClaims'));
    }
    
    public function show($id)
    {
        try {
            $claim = Claim::findOrFail($id);
        } catch (\Exception $e) {
            return redirect()->route('admin.operations.claims')->with('error', 'Claim not found');
        }
        return view('admin.operations.claims-show', compact('claim'));
    }
    
    public function approveClaim(Request $request, $id)
    {
        try {
            $claim = Claim::findOrFail($id);
            $claim->status = 'approved';
            if (is_null($claim->approved_amount)) {
                $claim->approved_amount = $claim->claimed_amount;
            }
            $claim->rejection_reason = null;
            $claim->settled_at = now();
            $claim->save();

            return response()->json([
                'success' => true,
                'message' => 'Claim approved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to approve claim'
            ], 500);
        }
    }
    
    public function rejectClaim(Request $request, $id)
    {
        try {
            $claim = Claim::findOrFail($id);
            $claim->status = 'rejected';
            $claim->rejection_reason = $request->input('reason');
            $claim->approved_amount = null;
            $claim->settled_at = null;
            $claim->save();

            return response()->json([
                'success' => true,
                'message' => 'Claim rejected successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to reject claim'
            ], 500);
        }
    }

    public function workflows()
    {
        try {
            $workflows = Workflow::latest()->paginate(20);
        } catch (\Exception $e) {
            $workflows = new LengthAwarePaginator([], 0, 20);
        }
        return view('admin.operations.workflows', compact('workflows'));
    }

    public function deleteWorkflow($id)
    {
        try {
            Workflow::findOrFail($id)->delete();
            return back()->with('success', 'Workflow deleted successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete workflow: ' . $e->getMessage());
        }
    }

    public function documents()
    {
        try {
            // Use empty paginator since Document model might not exist
            $documents = new LengthAwarePaginator([], 0, 20);
        } catch (\Exception $e) {
            $documents = new LengthAwarePaginator([], 0, 20);
        }
        return view('admin.operations.documents', compact('documents'));
    }
}

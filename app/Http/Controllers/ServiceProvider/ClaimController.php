<?php

namespace App\Http\Controllers\ServiceProvider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Claim;
use App\Models\CustomerPolicy;

class ClaimController extends Controller
{
    public function index()
    {
        $claims = collect();
        $stats = [
            'total' => 0,
            'pending' => 0,
            'approved' => 0,
            'rejected' => 0,
        ];

        try {
            $claims = Claim::with('customer', 'policy', 'product')->latest()->paginate(15);
            $stats = [
                'total' => Claim::count() ?? 0,
                'pending' => Claim::where('status', 'pending')->count() ?? 0,
                'approved' => Claim::where('status', 'approved')->count() ?? 0,
                'rejected' => Claim::where('status', 'rejected')->count() ?? 0,
            ];
        } catch (\Exception $e) {}

        return view('service-provider.claims.index', compact('claims', 'stats'));
    }

    public function show($id)
    {
        $claim = null;
        try {
            $claim = Claim::with('customer', 'policy', 'product', 'documents')->findOrFail($id);
        } catch (\Exception $e) {}
        return view('service-provider.claims.show', compact('claim'));
    }

    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,approved,rejected,processing',
            'notes' => 'nullable|string',
        ]);

        try {
            $claim = Claim::findOrFail($id);
            $claim->update([
                'status' => $validated['status'],
                'notes' => $validated['notes'] ?? $claim->notes,
            ]);
            return back()->with('success', 'Claim status updated');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update status');
        }
    }
}

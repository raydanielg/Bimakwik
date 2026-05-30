<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Claim;

class CustomerClaimController extends Controller
{
    public function index()
    {
        $claims = collect();
        try {
            $claims = Claim::where('customer_id', auth()->id())
                ->with('policy', 'product')
                ->latest()
                ->paginate(15);
        } catch (\Exception $e) {}
        return view('customer.claims.track', compact('claims'));
    }

    public function create()
    {
        $policies = collect();
        try {
            $policies = CustomerPolicy::where('customer_id', auth()->id())
                ->where('status', 'active')
                ->with('product')
                ->get();
        } catch (\Exception $e) {}
        return view('customer.claims.create', compact('policies'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'policy_id' => 'required|exists:customer_policies,id',
            'description' => 'required|string',
            'amount' => 'required|numeric',
        ]);

        try {
            Claim::create([
                ...$validated,
                'customer_id' => auth()->id(),
                'claim_number' => 'CLM-' . time(),
                'claim_date' => now(),
                'status' => 'pending',
            ]);
            return redirect()->route('customer.claims.track')->with('success', 'Claim submitted');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to submit claim');
        }
    }
}

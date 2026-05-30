<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Claim;
use App\Models\CustomerPolicy;
use Illuminate\Support\Facades\DB;

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

    public function create(Request $request)
    {
        $policies = collect();
        $selectedPolicyId = $request->query('policy_id');
        
        try {
            $userId = auth()->id();
            $customerId = DB::table('customers')->where('user_id', $userId)->value('id');
            
            if ($customerId) {
                $query = CustomerPolicy::where('customer_id', $customerId)
                    ->where('status', 'active')
                    ->with('product');
                
                if ($selectedPolicyId) {
                    $query->where('id', $selectedPolicyId);
                }
                
                $policies = $query->get();
            }
        } catch (\Exception $e) {}
        return view('customer.claims.create', compact('policies', 'selectedPolicyId'));
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

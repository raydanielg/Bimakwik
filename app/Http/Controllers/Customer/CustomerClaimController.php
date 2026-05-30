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
            'claim_type' => 'required|string',
            'incident_date' => 'required|date',
            'description' => 'required|string',
            'amount' => 'required|numeric',
            'location' => 'required|string',
            'third_party' => 'nullable|boolean',
            'third_party_name' => 'nullable|string',
            'third_party_contact' => 'nullable|string',
            'police_report' => 'nullable|boolean',
        ]);

        try {
            $userId = auth()->id();
            $customerId = DB::table('customers')->where('user_id', $userId)->value('id');
            
            if (!$customerId) {
                return back()->with('error', 'Customer record not found.');
            }

            // Generate claim number
            $claimNumber = 'CLM-' . strtoupper(substr(uniqid(), -8));

            // Create claim
            Claim::create([
                'customer_id' => $customerId,
                'policy_id' => $validated['policy_id'],
                'claim_number' => $claimNumber,
                'claim_type' => $validated['claim_type'],
                'incident_date' => $validated['incident_date'],
                'description' => $validated['description'],
                'amount' => $validated['amount'],
                'location' => $validated['location'],
                'status' => 'pending',
                'third_party_involved' => $validated['third_party'] ?? false,
                'third_party_name' => $validated['third_party_name'] ?? null,
                'third_party_contact' => $validated['third_party_contact'] ?? null,
                'police_report_filed' => $validated['police_report'] ?? false,
            ]);

            return redirect()->route('customer.claims.track')->with('success', 'Claim submitted successfully! Claim Number: ' . $claimNumber);
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to submit claim: ' . $e->getMessage())->withInput();
        }
    }
}

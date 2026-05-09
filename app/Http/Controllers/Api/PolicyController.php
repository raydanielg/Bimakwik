<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerPolicy;
use App\Models\PolicyDocument;
use Illuminate\Support\Facades\Auth;

class PolicyController extends Controller
{
    public function dashboardSummary()
    {
        $userId = Auth::id();
        $policies = CustomerPolicy::where('user_id', $userId)->get();

        return response()->json([
            'total_active_policies' => $policies->where('status', 'active')->count(),
            'total_policies_ever' => $policies->count(),
            'total_premiums_paid' => $policies->sum('premium_amount'),
            'next_renewal' => $policies->where('status', 'active')->sortBy('end_date')->first()
        ]);
    }

    public function activePolicies()
    {
        $policies = CustomerPolicy::where('user_id', Auth::id())
            ->where('status', 'active')
            ->with(['insuranceProduct.policyCategory'])
            ->orderBy('end_date', 'asc')
            ->get();

        return response()->json($policies);
    }

    public function policyHistory()
    {
        $policies = CustomerPolicy::where('user_id', Auth::id())
            ->with(['insuranceProduct'])
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($policies);
    }

    public function getDocuments($policyId)
    {
        $documents = PolicyDocument::where('user_id', Auth::id())
            ->where('customer_policy_id', $policyId)
            ->get();

        return response()->json($documents);
    }
}

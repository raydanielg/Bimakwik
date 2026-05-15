<?php

namespace App\Http\Controllers\Sfe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Claim;
use App\Models\CustomerPolicy;
use Illuminate\Support\Facades\Auth;

class SalesReportController extends Controller
{
    public function index()
    {
        $customerId = Customer::where('user_id', Auth::id())->value('id');
        $policies = $customerId ? CustomerPolicy::where('customer_id', $customerId)->get() : collect();
        $claims = $customerId ? Claim::where('customer_id', $customerId)->get() : collect();

        return view('sfe.performance.index', [
            'policies' => $policies,
            'claims' => $claims,
            'salesTotal' => $policies->sum('premium_amount'),
            'activePolicies' => $policies->where('status', 'active')->count(),
            'claimCount' => $claims->count(),
        ]);
    }
}

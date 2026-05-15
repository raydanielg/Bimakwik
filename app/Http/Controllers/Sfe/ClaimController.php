<?php

namespace App\Http\Controllers\Sfe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Claim;
use Illuminate\Support\Facades\Auth;

class ClaimController extends Controller
{
    public function index()
    {
        $customerId = Customer::where('user_id', Auth::id())->value('id');
        $claims = $customerId
            ? Claim::where('customer_id', $customerId)->latest()->take(10)->get()
            : collect();

        return view('sfe.claims.index', [
            'claims' => $claims,
            'submittedClaims' => $claims->where('status', 'submitted')->count(),
            'processingClaims' => $claims->where('status', 'processing')->count(),
            'approvedClaimsTotal' => $claims->sum('approved_amount'),
        ]);
    }

    public function create()
    {
        return view('sfe.claims.create', [
            'claims' => (function () {
                $customerId = Customer::where('user_id', Auth::id())->value('id');
                return $customerId
                    ? Claim::where('customer_id', $customerId)->latest()->take(5)->get()
                    : collect();
            })(),
        ]);
    }
}

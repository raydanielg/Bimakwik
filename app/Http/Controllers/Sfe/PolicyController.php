<?php

namespace App\Http\Controllers\Sfe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\CustomerPolicy;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class PolicyController extends Controller
{
    public function index()
    {
        $customerId = Customer::where('user_id', Auth::id())->value('id');
        $policies = $customerId
            ? CustomerPolicy::where('customer_id', $customerId)->latest()->take(10)->get()
            : collect();

        return view('sfe.policies.index', [
            'policies' => $policies,
            'activePolicies' => $policies->where('status', 'active')->count(),
            'totalPremiums' => $policies->sum('premium_amount'),
        ]);
    }

    public function create()
    {
        return view('sfe.policies.create', [
            'products' => Product::where('is_active', true)->orderBy('name')->get(),
        ]);
    }
}

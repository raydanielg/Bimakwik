<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerPolicy;

class CustomerPolicyController extends Controller
{
    public function index()
    {
        $policies = collect();
        try {
            $policies = CustomerPolicy::where('customer_id', auth()->id())
                ->with('product')
                ->latest()
                ->paginate(10);
        } catch (\Exception $e) {}
        return view('customer.policies.index', compact('policies'));
    }

    public function show($id)
    {
        $policy = null;
        try {
            $policy = CustomerPolicy::where('customer_id', auth()->id())
                ->with('product')
                ->findOrFail($id);
        } catch (\Exception $e) {}
        return view('customer.policies.show', compact('policy'));
    }
}

<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerPolicy;
use Illuminate\Support\Facades\DB;

class CustomerPolicyController extends Controller
{
    public function index()
    {
        $policies = collect();
        try {
            $userId = auth()->id();
            $customerId = DB::table('customers')->where('user_id', $userId)->value('id');
            
            if ($customerId) {
                $policies = CustomerPolicy::where('customer_id', $customerId)
                    ->with(['product', 'insurer'])
                    ->latest()
                    ->paginate(10);
            }
        } catch (\Exception $e) {}
        return view('customer.policies.index', compact('policies'));
    }

    public function show($id)
    {
        $policy = null;
        try {
            $userId = auth()->id();
            $customerId = DB::table('customers')->where('user_id', $userId)->value('id');
            
            if ($customerId) {
                $policy = CustomerPolicy::where('customer_id', $customerId)
                    ->where('id', $id)
                    ->with(['product', 'insurer'])
                    ->first();
            }
        } catch (\Exception $e) {}
        return view('customer.policies.show', compact('policy'));
    }
}

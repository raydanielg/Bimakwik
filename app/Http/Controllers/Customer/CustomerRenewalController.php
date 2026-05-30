<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerPolicy;

class CustomerRenewalController extends Controller
{
    public function index()
    {
        $renewals = collect();
        try {
            $renewals = CustomerPolicy::where('customer_id', auth()->id())
                ->where('end_date', '<=', now()->addDays(30))
                ->with('product')
                ->latest()
                ->paginate(10);
        } catch (\Exception $e) {}
        return view('customer.policies.renewals', compact('renewals'));
    }
}

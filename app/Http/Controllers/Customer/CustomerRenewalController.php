<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerPolicy;
use Illuminate\Support\Facades\DB;

class CustomerRenewalController extends Controller
{
    public function index()
    {
        $renewals = collect();
        try {
            $customerId = DB::table('customers')->where('user_id', auth()->id())->value('id');
            if ($customerId) {
                $renewals = CustomerPolicy::where('customer_id', $customerId)
                    ->where('end_date', '<=', now()->addDays(60))
                    ->with(['product', 'insurer'])
                    ->latest()
                    ->paginate(10);
            }
        } catch (\Exception $e) {}
        return view('customer.policies.renewals', compact('renewals'));
    }
}

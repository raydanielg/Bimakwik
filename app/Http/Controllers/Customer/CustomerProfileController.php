<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\CustomerKycDocument;

class CustomerProfileController extends Controller
{
    public function index()
    {
        $customer = null;
        $kycDocuments = collect();
        
        try {
            $customer = Customer::where('user_id', auth()->id())->first();
            if ($customer) {
                $kycDocuments = CustomerKycDocument::where('customer_id', $customer->id)
                    ->latest()
                    ->get();
            }
        } catch (\Exception $e) {}
        
        return view('customer.profile', compact('customer', 'kycDocuments'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'address' => 'nullable|string',
            'dob' => 'nullable|date',
        ]);

        try {
            $customer = Customer::where('user_id', auth()->id())->first();
            if ($customer) {
                $customer->update($validated);
            }
            return back()->with('success', 'Profile updated');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update profile');
        }
    }
}

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
            'name'          => 'nullable|string|max:255',
            'phone_number'  => 'nullable|string|max:20',
            'gender'        => 'nullable|in:male,female,other',
            'date_of_birth' => 'nullable|date',
            'id_number'     => 'nullable|string|max:30',
            'address'       => 'nullable|string|max:500',
        ]);

        try {
            $customer = Customer::where('user_id', auth()->id())->first();
            if ($customer) {
                $customer->update(array_filter($validated, fn($v) => $v !== null));
            }
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Profile updated successfully!']);
            }
            return back()->with('success', 'Profile updated successfully!');
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Failed to update profile.'], 422);
            }
            return back()->with('error', 'Failed to update profile.');
        }
    }
}

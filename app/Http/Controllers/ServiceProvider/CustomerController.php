<?php

namespace App\Http\Controllers\ServiceProvider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\CustomerPolicy;
use App\Models\CustomerKycDocument;

class CustomerController extends Controller
{
    public function index()
    {
        return view('service-provider.customer.verify');
    }

    public function verify(Request $request)
    {
        $validated = $request->validate([
            'policy_number' => 'nullable|string',
            'customer_id' => 'nullable|string',
            'phone_number' => 'nullable|string',
        ]);

        $customer = null;
        $policy = null;
        $kycDocuments = collect();

        try {
            // Search by policy number
            if (!empty($validated['policy_number'])) {
                $policy = CustomerPolicy::where('policy_number', $validated['policy_number'])
                    ->with('customer', 'product')
                    ->first();
                if ($policy) {
                    $customer = $policy->customer;
                }
            }
            // Search by customer ID/NIN
            elseif (!empty($validated['customer_id'])) {
                $customer = Customer::where('nin', $validated['customer_id'])
                    ->orWhere('id', $validated['customer_id'])
                    ->first();
                if ($customer) {
                    $policy = CustomerPolicy::where('customer_id', $customer->id)
                        ->with('product')
                        ->latest()
                        ->first();
                }
            }
            // Search by phone number
            elseif (!empty($validated['phone_number'])) {
                $customer = Customer::where('phone', $validated['phone_number'])->first();
                if ($customer) {
                    $policy = CustomerPolicy::where('customer_id', $customer->id)
                        ->with('product')
                        ->latest()
                        ->first();
                }
            }

            if ($customer) {
                $kycDocuments = CustomerKycDocument::where('customer_id', $customer->id)
                    ->latest()
                    ->get();
            }
        } catch (\Exception $e) {}

        return view('service-provider.customer.verify', compact('customer', 'policy', 'kycDocuments'));
    }

    public function list()
    {
        $customers = collect();
        try {
            $customers = Customer::with('policies')->latest()->paginate(15);
        } catch (\Exception $e) {}
        return view('service-provider.customer.list', compact('customers'));
    }

    public function show($id)
    {
        $customer = null;
        $policies = collect();
        $kycDocuments = collect();

        try {
            $customer = Customer::with('profile')->findOrFail($id);
            $policies = CustomerPolicy::where('customer_id', $id)
                ->with('product')
                ->latest()
                ->get();
            $kycDocuments = CustomerKycDocument::where('customer_id', $id)
                ->latest()
                ->get();
        } catch (\Exception $e) {}

        return view('service-provider.customer.show', compact('customer', 'policies', 'kycDocuments'));
    }

    public function kycDocuments($id)
    {
        $customer = null;
        $documents = collect();

        try {
            $customer = Customer::findOrFail($id);
            $documents = CustomerKycDocument::where('customer_id', $id)
                ->latest()
                ->paginate(15);
        } catch (\Exception $e) {}

        return view('service-provider.customer.kyc', compact('customer', 'documents'));
    }

    public function verificationHistory($id)
    {
        $customer = null;
        $history = collect();

        try {
            $customer = Customer::findOrFail($id);
            $history = \App\Models\CustomerKycHistory::where('customer_id', $id)
                ->latest()
                ->paginate(15);
        } catch (\Exception $e) {}

        return view('service-provider.customer.history', compact('customer', 'history'));
    }
}

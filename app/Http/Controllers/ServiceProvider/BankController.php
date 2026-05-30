<?php

namespace App\Http\Controllers\ServiceProvider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceProviderBankDetail;

class BankController extends Controller
{
    public function index()
    {
        $bankDetails = null;
        try {
            $bankDetails = ServiceProviderBankDetail::where('service_provider_id', auth()->id())->first();
        } catch (\Exception $e) {}
        return view('service-provider.bank.index', compact('bankDetails'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'bank_name' => 'required|string',
            'account_name' => 'required|string',
            'account_number' => 'required|string',
            'branch' => 'nullable|string',
            'swift_code' => 'nullable|string',
            'tax_id' => 'nullable|string',
            'payment_method' => 'required|string',
            'minimum_payment_amount' => 'nullable|numeric',
            'payment_frequency' => 'required|string',
        ]);

        try {
            ServiceProviderBankDetail::updateOrCreate(
                ['service_provider_id' => auth()->id()],
                $validated
            );
            return back()->with('success', 'Bank details updated');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update bank details');
        }
    }
}

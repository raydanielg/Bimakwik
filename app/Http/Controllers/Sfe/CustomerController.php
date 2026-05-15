<?php

namespace App\Http\Controllers\Sfe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\CustomerPolicy;
use App\Models\KycSubmission;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::where('user_id', Auth::id())->latest()->take(10)->get();

        return view('sfe.customers.index', [
            'customers' => $customers,
            'kycPendingCount' => $customers->where('kyc_status', 'pending')->count(),
            'kycApprovedCount' => $customers->where('kyc_status', 'approved')->count(),
            'recentKyc' => KycSubmission::where('user_id', Auth::id())->latest()->take(5)->get(),
        ]);
    }

    public function create()
    {
        return view('sfe.customers.create');
    }

    public function kycStatus()
    {
        $submission = KycSubmission::where('user_id', Auth::id())
            ->latest()
            ->with('documents')
            ->first();

        return view('sfe.customers.kyc', [
            'submission' => $submission,
            'documents' => $submission?->documents ?? collect(),
        ]);
    }
}

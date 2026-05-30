<?php

namespace App\Http\Controllers\ServiceProvider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentTransaction;
use App\Models\ServiceProviderPayment;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = collect();
        $stats = [
            'total_paid' => 0,
            'pending' => 0,
            'this_month' => 0,
            'growth' => 0,
        ];

        try {
            $payments = ServiceProviderPayment::with('serviceProvider')->latest()->paginate(15);
            $stats = [
                'total_paid' => ServiceProviderPayment::where('status', 'completed')->sum('amount') ?? 0,
                'pending' => ServiceProviderPayment::where('status', 'pending')->sum('amount') ?? 0,
                'this_month' => ServiceProviderPayment::where('status', 'completed')
                    ->whereMonth('created_at', now()->month)
                    ->sum('amount') ?? 0,
                'growth' => 0, // Calculate growth based on previous month
            ];
        } catch (\Exception $e) {}

        return view('service-provider.payments.index', compact('payments', 'stats'));
    }

    public function show($id)
    {
        $payment = null;
        try {
            $payment = ServiceProviderPayment::with('serviceProvider')->findOrFail($id);
        } catch (\Exception $e) {}
        return view('service-provider.payments.show', compact('payment'));
    }

    public function create()
    {
        return view('service-provider.payments.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:1000',
            'currency' => 'required|string',
            'reference' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        try {
            ServiceProviderPayment::create([
                ...$validated,
                'service_provider_id' => auth()->id(),
                'status' => 'pending',
                'payment_date' => now(),
            ]);
            return redirect()->route('service-provider.payments.index')->with('success', 'Payment recorded');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to record payment');
        }
    }
}

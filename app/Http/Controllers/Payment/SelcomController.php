<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Services\SelcomPaymentService;
use Illuminate\Http\Request;

class SelcomController extends Controller
{
    protected SelcomPaymentService $selcom;

    public function __construct(SelcomPaymentService $selcom)
    {
        $this->selcom = $selcom;
    }

    public function pay(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:1000',
            'reference' => 'required|string',
            'policy_id' => 'nullable|exists:customer_policies,id',
            'phone' => 'nullable|string',
        ]);

        if (!$this->selcom->isEnabled()) {
            return back()->with('error', 'Selcom payment is currently disabled');
        }

        $result = $this->selcom->createOrder($validated['amount'], $validated['reference'], 'TZS', $validated['phone'] ?? null);

        if ($result['success']) {
            return response()->json(['success' => true, 'order_id' => $result['order_id'], 'data' => $result['data']]);
        }

        return back()->with('error', 'Payment initiation failed: ' . ($result['error'] ?? 'Unknown error'));
    }

    public function status(Request $request, string $orderId)
    {
        $result = $this->selcom->checkOrderStatus($orderId);
        return response()->json($result);
    }

    public function webhook(Request $request)
    {
        $result = $this->selcom->handleWebhook($request->all());

        if ($result['success']) {
            return response()->json(['result' => 'ok']);
        }

        return response()->json(['result' => 'error', 'message' => $result['error']], 400);
    }

    public function success(Request $request)
    {
        return redirect()->route('dashboard')->with('success', 'Payment completed successfully');
    }

    public function cancel(Request $request)
    {
        return redirect()->route('dashboard')->with('info', 'Payment was cancelled');
    }
}

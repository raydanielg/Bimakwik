<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SupportTicket;

class CustomerSupportController extends Controller
{
    public function index()
    {
        $tickets = collect();
        try {
            $tickets = SupportTicket::where('user_id', auth()->id())
                ->latest()
                ->paginate(15);
        } catch (\Exception $e) {}
        return view('customer.support', compact('tickets'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject'  => 'required|string|max:255',
            'category' => 'required|string',
            'message'  => 'required|string',
        ]);

        try {
            SupportTicket::create([
                'user_id'     => auth()->id(),
                'subject'     => $validated['subject'],
                'category'    => $validated['category'],
                'description' => $validated['message'],
                'status'      => 'open',
                'priority'    => 'medium',
            ]);

            if ($request->expectsJson()) {
                return response()->json(['message' => 'Ticket submitted! We will respond within 2 hours.']);
            }
            return back()->with('success', 'Support ticket submitted successfully.');
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Failed to submit ticket: ' . $e->getMessage()], 422);
            }
            return back()->with('error', 'Failed to submit ticket.');
        }
    }
}

<?php

namespace App\Http\Controllers\ServiceProvider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SupportTicket;

class SupportController extends Controller
{
    public function index()
    {
        $tickets = collect();
        try {
            $tickets = SupportTicket::where('user_id', auth()->id())
                ->latest()
                ->paginate(15);
        } catch (\Exception $e) {}
        return view('service-provider.support.index', compact('tickets'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string',
            'category' => 'required|string',
            'description' => 'required|string',
            'attachments' => 'nullable|array',
        ]);

        try {
            SupportTicket::create([
                ...$validated,
                'user_id' => auth()->id(),
                'status' => 'open',
                'priority' => 'medium',
            ]);
            return back()->with('success', 'Support request submitted');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to submit request');
        }
    }

    public function show($id)
    {
        $ticket = null;
        try {
            $ticket = SupportTicket::with('replies')->where('user_id', auth()->id())->findOrFail($id);
        } catch (\Exception $e) {}
        return view('service-provider.support.show', compact('ticket'));
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SupportTicket;
use App\Models\SupportTicketReply;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SupportController extends Controller
{
    public function createTicket(Request $request)
    {
        $request->validate([
            'category' => 'required|string',
            'priority' => 'required|in:low,medium,high',
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $ticket = SupportTicket::create([
            'ticket_number' => 'SUP-' . strtoupper(Str::random(8)),
            'user_id' => Auth::id(),
            'category' => $request->category,
            'priority' => $request->priority,
            'subject' => $request->subject,
            'description' => $request->description,
            'status' => 'open',
            'sla_response_deadline' => now()->addHours(24), // Default 24h
        ]);

        return response()->json([
            'message' => 'Support ticket created',
            'ticket_number' => $ticket->ticket_number,
            'status' => $ticket->status
        ], 201);
    }

    public function listTickets()
    {
        $tickets = SupportTicket::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($tickets);
    }

    public function getTicketDetails($id)
    {
        $ticket = SupportTicket::where('user_id', Auth::id())
            ->with('replies')
            ->findOrFail($id);

        return response()->json($ticket);
    }
}

<?php

namespace App\Http\Controllers\Bancassurance;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\CommissionTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommissionController extends Controller
{
    public function index()
    {
        $agent = Agent::where('user_id', Auth::id())->first();
        $agentId = $agent?->id;

        $commissions = CommissionTransaction::where('recipient_type', 'bancassurance_user')
            ->where('recipient_id', $agentId)
            ->with(['customerPolicy.customer', 'customerPolicy.product'])
            ->latest()
            ->paginate(20);

        return view('bancassurance.commissions.index', [
            'commissions' => $commissions,
            'totalCommission' => $commissions->sum('commission_amount'),
            'pendingCommission' => $commissions->where('status', 'pending')->sum('commission_amount'),
            'paidCommission' => $commissions->where('status', 'paid')->sum('commission_amount'),
            'policiesSold' => $commissions->unique('customer_policy_id')->count(),
        ]);
    }
}

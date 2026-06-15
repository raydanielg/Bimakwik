<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CommissionTransaction;
use App\Models\CommissionRate;
use Illuminate\Http\Request;

class CommissionReportController extends Controller
{
    public function index(Request $request)
    {
        $period = $request->get('period', 'all');
        $channel = $request->get('channel', '');
        $status = $request->get('status', '');

        $query = CommissionTransaction::with(['policy', 'rate']);

        if ($period === 'today') {
            $query->whereDate('created_at', today());
        } elseif ($period === 'week') {
            $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
        } elseif ($period === 'month') {
            $query->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year);
        }

        if ($channel) {
            $query->where('channel_type', $channel);
        }

        if ($status) {
            $query->where('status', $status);
        }

        $transactions = $query->latest()->paginate(50);

        // Aggregates
        $totals = CommissionTransaction::selectRaw("
            COALESCE(SUM(CASE WHEN status='pending' THEN commission_amount ELSE 0 END), 0) as pending_total,
            COALESCE(SUM(CASE WHEN status='paid' THEN commission_amount ELSE 0 END), 0) as paid_total,
            COALESCE(SUM(CASE WHEN status='approved' THEN commission_amount ELSE 0 END), 0) as approved_total,
            COUNT(*) as total_count
        ")->first();

        $byChannel = CommissionTransaction::selectRaw('channel_type, COUNT(*) as count, SUM(commission_amount) as total')
            ->groupBy('channel_type')->get();

        $byStatus = CommissionTransaction::selectRaw('status, COUNT(*) as count, SUM(commission_amount) as total')
            ->groupBy('status')->get();

        return view('admin.commissions.report', compact(
            'transactions', 'totals', 'byChannel', 'byStatus',
            'period', 'channel', 'status'
        ));
    }

    public function pay(CommissionTransaction $transaction)
    {
        $transaction->update([
            'status' => 'paid',
            'paid_at' => now(),
        ]);
        return back()->with('success', 'Commission marked as paid.');
    }

    public function payBulk(Request $request)
    {
        $ids = $request->input('ids', []);
        if (empty($ids)) return back()->with('error', 'No transactions selected.');

        CommissionTransaction::whereIn('id', $ids)->where('status', 'pending')->update([
            'status' => 'paid',
            'paid_at' => now(),
        ]);

        return back()->with('success', count($ids) . ' commissions paid.');
    }
}

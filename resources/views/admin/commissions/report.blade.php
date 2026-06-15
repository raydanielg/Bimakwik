@extends('layouts.dashboard')

@section('dashboard_title', 'Commission Report')

@section('content')
<div class="row mb-4">
    <div class="col-12 d-flex justify-content-between align-items-center flex-wrap gap-2">
        <h4 class="fw-bold mb-0"><i class="bi bi-bar-chart-line me-2"></i>Commission Report</h4>
        <form method="GET" class="d-flex gap-2 align-items-center flex-wrap">
            <select name="period" class="form-select form-select-sm" style="width:auto">
                <option value="all" {{ $period === 'all' ? 'selected' : '' }}>All Time</option>
                <option value="today" {{ $period === 'today' ? 'selected' : '' }}>Today</option>
                <option value="week" {{ $period === 'week' ? 'selected' : '' }}>This Week</option>
                <option value="month" {{ $period === 'month' ? 'selected' : '' }}>This Month</option>
            </select>
            <select name="channel" class="form-select form-select-sm" style="width:auto">
                <option value="">All Channels</option>
                <option value="agent" {{ $channel === 'agent' ? 'selected' : '' }}>Agent</option>
                <option value="broker" {{ $channel === 'broker' ? 'selected' : '' }}>Broker</option>
                <option value="bancassurance" {{ $channel === 'bancassurance' ? 'selected' : '' }}>Bancassurance</option>
                <option value="sfe" {{ $channel === 'sfe' ? 'selected' : '' }}>SFE</option>
            </select>
            <select name="status" class="form-select form-select-sm" style="width:auto">
                <option value="">All Status</option>
                <option value="pending" {{ $status === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="approved" {{ $status === 'approved' ? 'selected' : '' }}>Approved</option>
                <option value="paid" {{ $status === 'paid' ? 'selected' : '' }}>Paid</option>
            </select>
            <button class="btn btn-sm btn-outline-primary"><i class="bi bi-funnel"></i> Filter</button>
        </form>
    </div>
</div>

<!-- Summary Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h6 class="text-muted small mb-1">Pending</h6>
                <h4 class="fw-bold text-warning mb-0">TZS {{ number_format($totals->pending_total, 0) }}</h4>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h6 class="text-muted small mb-1">Approved</h6>
                <h4 class="fw-bold text-info mb-0">TZS {{ number_format($totals->approved_total, 0) }}</h4>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h6 class="text-muted small mb-1">Paid</h6>
                <h4 class="fw-bold text-success mb-0">TZS {{ number_format($totals->paid_total, 0) }}</h4>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h6 class="text-muted small mb-1">Total Transactions</h6>
                <h4 class="fw-bold mb-0">{{ $totals->total_count }}</h4>
            </div>
        </div>
    </div>
</div>

<!-- By Channel -->
<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white fw-semibold"><i class="bi bi-pie-chart me-1"></i> By Channel</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm mb-0">
                        <thead><tr><th>Channel</th><th>Count</th><th>Total (TZS)</th></tr></thead>
                        <tbody>
                            @foreach($byChannel as $row)
                            <tr>
                                <td><span class="badge bg-info">{{ $row->channel_type }}</span></td>
                                <td>{{ $row->count }}</td>
                                <td class="fw-semibold">{{ number_format($row->total, 0) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white fw-semibold"><i class="bi bi-bar-chart me-1"></i> By Status</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm mb-0">
                        <thead><tr><th>Status</th><th>Count</th><th>Total (TZS)</th></tr></thead>
                        <tbody>
                            @foreach($byStatus as $row)
                            <tr>
                                <td><span class="badge bg-{{ $row->status === 'paid' ? 'success' : ($row->status === 'pending' ? 'warning' : 'info') }}">
                                    {{ ucfirst($row->status) }}
                                </span></td>
                                <td>{{ $row->count }}</td>
                                <td class="fw-semibold">{{ number_format($row->total, 0) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Transactions Table -->
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <span class="fw-semibold">Transactions</span>
        <span class="text-muted small">{{ $transactions->total() }} total</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Policy</th>
                        <th>Channel</th>
                        <th>Recipient</th>
                        <th>Premium</th>
                        <th>Rate</th>
                        <th>Commission</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $txn)
                    <tr>
                        <td class="small">{{ $txn->policy?->policy_number ?? '-' }}</td>
                        <td><span class="badge bg-info">{{ $txn->channel_type }}</span></td>
                        <td class="small">{{ ucfirst($txn->recipient_type) }} #{{ $txn->recipient_id }}</td>
                        <td>TZS {{ number_format($txn->premium_amount, 0) }}</td>
                        <td>{{ $txn->rate_type === 'percentage' ? $txn->rate_value . '%' : 'TZS ' . number_format($txn->rate_value, 0) }}</td>
                        <td class="fw-semibold">TZS {{ number_format($txn->commission_amount, 0) }}</td>
                        <td>
                            <span class="badge bg-{{ $txn->status === 'paid' ? 'success' : ($txn->status === 'pending' ? 'warning' : 'info') }}">
                                {{ ucfirst($txn->status) }}
                            </span>
                        </td>
                        <td class="small">{{ $txn->created_at->format('d/m/Y') }}</td>
                        <td class="text-end">
                            @if($txn->status === 'pending')
                            <form action="{{ route('admin.commissions.report.pay', $txn) }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-sm btn-success" onclick="return confirm('Mark as paid?')">
                                    <i class="bi bi-check-lg"></i> Pay
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="9" class="text-center py-4 text-muted">No transactions found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($transactions->hasPages())
    <div class="card-footer bg-white">{{ $transactions->links() }}</div>
    @endif
</div>
@endsection

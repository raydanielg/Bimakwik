@extends('layouts.dashboard')

@section('content')
<div class="container-fluid py-4">
    @include('insurer._partials.page-header', [
        'title' => 'Commission Payable',
        'subtitle' => 'Track commission transactions for policies',
        'icon' => 'bi-cash-coin'
    ])

    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-warning bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-hourglass-split text-warning fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted small">Pending</h6>
                            <h4 class="mb-0 fw-bold">TZS {{ number_format($totalPending, 0) }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-success bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-check-circle-fill text-success fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted small">Paid</h6>
                            <h4 class="mb-0 fw-bold">TZS {{ number_format($totalPaid, 0) }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-receipt text-primary fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted small">Total Transactions</h6>
                            <h4 class="mb-0 fw-bold">{{ $transactions->total() }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Policy #</th>
                            <th>Channel</th>
                            <th>Recipient</th>
                            <th>Premium</th>
                            <th>Rate</th>
                            <th>Commission</th>
                            <th>Status</th>
                            <th>Date</th>
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
                                <span class="badge bg-{{ $txn->status === 'paid' ? 'success' : ($txn->status === 'pending' ? 'warning' : 'secondary') }}">
                                    {{ ucfirst($txn->status) }}
                                </span>
                            </td>
                            <td class="small">{{ $txn->created_at->format('d/m/Y') }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="8" class="text-center py-5 text-muted">No commission transactions yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($transactions->hasPages())
        <div class="card-footer bg-white">{{ $transactions->links() }}</div>
        @endif
    </div>
</div>
@endsection

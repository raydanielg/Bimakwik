@extends('layouts.dashboard')

@section('content')
<div class="container-fluid py-4">
    @include('insurer._partials.page-header', [
        'title' => 'Commissions',
        'subtitle' => 'Track your commission earnings from insurance sales',
        'icon' => 'bi-percent'
    ])

    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-wallet text-primary fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted small">Total Commission</h6>
                            <h4 class="mb-0 fw-bold">TZS {{ number_format($totalCommission, 0) }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-warning bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-hourglass text-warning fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted small">Pending</h6>
                            <h4 class="mb-0 fw-bold">TZS {{ number_format($pendingCommission, 0) }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-success bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-check-circle text-success fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted small">Paid</h6>
                            <h4 class="mb-0 fw-bold">TZS {{ number_format($paidCommission, 0) }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-info bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-file-earmark-text text-info fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted small">Policies Sold</h6>
                            <h4 class="mb-0 fw-bold">{{ $policiesSold }}</h4>
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
                            <th>Customer</th>
                            <th>Product</th>
                            <th>Premium</th>
                            <th>Rate</th>
                            <th>Commission</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($commissions as $txn)
                        <tr>
                            <td class="small">{{ $txn->customerPolicy?->policy_number ?? 'N/A' }}</td>
                            <td>{{ $txn->customerPolicy?->customer?->name ?? 'N/A' }}</td>
                            <td class="small">{{ $txn->customerPolicy?->product?->product_name ?? 'N/A' }}</td>
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
                        <tr><td colspan="8" class="text-center py-5 text-muted">No commissions yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($commissions->hasPages())
        <div class="card-footer bg-white">{{ $commissions->links() }}</div>
        @endif
    </div>
</div>
@endsection

@extends('layouts.dashboard')

@section('dashboard_title', __('sfe.commissions_title'))

@section('dashboard_content')
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-4 h-100">
            <div class="text-muted small text-uppercase">{{ __('sfe.wallet_balance') }}</div>
            <div class="fs-3 fw-bold">TZS {{ number_format($wallet->balance ?? 0, 2) }}</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-4 h-100">
            <div class="text-muted small text-uppercase">{{ __('sfe.credits') }}</div>
            <div class="fs-3 fw-bold">TZS {{ number_format($creditTotal, 2) }}</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-4 h-100">
            <div class="text-muted small text-uppercase">{{ __('sfe.debits') }}</div>
            <div class="fs-3 fw-bold">TZS {{ number_format($debitTotal, 2) }}</div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm p-4 mb-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="fw-bold mb-0">{{ __('sfe.commissions_wallet') }}</h6>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle small">
            <thead class="table-light">
                <tr>
                    <th>{{ __('sfe.reference') }}</th>
                    <th>{{ __('sfe.type') }}</th>
                    <th>{{ __('sfe.amount') }}</th>
                    <th>{{ __('sfe.status') }}</th>
                    <th>{{ __('sfe.date') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $transaction)
                    <tr>
                        <td class="fw-semibold">{{ $transaction->transaction_reference }}</td>
                        <td>{{ ucfirst($transaction->transaction_type) }}</td>
                        <td>TZS {{ number_format($transaction->amount, 2) }}</td>
                        <td><span class="badge bg-info-soft text-info">{{ ucfirst($transaction->status) }}</span></td>
                        <td>{{ $transaction->created_at }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-muted">{{ __('sfe.no_wallet_transactions_found') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <h6 class="fw-bold mb-3"><i class="bi bi-percent me-1"></i> Policy Commissions</h6>
        <div class="table-responsive">
            <table class="table table-hover align-middle small">
                <thead class="table-light">
                    <tr>
                        <th>Policy</th>
                        <th>Customer</th>
                        <th>Product</th>
                        <th>Premium</th>
                        <th>Commission</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($commissions as $txn)
                    <tr>
                        <td class="fw-semibold">{{ $txn->customerPolicy?->policy_number ?? 'N/A' }}</td>
                        <td>{{ $txn->customerPolicy?->customer?->name ?? 'N/A' }}</td>
                        <td>{{ $txn->customerPolicy?->product?->product_name ?? 'N/A' }}</td>
                        <td>TZS {{ number_format($txn->premium_amount, 0) }}</td>
                        <td class="fw-bold text-success">TZS {{ number_format($txn->commission_amount, 0) }}</td>
                        <td>
                            <span class="badge bg-{{ $txn->status === 'paid' ? 'success' : ($txn->status === 'pending' ? 'warning' : 'secondary') }}">
                                {{ ucfirst($txn->status) }}
                            </span>
                        </td>
                        <td>{{ $txn->created_at->format('d/m/Y') }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-muted text-center py-4">No policy commissions yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if(method_exists($commissions, 'hasPages') && $commissions->hasPages())
    <div class="card-footer bg-white">{{ $commissions->links() }}</div>
    @endif
</div>
@endsection

@extends('layouts.dashboard')

@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Wallet Details</h4>
        <small class="text-muted">Wallet #{{ $wallet->id }} — {{ $wallet->user?->name ?? 'Unknown User' }}</small>
    </div>
    <div>
        <a href="{{ route('admin.finance.wallets') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
            <i class="bi bi-arrow-left me-1"></i> Back to Wallets
        </a>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm bg-primary bg-opacity-10">
            <div class="card-body text-center">
                <h5 class="fw-bold text-primary mb-1">{{ number_format($wallet->balance, 2) }}</h5>
                <small class="text-muted">Current Balance</small>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm bg-success bg-opacity-10">
            <div class="card-body text-center">
                <h5 class="fw-bold text-success mb-1">{{ $wallet->is_active ? 'Active' : 'Frozen' }}</h5>
                <small class="text-muted">Status</small>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm bg-info bg-opacity-10">
            <div class="card-body text-center">
                <h5 class="fw-bold text-info mb-1">{{ $wallet->currency ?? 'TZS' }}</h5>
                <small class="text-muted">Currency</small>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white border-bottom">
                <h6 class="fw-semibold mb-0">Transaction History</h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-3">Reference</th>
                                <th>Type</th>
                                <th>Amount</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th class="pe-3">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transactions as $tx)
                            <tr>
                                <td class="ps-3"><code>{{ $tx->transaction_reference ?? 'N/A' }}</code></td>
                                <td>
                                    <span class="badge bg-{{ $tx->transaction_type === 'credit' ? 'success' : 'danger' }}">
                                        {{ ucfirst($tx->transaction_type) }}
                                    </span>
                                </td>
                                <td class="fw-bold">{{ number_format($tx->amount, 2) }}</td>
                                <td>{{ $tx->description ?? '—' }}</td>
                                <td>
                                    <span class="badge bg-{{ $tx->status === 'completed' ? 'success' : 'warning' }}">
                                        {{ ucfirst($tx->status) }}
                                    </span>
                                </td>
                                <td class="pe-3"><small class="text-muted">{{ $tx->created_at?->format('d M Y H:i') }}</small></td>
                            </tr>
                            @empty
                            <tr><td colspan="6" class="text-center text-muted py-4">No transactions found</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($transactions->hasPages())
            <div class="card-footer bg-white border-0">
                {{ $transactions->links() }}
            </div>
            @endif
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom">
                <h6 class="fw-semibold mb-0">Withdrawals</h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-3">Amount</th>
                                <th>Status</th>
                                <th class="pe-3">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($withdrawals as $w)
                            <tr>
                                <td class="ps-3 fw-bold">{{ number_format($w->amount, 2) }}</td>
                                <td>
                                    <span class="badge bg-{{ $w->status === 'approved' ? 'success' : ($w->status === 'rejected' ? 'danger' : 'warning') }}">
                                        {{ ucfirst($w->status) }}
                                    </span>
                                </td>
                                <td class="pe-3"><small class="text-muted">{{ $w->created_at?->format('d M Y') }}</small></td>
                            </tr>
                            @empty
                            <tr><td colspan="3" class="text-center text-muted py-4">No withdrawals found</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

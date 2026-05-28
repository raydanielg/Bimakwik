@extends('layouts.dashboard')
@section('dashboard_title', 'Wallet')
@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">My Wallet</h4>
        <p class="text-muted mb-0 small">Your commission wallet and withdrawal history</p>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm bg-primary text-white">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-2">
                    <i class="bi bi-wallet2 fs-3 me-3 opacity-75"></i>
                    <div>
                        <div class="small opacity-75">Wallet Balance</div>
                        <div class="fw-bold fs-4">TZS {{ number_format(optional($wallet)->balance ?? 0, 0) }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4 d-flex align-items-center gap-3">
                <div class="bg-success bg-opacity-10 text-success rounded-3 p-3" style="width:50px;height:50px;display:flex;align-items:center;justify-content:center;"><i class="bi bi-cash-coin fs-4"></i></div>
                <div>
                    <div class="text-muted small">Total Commission</div>
                    <div class="fw-bold fs-5">TZS {{ number_format($totalCommission, 0) }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4 d-flex align-items-center gap-3">
                <div class="bg-info bg-opacity-10 text-info rounded-3 p-3" style="width:50px;height:50px;display:flex;align-items:center;justify-content:center;"><i class="bi bi-clock-history fs-4"></i></div>
                <div>
                    <div class="text-muted small">Recent Transactions</div>
                    <div class="fw-bold fs-5">{{ $recentTransactions->count() }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 py-3">
                <h6 class="fw-bold mb-0">Recent Transactions</h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Type</th>
                                <th>Description</th>
                                <th>Amount</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentTransactions as $tx)
                            <tr>
                                <td class="ps-4">
                                    @if($tx->type === 'credit')
                                        <span class="badge bg-success-subtle text-success"><i class="bi bi-arrow-down me-1"></i>Credit</span>
                                    @else
                                        <span class="badge bg-danger-subtle text-danger"><i class="bi bi-arrow-up me-1"></i>Debit</span>
                                    @endif
                                </td>
                                <td class="small text-muted">{{ $tx->description ?? 'Transaction' }}</td>
                                <td class="fw-bold {{ $tx->type === 'credit' ? 'text-success' : 'text-danger' }}">
                                    {{ $tx->type === 'credit' ? '+' : '-' }} TZS {{ number_format($tx->amount, 0) }}
                                </td>
                                <td class="text-muted small">{{ $tx->created_at?->format('M d, Y') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">
                                    <i class="bi bi-wallet2 fs-2 d-block mb-2 opacity-25"></i>No transactions yet.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 py-3">
                <h6 class="fw-bold mb-0">Withdrawal History</h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Amount</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pendingWithdrawals as $wd)
                            <tr>
                                <td class="ps-4 fw-bold">TZS {{ number_format($wd->amount, 0) }}</td>
                                <td>
                                    @if($wd->status === 'approved')
                                        <span class="badge bg-success-subtle text-success">Approved</span>
                                    @elseif($wd->status === 'pending')
                                        <span class="badge bg-warning-subtle text-warning">Pending</span>
                                    @else
                                        <span class="badge bg-danger-subtle text-danger">Rejected</span>
                                    @endif
                                </td>
                                <td class="text-muted small">{{ $wd->created_at?->format('M d, Y') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center py-4 text-muted">No withdrawals yet.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($pendingWithdrawals instanceof \Illuminate\Pagination\LengthAwarePaginator && $pendingWithdrawals->hasPages())
            <div class="card-footer bg-white border-0 py-3 px-4">{{ $pendingWithdrawals->links() }}</div>
            @endif
        </div>
    </div>
</div>
@endsection

@extends('layouts.dashboard')
@section('dashboard_title', 'My Wallet')
@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">My Wallet</h4>
        <p class="text-muted mb-0 small">Your wallet balance and recent activity</p>
    </div>
    <a href="{{ route('broker.wallet.cashout') }}" class="btn btn-primary">
        <i class="bi bi-cash-stack me-1"></i> Request Cash-out
    </a>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm bg-primary text-white">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-wallet2 fs-3 me-3 opacity-75"></i>
                    <div>
                        <div class="small opacity-75">Current Balance</div>
                        <div class="fw-bold fs-4">TZS {{ number_format(optional($wallet)->balance ?? 0, 0) }}</div>
                    </div>
                </div>
                <div class="small opacity-75">Wallet ID: {{ optional($wallet)->id ?? 'N/A' }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4 d-flex align-items-center gap-3">
                <div class="bg-success bg-opacity-10 text-success rounded-3 p-3" style="width:50px;height:50px;display:flex;align-items:center;justify-content:center;"><i class="bi bi-cash-coin fs-4"></i></div>
                <div>
                    <div class="text-muted small">Total Commission Earned</div>
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

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-0 py-3">
        <h6 class="fw-bold mb-0">Recent Transactions</h6>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Ref #</th>
                        <th>Type</th>
                        <th>Description</th>
                        <th>Amount</th>
                        <th>Balance After</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentTransactions as $tx)
                    <tr>
                        <td class="ps-4"><code class="small">{{ $tx->reference ?? '-' }}</code></td>
                        <td>
                            @if($tx->type === 'credit')
                                <span class="badge bg-success-subtle text-success"><i class="bi bi-arrow-down me-1"></i>Credit</span>
                            @else
                                <span class="badge bg-danger-subtle text-danger"><i class="bi bi-arrow-up me-1"></i>Debit</span>
                            @endif
                        </td>
                        <td>{{ $tx->description ?? 'Transaction' }}</td>
                        <td class="fw-bold {{ $tx->type === 'credit' ? 'text-success' : 'text-danger' }}">
                            {{ $tx->type === 'credit' ? '+' : '-' }} TZS {{ number_format($tx->amount, 0) }}
                        </td>
                        <td>TZS {{ number_format($tx->balance_after ?? 0, 0) }}</td>
                        <td class="text-muted small">{{ $tx->created_at?->format('M d, Y H:i') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-wallet2 fs-2 d-block mb-2 opacity-25"></i>
                            No transactions yet.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white border-0 py-3 px-4">
        <a href="{{ route('broker.transactions') }}" class="btn btn-sm btn-outline-primary">View All Transactions</a>
    </div>
</div>
@endsection

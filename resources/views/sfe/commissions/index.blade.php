@extends('layouts.dashboard')

@section('dashboard_title', 'Commissions')

@section('dashboard_content')
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-4 h-100">
            <div class="text-muted small text-uppercase">Wallet Balance</div>
            <div class="fs-3 fw-bold">TZS {{ number_format($wallet->balance ?? 0, 2) }}</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-4 h-100">
            <div class="text-muted small text-uppercase">Credits</div>
            <div class="fs-3 fw-bold">TZS {{ number_format($creditTotal, 2) }}</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-4 h-100">
            <div class="text-muted small text-uppercase">Debits</div>
            <div class="fs-3 fw-bold">TZS {{ number_format($debitTotal, 2) }}</div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="fw-bold mb-0">Commissions and Wallet</h6>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle small">
            <thead class="table-light">
                <tr>
                    <th>Reference</th>
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Date</th>
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
                        <td colspan="5" class="text-muted">No wallet transactions found yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

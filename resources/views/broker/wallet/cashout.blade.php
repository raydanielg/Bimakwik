@extends('layouts.dashboard')
@section('dashboard_title', 'Request Cash-out')
@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Request Cash-out</h4>
        <p class="text-muted mb-0 small">Withdraw your commission earnings to your bank account</p>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif
@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="row g-4">
    <div class="col-md-5">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 py-3">
                <h6 class="fw-bold mb-0">Withdrawal Request</h6>
            </div>
            <div class="card-body p-4">
                <div class="bg-primary bg-opacity-10 rounded-3 p-3 mb-4 d-flex align-items-center gap-3">
                    <i class="bi bi-wallet2 text-primary fs-4"></i>
                    <div>
                        <div class="small text-muted">Available Balance</div>
                        <div class="fw-bold fs-5">TZS {{ number_format(optional($wallet)->balance ?? 0, 0) }}</div>
                    </div>
                </div>
                <form action="{{ route('broker.wallet.cashout.submit') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Amount (TZS)</label>
                        <input type="number" name="amount" class="form-control @error('amount') is-invalid @enderror" min="1000" max="{{ optional($wallet)->balance ?? 0 }}" placeholder="Minimum TZS 1,000" value="{{ old('amount') }}" required>
                        @error('amount')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Bank Name</label>
                        <input type="text" name="bank_name" class="form-control @error('bank_name') is-invalid @enderror" placeholder="e.g. CRDB Bank" value="{{ old('bank_name') }}" required>
                        @error('bank_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold small">Bank Account Number</label>
                        <input type="text" name="bank_account" class="form-control @error('bank_account') is-invalid @enderror" placeholder="e.g. 0123456789" value="{{ old('bank_account') }}" required>
                        @error('bank_account')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-send me-1"></i> Submit Withdrawal Request
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-7">
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
                                <th>Bank</th>
                                <th>Account</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pendingWithdrawals as $wd)
                            <tr>
                                <td class="ps-4 fw-bold">TZS {{ number_format($wd->amount, 0) }}</td>
                                <td>{{ $wd->bank_name }}</td>
                                <td><code class="small">{{ $wd->bank_account }}</code></td>
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
                                <td colspan="5" class="text-center py-4 text-muted">
                                    <i class="bi bi-cash-stack fs-2 d-block mb-2 opacity-25"></i>
                                    No withdrawal history.
                                </td>
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

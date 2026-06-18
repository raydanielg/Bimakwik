@extends('layouts.dashboard')

@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Offline Payment #{{ $transaction->id }}</h4>
        <small class="text-muted">Offline payment details</small>
    </div>
    <div>
        <a href="{{ route('payment.offline.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
            <i class="bi bi-arrow-left me-1"></i> Back
        </a>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white border-bottom">
                <h6 class="fw-semibold mb-0">Payment Details</h6>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-4 text-muted small">Reference</div>
                    <div class="col-md-8"><code>{{ $transaction->reference ?? 'N/A' }}</code></div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 text-muted small">Amount</div>
                    <div class="col-md-8 fw-bold">{{ number_format($transaction->amount, 2) }} {{ $transaction->currency ?? 'TZS' }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 text-muted small">Status</div>
                    <div class="col-md-8">
                        <span class="badge bg-{{ $transaction->status === 'completed' ? 'success' : ($transaction->status === 'failed' ? 'danger' : 'warning') }}">
                            {{ ucfirst($transaction->status) }}
                        </span>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 text-muted small">User</div>
                    <div class="col-md-8">{{ $transaction->user?->name ?? 'N/A' }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 text-muted small">Policy</div>
                    <div class="col-md-8">{{ $transaction->policy?->policy_number ?? 'N/A' }}</div>
                </div>
                @if($transaction->metadata && isset($transaction->metadata['notes']))
                <div class="row mb-3">
                    <div class="col-md-4 text-muted small">Notes</div>
                    <div class="col-md-8">{{ $transaction->metadata['notes'] }}</div>
                </div>
                @endif
                <div class="row mb-3">
                    <div class="col-md-4 text-muted small">Date</div>
                    <div class="col-md-8">{{ $transaction->created_at?->format('d M Y H:i') }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom">
                <h6 class="fw-semibold mb-0">Actions</h6>
            </div>
            <div class="card-body">
                @if(in_array($transaction->status, ['pending', 'processing']))
                <form method="POST" action="{{ route('payment.offline.approve', $transaction) }}" class="mb-2">
                    @csrf
                    <button type="submit" class="btn btn-success w-100 rounded-pill">
                        <i class="bi bi-check-lg me-1"></i> Approve Payment
                    </button>
                </form>
                <form method="POST" action="{{ route('payment.offline.reject', $transaction) }}">
                    @csrf
                    <div class="mb-2">
                        <textarea name="reason" class="form-control form-control-sm" placeholder="Rejection reason" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-outline-danger w-100 rounded-pill">
                        <i class="bi bi-x-lg me-1"></i> Reject Payment
                    </button>
                </form>
                @else
                <div class="alert alert-info border-0 mb-0">
                    <i class="bi bi-info-circle me-2"></i>
                    Payment is already {{ $transaction->status }}.
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

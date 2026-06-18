@extends('layouts.dashboard')

@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Record Payment</h4>
        <small class="text-muted">Manually record a payment transaction</small>
    </div>
    <div>
        <a href="{{ route('payment.transactions.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
            <i class="bi bi-arrow-left me-1"></i> Back
        </a>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('payment.transactions.store') }}">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">User <span class="text-danger">*</span></label>
                    <select name="user_id" class="form-select" required>
                        <option value="">Select user...</option>
                        @foreach(App\Models\User::latest()->limit(50)->get() as $u)
                        <option value="{{ $u->id }}" @selected(old('user_id') == $u->id)>{{ $u->name }} ({{ $u->email }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Amount <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" name="amount" class="form-control" required value="{{ old('amount') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Currency</label>
                    <select name="currency" class="form-select">
                        <option value="TZS" @selected(old('currency') == 'TZS')>TZS</option>
                        <option value="USD" @selected(old('currency') == 'USD')>USD</option>
                        <option value="EUR" @selected(old('currency') == 'EUR')>EUR</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Payment Method <span class="text-danger">*</span></label>
                    <select name="payment_method" class="form-select" required>
                        <option value="">Select method...</option>
                        <option value="mobile_money" @selected(old('payment_method') == 'mobile_money')>Mobile Money</option>
                        <option value="card" @selected(old('payment_method') == 'card')>Card</option>
                        <option value="bank_transfer" @selected(old('payment_method') == 'bank_transfer')>Bank Transfer</option>
                        <option value="cash" @selected(old('payment_method') == 'cash')>Cash</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Transaction Reference</label>
                    <input type="text" name="transaction_reference" class="form-control" value="{{ old('transaction_reference') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="pending" @selected(old('status') == 'pending')>Pending</option>
                        <option value="completed" @selected(old('status') == 'completed')>Completed</option>
                        <option value="failed" @selected(old('status') == 'failed')>Failed</option>
                    </select>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-check-lg me-1"></i> Record Payment
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

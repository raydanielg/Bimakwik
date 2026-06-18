@extends('layouts.dashboard')

@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Record Offline Payment</h4>
        <small class="text-muted">Manually record an offline or bank payment</small>
    </div>
    <div>
        <a href="{{ route('payment.offline.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
            <i class="bi bi-arrow-left me-1"></i> Back
        </a>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('payment.offline.store') }}" enctype="multipart/form-data">
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
                    <label class="form-label">Policy (Optional)</label>
                    <select name="policy_id" class="form-select">
                        <option value="">Select policy...</option>
                        @foreach(App\Models\CustomerPolicy::latest()->limit(50)->get() as $p)
                        <option value="{{ $p->id }}" @selected(old('policy_id') == $p->id)>{{ $p->policy_number }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Amount <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" name="amount" class="form-control" required value="{{ old('amount') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Currency <span class="text-danger">*</span></label>
                    <select name="currency" class="form-select" required>
                        <option value="TZS" @selected(old('currency') == 'TZS')>TZS</option>
                        <option value="USD" @selected(old('currency') == 'USD')>USD</option>
                        <option value="EUR" @selected(old('currency') == 'EUR')>EUR</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Reference / Receipt # <span class="text-danger">*</span></label>
                    <input type="text" name="reference" class="form-control" required value="{{ old('reference') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Payment Proof</label>
                    <input type="file" name="payment_proof" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                </div>
                <div class="col-md-12">
                    <label class="form-label">Notes</label>
                    <textarea name="notes" class="form-control" rows="3">{{ old('notes') }}</textarea>
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

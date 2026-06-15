@extends('layouts.dashboard')

@section('dashboard_title', __('sfe.buy_policy_title'))

@section('dashboard_content')
<div class="card border-0 shadow-sm p-4 mb-4">
    <div class="d-flex flex-wrap justify-content-between align-items-start gap-3">
        <div>
            <h5 class="fw-bold mb-2">Issue New Policy</h5>
            <p class="text-muted mb-0">Create a new insurance policy for a customer</p>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm p-4">
            <h6 class="fw-bold mb-4">Policy Details</h6>
            <form action="{{ route('sfe.policies.store') }}" method="POST">
                @csrf

                <div class="row g-3 mb-3">
                    <div class="col-md-12">
                        <label class="form-label">Product *</label>
                        <select name="product_id" class="form-select" required>
                            <option value="">Select product</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                    {{ $product->product_name }} (TZS {{ number_format($product->base_premium ?? 0, 0) }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Premium Amount (TZS) *</label>
                        <input type="number" name="premium_amount" class="form-control" value="{{ old('premium_amount') }}" required min="0" step="0.01">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Start Date *</label>
                        <input type="date" name="start_date" class="form-control" value="{{ old('start_date') }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">End Date *</label>
                        <input type="date" name="end_date" class="form-control" value="{{ old('end_date') }}" required>
                    </div>
                </div>

                <hr class="my-4">

                <h6 class="fw-bold mb-3">TIRAMIS Codes <small class="text-muted fw-normal">(optional)</small></h6>
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Company Code</label>
                        <input type="text" name="company_code" class="form-control" value="{{ old('company_code') }}" placeholder="e.g. ICC113">
                        <div class="form-text">TIRA-assigned insurer company code</div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Sale Point Code</label>
                        <input type="text" name="sale_point_code" class="form-control" value="{{ old('sale_point_code') }}" placeholder="e.g. SP677">
                        <div class="form-text">TIRA-assigned sale point identifier</div>
                    </div>
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg me-1"></i> Issue Policy
                    </button>
                    <a href="{{ route('sfe.policies.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm p-4">
            <h6 class="fw-bold mb-3">Instructions</h6>
            <ul class="mb-0 ps-3 text-muted small">
                <li class="mb-2">Select a product from the catalog</li>
                <li class="mb-2">Choose coverage level based on customer needs</li>
                <li class="mb-2">Set premium amount and policy dates</li>
                <li class="mb-2">Enter TIRA codes if required for compliance</li>
                <li>Click "Issue Policy" to create the policy</li>
            </ul>
        </div>
    </div>
</div>
@endsection
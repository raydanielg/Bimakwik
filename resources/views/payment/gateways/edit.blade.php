@extends('layouts.dashboard')

@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Edit Payment Gateway</h4>
        <small class="text-muted">Update gateway configuration</small>
    </div>
    <div>
        <a href="{{ route('payment.gateways.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
            <i class="bi bi-arrow-left me-1"></i> Back
        </a>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('payment.gateways.update', $gateway) }}">
            @csrf
            @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Gateway Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" required value="{{ old('name', $gateway->name) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Code <span class="text-danger">*</span></label>
                    <input type="text" name="code" class="form-control" required value="{{ old('code', $gateway->code) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Type <span class="text-danger">*</span></label>
                    <select name="type" class="form-select" required>
                        <option value="">Select type...</option>
                        <option value="mobile_money" @selected(old('type', $gateway->type) == 'mobile_money')>Mobile Money</option>
                        <option value="card" @selected(old('type', $gateway->type) == 'card')>Card</option>
                        <option value="bank_transfer" @selected(old('type', $gateway->type) == 'bank_transfer')>Bank Transfer</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Environment <span class="text-danger">*</span></label>
                    <select name="environment" class="form-select" required>
                        <option value="sandbox" @selected(old('environment', $gateway->environment) == 'sandbox')>Sandbox</option>
                        <option value="production" @selected(old('environment', $gateway->environment) == 'production')>Production</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">API Key</label>
                    <input type="text" name="api_key" class="form-control" value="{{ old('api_key', $gateway->api_key) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">API Secret</label>
                    <input type="text" name="api_secret" class="form-control" value="{{ old('api_secret', $gateway->api_secret) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Merchant ID</label>
                    <input type="text" name="merchant_id" class="form-control" value="{{ old('merchant_id', $gateway->merchant_id) }}">
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-check-lg me-1"></i> Update Gateway
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

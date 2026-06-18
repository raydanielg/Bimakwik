@extends('layouts.dashboard')

@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">{{ $gateway->name }}</h4>
        <small class="text-muted">Gateway details and configuration</small>
    </div>
    <div>
        <a href="{{ route('payment.gateways.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
            <i class="bi bi-arrow-left me-1"></i> Back
        </a>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white border-bottom">
                <h6 class="fw-semibold mb-0">Gateway Details</h6>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-4 text-muted small">Code</div>
                    <div class="col-md-8"><code>{{ $gateway->code }}</code></div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 text-muted small">Type</div>
                    <div class="col-md-8">{{ ucfirst(str_replace('_', ' ', $gateway->type)) }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 text-muted small">Environment</div>
                    <div class="col-md-8">
                        <span class="badge bg-{{ $gateway->environment === 'production' ? 'success' : 'warning' }}">
                            {{ ucfirst($gateway->environment) }}
                        </span>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 text-muted small">Status</div>
                    <div class="col-md-8">
                        <span class="badge bg-{{ $gateway->is_active ? 'success' : 'secondary' }}">
                            {{ $gateway->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                </div>
                @if($gateway->api_key)
                <div class="row mb-3">
                    <div class="col-md-4 text-muted small">API Key</div>
                    <div class="col-md-8"><code>{{ Str::mask($gateway->api_key, '*', 4) }}</code></div>
                </div>
                @endif
                @if($gateway->merchant_id)
                <div class="row mb-3">
                    <div class="col-md-4 text-muted small">Merchant ID</div>
                    <div class="col-md-8">{{ $gateway->merchant_id }}</div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom">
                <h6 class="fw-semibold mb-0">Actions</h6>
            </div>
            <div class="card-body">
                <a href="{{ route('payment.gateways.edit', $gateway) }}" class="btn btn-outline-primary w-100 rounded-pill mb-2">
                    <i class="bi bi-pencil me-1"></i> Edit Gateway
                </a>
                <form method="POST" action="{{ route('payment.gateways.destroy', $gateway) }}" onsubmit="return confirm('Delete this gateway?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger w-100 rounded-pill">
                        <i class="bi bi-trash me-1"></i> Delete Gateway
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

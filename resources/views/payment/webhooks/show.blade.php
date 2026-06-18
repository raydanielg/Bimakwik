@extends('layouts.dashboard')

@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Webhook #{{ $webhook->id }}</h4>
        <small class="text-muted">Webhook event details</small>
    </div>
    <div>
        <a href="{{ route('payment.webhooks.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
            <i class="bi bi-arrow-left me-1"></i> Back
        </a>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white border-bottom">
                <h6 class="fw-semibold mb-0">Webhook Details</h6>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-4 text-muted small">Gateway</div>
                    <div class="col-md-8">{{ $webhook->paymentGateway?->name ?? 'N/A' }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 text-muted small">Event Type</div>
                    <div class="col-md-8"><code>{{ $webhook->event_type }}</code></div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 text-muted small">Status</div>
                    <div class="col-md-8">
                        <span class="badge bg-{{ $webhook->processed ? 'success' : 'warning' }}">
                            {{ $webhook->processed ? 'Processed' : 'Pending' }}
                        </span>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 text-muted small">Payload</div>
                    <div class="col-md-8">
                        <pre class="bg-light p-2 rounded small"><code>{{ json_encode($webhook->payload, JSON_PRETTY_PRINT) }}</code></pre>
                    </div>
                </div>
                @if($webhook->response)
                <div class="row mb-3">
                    <div class="col-md-4 text-muted small">Response</div>
                    <div class="col-md-8">
                        <pre class="bg-light p-2 rounded small"><code>{{ json_encode($webhook->response, JSON_PRETTY_PRINT) }}</code></pre>
                    </div>
                </div>
                @endif
                <div class="row mb-3">
                    <div class="col-md-4 text-muted small">Created</div>
                    <div class="col-md-8">{{ $webhook->created_at?->format('d M Y H:i') }}</div>
                </div>
                @if($webhook->processed_at)
                <div class="row mb-3">
                    <div class="col-md-4 text-muted small">Processed At</div>
                    <div class="col-md-8">{{ $webhook->processed_at?->format('d M Y H:i') }}</div>
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
                @if(!$webhook->processed)
                <form method="POST" action="{{ route('payment.webhooks.retry', $webhook) }}" class="mb-2">
                    @csrf
                    <button type="submit" class="btn btn-warning w-100 rounded-pill">
                        <i class="bi bi-arrow-repeat me-1"></i> Retry Processing
                    </button>
                </form>
                @endif
                <form method="POST" action="{{ route('payment.webhooks.destroy', $webhook) }}" onsubmit="return confirm('Delete this webhook?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger w-100 rounded-pill">
                        <i class="bi bi-trash me-1"></i> Delete Webhook
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

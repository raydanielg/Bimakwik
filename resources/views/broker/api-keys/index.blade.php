@extends('layouts.dashboard')
@section('dashboard_title', 'API Keys')
@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">API Keys</h4>
        <p class="text-muted mb-0 small">Manage your API access keys for integrations</p>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        @forelse($apiKeys as $key)
        <div class="d-flex align-items-center justify-content-between p-4 border-bottom">
            <div class="d-flex align-items-center gap-3">
                <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3" style="width:46px;height:46px;display:flex;align-items:center;justify-content:center;">
                    <i class="bi bi-key-fill"></i>
                </div>
                <div>
                    <div class="fw-bold">{{ $key->name ?? 'API Key' }}</div>
                    <code class="small text-muted">{{ substr($key->key ?? $key->token ?? '', 0, 20) }}••••••••</code>
                </div>
            </div>
            <div class="d-flex align-items-center gap-3">
                <div class="text-end">
                    <div class="small text-muted">Created</div>
                    <div class="small">{{ $key->created_at?->format('M d, Y') }}</div>
                </div>
                @if(($key->status ?? 'active') === 'active')
                    <span class="badge bg-success-subtle text-success">Active</span>
                @else
                    <span class="badge bg-secondary-subtle text-secondary">Inactive</span>
                @endif
            </div>
        </div>
        @empty
        <div class="text-center py-5 text-muted">
            <i class="bi bi-key fs-2 d-block mb-2 opacity-25"></i>
            No API keys found.<br>
            <small>Contact your administrator to generate API access keys.</small>
        </div>
        @endforelse
    </div>
</div>

<div class="card border-0 shadow-sm mt-4">
    <div class="card-body p-4">
        <h6 class="fw-bold mb-3"><i class="bi bi-info-circle text-primary me-2"></i>API Usage Guide</h6>
        <p class="small text-muted mb-2">Use your API key in the Authorization header:</p>
        <pre class="bg-light rounded-3 p-3 small"><code>Authorization: Bearer YOUR_API_KEY
Content-Type: application/json</code></pre>
        <p class="small text-muted mb-0">Keep your API keys secure. Never share them publicly or commit them to version control.</p>
    </div>
</div>
@endsection

@extends('layouts.dashboard')

@section('dashboard_content')
<div class="row mb-4">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <div>
            <h2 class="fw-bold mb-1"><i class="bi bi-code-slash text-primary me-2"></i>Developer Portal</h2>
            <p class="text-muted small mb-0">API management, keys, and developer resources</p>
        </div>
        <button class="btn btn-primary" onclick="generateApiKey()">
            <i class="bi bi-plus-lg me-1"></i>Generate New API Key
        </button>
    </div>
</div>

<!-- Stats -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Active API Keys</p>
                        <h3 class="fw-bold mb-0">{{ number_format($totalKeys) }}</h3>
                    </div>
                    <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-key-fill text-primary fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Registered Apps</p>
                        <h3 class="fw-bold mb-0">{{ number_format($totalApps) }}</h3>
                    </div>
                    <div class="bg-info bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-app-indicator text-info fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">API Calls Today</p>
                        <h3 class="fw-bold mb-0">{{ number_format($apiCallsToday) }}</h3>
                    </div>
                    <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-graph-up text-warning fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Success Rate</p>
                        <h3 class="fw-bold mb-0">{{ $successRate }}%</h3>
                    </div>
                    <div class="bg-success bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-check-circle-fill text-success fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- API Keys Table -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold"><i class="bi bi-key me-2 text-primary"></i>API Keys</h5>
        <span class="badge bg-primary bg-opacity-10 text-primary">{{ $apiKeys->count() }} active</span>
    </div>
    <div class="card-body p-0">
        @if($apiKeys->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Name</th>
                        <th>Key (Masked)</th>
                        <th>Environment</th>
                        <th>Status</th>
                        <th>Last Used</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($apiKeys as $key)
                    <tr>
                        <td class="fw-semibold">{{ $key->name ?? 'Untitled' }}</td>
                        <td><code class="small">{{ substr($key->api_key ?? $key->key ?? 'sk_xxxx', 0, 8) }}...{{ substr($key->api_key ?? $key->key ?? 'xxxx', -4) }}</code></td>
                        <td><span class="badge bg-{{ ($key->environment ?? 'production') == 'production' ? 'success' : 'warning' }} bg-opacity-10 text-{{ ($key->environment ?? 'production') == 'production' ? 'success' : 'warning' }}">{{ ucfirst($key->environment ?? 'Production') }}</span></td>
                        <td><span class="badge bg-success bg-opacity-10 text-success">Active</span></td>
                        <td class="text-muted small">{{ $key->last_used_at ? \Carbon\Carbon::parse($key->last_used_at)->diffForHumans() : 'Never' }}</td>
                        <td>
                            <button class="btn btn-sm btn-outline-danger" onclick="revokeKey({{ $key->id }})"><i class="bi bi-x-circle"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="text-center py-5 text-muted">
            <i class="bi bi-key fs-1 d-block mb-3"></i>
            <p class="mb-0">No API keys generated yet</p>
            <small>Click "Generate New API Key" to create one</small>
        </div>
        @endif
    </div>
</div>

<!-- API Documentation Card -->
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-bottom py-3">
        <h5 class="mb-0 fw-bold"><i class="bi bi-book me-2 text-primary"></i>API Documentation & Resources</h5>
    </div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-4">
                <a href="/docs/api" class="text-decoration-none">
                    <div class="p-3 border rounded-3 h-100 hover-lift">
                        <i class="bi bi-file-earmark-code fs-3 text-primary mb-2"></i>
                        <h6 class="fw-bold mb-1">REST API Reference</h6>
                        <p class="small text-muted mb-0">Complete REST API documentation with examples</p>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="/docs/webhooks" class="text-decoration-none">
                    <div class="p-3 border rounded-3 h-100 hover-lift">
                        <i class="bi bi-link-45deg fs-3 text-info mb-2"></i>
                        <h6 class="fw-bold mb-1">Webhooks Guide</h6>
                        <p class="small text-muted mb-0">Real-time event notifications</p>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="/docs/sdks" class="text-decoration-none">
                    <div class="p-3 border rounded-3 h-100 hover-lift">
                        <i class="bi bi-box-seam fs-3 text-success mb-2"></i>
                        <h6 class="fw-bold mb-1">SDKs & Libraries</h6>
                        <p class="small text-muted mb-0">PHP, Node.js, Python, Java SDKs</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function generateApiKey() {
    Swal.fire({
        title: 'Generate New API Key',
        html: `
            <div class="mb-3">
                <label class="swal2-label text-start d-block mb-2">Key Name</label>
                <input id="keyName" class="swal2-input" placeholder="e.g., Production API, Mobile App">
            </div>
            <div class="mb-3">
                <label class="swal2-label text-start d-block mb-2">Environment</label>
                <select id="keyEnv" class="swal2-input">
                    <option value="production">Production</option>
                    <option value="sandbox">Sandbox</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="swal2-label text-start d-block mb-2">Rate Limit (per minute)</label>
                <input id="keyRate" type="number" class="swal2-input" placeholder="e.g., 100" value="100">
            </div>
        `,
        showCancelButton: true,
        confirmButtonText: 'Generate',
        confirmButtonColor: '#0d6efd',
        cancelButtonColor: '#6c757d',
        preConfirm: () => {
            const name = document.getElementById('keyName').value;
            const env = document.getElementById('keyEnv').value;
            const rate = document.getElementById('keyRate').value;
            
            if (!name) {
                Swal.showValidationMessage('Key name is required');
                return false;
            }
            if (!rate || parseInt(rate) < 1) {
                Swal.showValidationMessage('Rate limit must be at least 1');
                return false;
            }
            return { name, env, rate };
        }
    }).then((result) => {
        if (result.isConfirmed) {
            const data = result.value;
            
            Swal.fire({
                title: 'Creating API Key...',
                icon: 'info',
                allowOutsideClick: false,
                didOpen: () => Swal.showLoading()
            });

            fetch('{{ route("admin.system.api-keys.generate") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                body: JSON.stringify({
                    name: data.name,
                    environment: data.env,
                    rate_limit: parseInt(data.rate),
                })
            })
            .then(r => r.json())
            .then(response => {
                if (response.success) {
                    const apiKey = response.key;
                    Swal.fire({
                        title: '✓ API Key Generated!',
                        html: `
                            <div class="text-start">
                                <p class="mb-2"><strong>Key Name:</strong> ${apiKey.name}</p>
                                <p class="mb-3">
                                    <strong>API Key:</strong><br>
                                    <code class="d-block p-2 bg-light rounded text-danger fw-bold" id="apiKeyDisplay">${apiKey.api_key}</code>
                                </p>
                                <p class="mb-3">
                                    <strong>API Secret:</strong><br>
                                    <code class="d-block p-2 bg-light rounded text-danger fw-bold" id="apiSecretDisplay">${apiKey.api_secret}</code>
                                </p>
                                <div class="alert alert-warning small">
                                    <i class="bi bi-exclamation-triangle me-2"></i>
                                    Copy both keys now - they won't be shown again!
                                </div>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-sm btn-outline-primary" onclick="copyToClipboard('apiKeyDisplay')">
                                        <i class="bi bi-clipboard me-1"></i>Copy Key
                                    </button>
                                    <button class="btn btn-sm btn-outline-primary" onclick="copyToClipboard('apiSecretDisplay')">
                                        <i class="bi bi-clipboard me-1"></i>Copy Secret
                                    </button>
                                </div>
                            </div>
                        `,
                        confirmButtonColor: '#0d6efd',
                        confirmButtonText: 'Done',
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed to Generate Key',
                        text: response.message || 'An error occurred',
                        confirmButtonColor: '#0d6efd',
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to generate API key: ' + error.message,
                    confirmButtonColor: '#0d6efd',
                });
            });
        }
    });
}

function revokeKey(id) {
    Swal.fire({
        title: 'Revoke API Key?',
        text: 'This action cannot be undone. Any applications using this key will stop working.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, Revoke',
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`{{ route('admin.system.api-keys.revoke', ':id') }}`.replace(':id', id), {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                }
            })
            .then(r => r.json())
            .then(response => {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Revoked!',
                        text: 'API key has been revoked successfully',
                        confirmButtonColor: '#0d6efd',
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed to Revoke',
                        text: response.message || 'An error occurred',
                        confirmButtonColor: '#0d6efd',
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to revoke API key: ' + error.message,
                    confirmButtonColor: '#0d6efd',
                });
            });
        }
    });
}

function copyToClipboard(elementId) {
    const element = document.getElementById(elementId);
    const text = element.innerText;
    navigator.clipboard.writeText(text).then(() => {
        Swal.fire({
            icon: 'success',
            title: 'Copied!',
            text: 'Copied to clipboard',
            timer: 2000,
            showConfirmButton: false,
        });
    });
}
</script>
<style>.hover-lift { transition: all .2s; cursor:pointer; } .hover-lift:hover { transform: translateY(-3px); box-shadow: 0 6px 16px rgba(0,0,0,.08); }</style>
@endpush
@endsection

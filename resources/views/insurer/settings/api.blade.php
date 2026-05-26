@extends('layouts.dashboard')

@section('content')
<div class="container-fluid py-4">
    @include('insurer._partials.page-header', [
        'title' => 'API & Webhooks',
        'subtitle' => 'Manage API keys and webhook configurations',
        'icon' => 'bi-code-slash'
    ])

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-key-fill text-primary fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">API Keys</h6>
                            <h4 class="mb-0 fw-bold">{{ $apiKeys->count() ?? 0 }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-success bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-link-45deg text-success fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Webhooks</h6>
                            <h4 class="mb-0 fw-bold">{{ $webhooks->count() ?? 0 }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-info bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-activity text-info fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Calls Today</h6>
                            <h4 class="mb-0 fw-bold">0</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-warning bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-exclamation-triangle-fill text-warning fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Failed Calls</h6>
                            <h4 class="mb-0 fw-bold">0</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">API Keys</h5>
                    <button class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-lg me-1"></i> Generate Key
                    </button>
                </div>
                <div class="card-body">
                    @if($apiKeys->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Key (Masked)</th>
                                        <th>Created</th>
                                        <th>Last Used</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($apiKeys as $key)
                                        <tr>
                                            <td class="fw-bold">{{ $key->name ?? 'N/A' }}</td>
                                            <td><code class="text-muted">{{ Str::mask($key->key ?? '', '*', 4, -4) }}</code></td>
                                            <td>{{ $key->created_at?->format('M d, Y') ?? 'N/A' }}</td>
                                            <td>{{ $key->last_used_at?->format('M d, Y') ?? 'Never' }}</td>
                                            <td>
                                                @if($key->is_active)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-secondary">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <button class="btn btn-outline-primary"><i class="bi bi-eye"></i></button>
                                                    <button class="btn btn-outline-secondary"><i class="bi bi-arrow-repeat"></i></button>
                                                    <button class="btn btn-outline-danger"><i class="bi bi-trash"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        @include('insurer._partials.empty-state', [
                            'icon' => 'bi-key-fill',
                            'title' => 'No API Keys',
                            'text' => 'No API keys have been generated yet.'
                        ])
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Webhooks</h5>
                    <button class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-lg me-1"></i> Add Webhook
                    </button>
                </div>
                <div class="card-body">
                    @if($webhooks->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Event</th>
                                        <th>URL</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($webhooks as $webhook)
                                        <tr>
                                            <td><span class="badge bg-primary">{{ $webhook->event ?? 'N/A' }}</span></td>
                                            <td>{{ Str::limit($webhook->url ?? 'N/A', 30) }}</td>
                                            <td>
                                                @if($webhook->is_active)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-secondary">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <button class="btn btn-outline-primary"><i class="bi bi-pencil"></i></button>
                                                    <button class="btn btn-outline-danger"><i class="bi bi-trash"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        @include('insurer._partials.empty-state', [
                            'icon' => 'bi-link-45deg',
                            'title' => 'No Webhooks',
                            'text' => 'No webhooks have been configured yet.'
                        ])
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3">
            <h5 class="mb-0">API Documentation</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2">
                                <div class="bg-primary bg-opacity-10 p-2 rounded me-2">
                                    <i class="bi bi-book text-primary"></i>
                                </div>
                                <h6 class="mb-0 fw-bold">Getting Started</h6>
                            </div>
                            <p class="text-muted small mb-2">Learn how to authenticate and make your first API call.</p>
                            <a href="#" class="btn btn-sm btn-outline-primary">View Docs</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2">
                                <div class="bg-success bg-opacity-10 p-2 rounded me-2">
                                    <i class="bi bi-list-check text-success"></i>
                                </div>
                                <h6 class="mb-0 fw-bold">API Reference</h6>
                            </div>
                            <p class="text-muted small mb-2">Complete reference for all available API endpoints.</p>
                            <a href="#" class="btn btn-sm btn-outline-primary">View Docs</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2">
                                <div class="bg-info bg-opacity-10 p-2 rounded me-2">
                                    <i class="bi bi-link-45deg text-info"></i>
                                </div>
                                <h6 class="mb-0 fw-bold">Webhooks Guide</h6>
                            </div>
                            <p class="text-muted small mb-2">Learn how to set up and configure webhooks for real-time events.</p>
                            <a href="#" class="btn btn-sm btn-outline-primary">View Docs</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.dashboard')

@section('dashboard_title', 'Developer Portal')

@section('dashboard_content')
<!-- Developer Portal Header Stats -->
<div class="row g-4 mb-4">
    <!-- API Requests -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-activity fs-4"></i>
                    </div>
                    <div class="text-success small fw-bold">99.9% Success</div>
                </div>
                <h6 class="text-uppercase small fw-bold text-muted mb-1">API Requests</h6>
                <h4 class="fw-bold mb-0">854.2K</h4>
                <div class="x-small text-muted mt-2">Past 24 Hours</div>
            </div>
        </div>
    </div>

    <!-- Active API Keys -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="bg-success bg-opacity-10 text-success rounded-3 p-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-key fs-4"></i>
                    </div>
                    <div class="text-success small fw-bold">Active</div>
                </div>
                <h6 class="text-uppercase small fw-bold text-muted mb-1">Active Keys</h6>
                <h4 class="fw-bold mb-0">12</h4>
                <div class="x-small text-muted mt-2">Across 3 Apps</div>
            </div>
        </div>
    </div>

    <!-- Avg Response Time -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="bg-info bg-opacity-10 text-info rounded-3 p-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-lightning-charge fs-4"></i>
                    </div>
                    <div class="text-primary small fw-bold">Optimal</div>
                </div>
                <h6 class="text-uppercase small fw-bold text-muted mb-1">Avg Latency</h6>
                <h4 class="fw-bold mb-0">124ms</h4>
                <div class="x-small text-muted mt-2">P95 Response Time</div>
            </div>
        </div>
    </div>

    <!-- System Uptime -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="bg-warning bg-opacity-10 text-warning rounded-3 p-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-hdd-network fs-4"></i>
                    </div>
                    <div class="text-warning small fw-bold">v2.1 Stable</div>
                </div>
                <h6 class="text-uppercase small fw-bold text-muted mb-1">System Health</h6>
                <h4 class="fw-bold mb-0">99.98%</h4>
                <div class="x-small text-muted mt-2">Operational</div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Documentation & Endpoints -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h6 class="fw-bold mb-0"><i class="bi bi-book me-2 text-primary"></i>Quick Documentation</h6>
                <a href="#" class="btn btn-sm btn-outline-primary">View Full API Docs</a>
            </div>
            
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="p-3 border rounded-3 text-center">
                        <i class="bi bi-shield-lock fs-3 text-primary d-block mb-2"></i>
                        <span class="small fw-bold">Authentication</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 border rounded-3 text-center">
                        <i class="bi bi-box-seam fs-3 text-success d-block mb-2"></i>
                        <span class="small fw-bold">Products API</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 border rounded-3 text-center">
                        <i class="bi bi-link-45deg fs-3 text-info d-block mb-2"></i>
                        <span class="small fw-bold">Webhooks</span>
                    </div>
                </div>
            </div>

            <h6 class="fw-bold mb-3 small">Top Used Endpoints</h6>
            <div class="list-group list-group-flush small border rounded-3 overflow-hidden">
                <div class="list-group-item d-flex justify-content-between align-items-center bg-light">
                    <span class="fw-bold text-muted">Endpoint</span>
                    <span class="fw-bold text-muted text-end">Volume</span>
                </div>
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <code>GET /v1/products/quotes</code>
                    <span class="badge bg-primary rounded-pill">342K</span>
                </div>
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <code>POST /v1/policies/create</code>
                    <span class="badge bg-primary rounded-pill">128K</span>
                </div>
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <code>GET /v1/customers/verify</code>
                    <span class="badge bg-primary rounded-pill">95K</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions & Sandbox -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm p-4 mb-4">
            <h6 class="fw-bold mb-4">Developer Tools</h6>
            <div class="d-grid gap-2">
                <button class="btn btn-primary d-flex align-items-center justify-content-center py-2">
                    <i class="bi bi-terminal me-2"></i> Open API Console
                </button>
                <button class="btn btn-outline-primary d-flex align-items-center justify-content-center py-2">
                    <i class="bi bi-plus-square me-2"></i> Create New App
                </button>
                <button class="btn btn-outline-info d-flex align-items-center justify-content-center py-2">
                    <i class="bi bi-bug me-2"></i> Test Webhook
                </button>
            </div>
        </div>

        <div class="card border-0 shadow-sm p-4 bg-dark text-white">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold mb-0 small"><i class="bi bi-box me-2 text-warning"></i>Sandbox Environment</h6>
                <span class="badge bg-warning text-dark">Active</span>
            </div>
            <div class="mb-3">
                <label class="x-small text-muted d-block mb-1">Sandbox Base URL</label>
                <code class="text-info">https://sandbox.bimakwik.com/api/v1</code>
            </div>
            <div class="d-grid">
                <button class="btn btn-sm btn-outline-light">Go to Sandbox</button>
            </div>
        </div>
    </div>
</div>

<style>
    .x-small { font-size: 0.7rem; }
    code { font-size: 0.8rem; background: rgba(13, 110, 253, 0.05); padding: 2px 5px; border-radius: 4px; }
</style>
@endsection

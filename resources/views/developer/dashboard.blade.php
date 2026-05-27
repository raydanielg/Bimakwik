@extends('layouts.dashboard')

@section('dashboard_title', __('developer.dashboard_title'))

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
                    <div class="text-success small fw-bold">{{ $successRate }}% {{ __('developer.success_rate') }}</div>
                </div>
                <h6 class="text-uppercase small fw-bold text-muted mb-1">{{ __('developer.api_requests') }}</h6>
                <h4 class="fw-bold mb-0">{{ $apiRequestsToday > 0 ? number_format($apiRequestsToday / 1000, 1) . 'K' : '0' }}</h4>
                <div class="x-small text-muted mt-2">{{ __('developer.past_24_hours') }}</div>
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
                    <div class="text-success small fw-bold">{{ __('developer.active') }}</div>
                </div>
                <h6 class="text-uppercase small fw-bold text-muted mb-1">{{ __('developer.active_keys') }}</h6>
                <h4 class="fw-bold mb-0">12</h4>
                <div class="x-small text-muted mt-2">{{ __('developer.across_apps') }}</div>
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
                    <div class="text-primary small fw-bold">{{ __('developer.optimal') }}</div>
                </div>
                <h6 class="text-uppercase small fw-bold text-muted mb-1">{{ __('developer.avg_latency') }}</h6>
                <h4 class="fw-bold mb-0">124ms</h4>
                <div class="x-small text-muted mt-2">{{ __('developer.p95_response') }}</div>
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
                    <div class="text-warning small fw-bold">v2.1 {{ __('developer.stable') }}</div>
                </div>
                <h6 class="text-uppercase small fw-bold text-muted mb-1">{{ __('developer.system_health') }}</h6>
                <h4 class="fw-bold mb-0">99.98%</h4>
                <div class="x-small text-muted mt-2">{{ __('developer.operational') }}</div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Documentation & Endpoints -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h6 class="fw-bold mb-0"><i class="bi bi-book me-2 text-primary"></i>{{ __('developer.quick_documentation') }}</h6>
                <a href="#" class="btn btn-sm btn-outline-primary">{{ __('developer.view_full_api_docs') }}</a>
            </div>
            
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="p-3 border rounded-3 text-center">
                        <i class="bi bi-shield-lock fs-3 text-primary d-block mb-2"></i>
                        <span class="small fw-bold">{{ __('developer.authentication') }}</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 border rounded-3 text-center">
                        <i class="bi bi-box-seam fs-3 text-success d-block mb-2"></i>
                        <span class="small fw-bold">{{ __('developer.products_api') }}</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 border rounded-3 text-center">
                        <i class="bi bi-link-45deg fs-3 text-info d-block mb-2"></i>
                        <span class="small fw-bold">{{ __('developer.webhooks') }}</span>
                    </div>
                </div>
            </div>

            <h6 class="fw-bold mb-3 small">{{ __('developer.top_used_endpoints') }}</h6>
            <div class="list-group list-group-flush small border rounded-3 overflow-hidden">
                <div class="list-group-item d-flex justify-content-between align-items-center bg-light">
                    <span class="fw-bold text-muted">{{ __('developer.endpoint') }}</span>
                    <span class="fw-bold text-muted text-end">{{ __('developer.volume') }}</span>
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
            <h6 class="fw-bold mb-4">{{ __('developer.developer_tools') }}</h6>
            <div class="d-grid gap-2">
                <button class="btn btn-primary d-flex align-items-center justify-content-center py-2">
                    <i class="bi bi-terminal me-2"></i> {{ __('developer.open_api_console') }}
                </button>
                <button class="btn btn-outline-primary d-flex align-items-center justify-content-center py-2">
                    <i class="bi bi-plus-square me-2"></i> {{ __('developer.create_new_app') }}
                </button>
                <button class="btn btn-outline-info d-flex align-items-center justify-content-center py-2">
                    <i class="bi bi-bug me-2"></i> {{ __('developer.test_webhook') }}
                </button>
            </div>
        </div>

        <div class="card border-0 shadow-sm p-4 bg-dark text-white">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold mb-0 small"><i class="bi bi-box me-2 text-warning"></i>{{ __('developer.sandbox_environment') }}</h6>
                <span class="badge bg-warning text-dark">{{ __('developer.active') }}</span>
            </div>
            <div class="mb-3">
                <label class="x-small text-muted d-block mb-1">{{ __('developer.sandbox_base_url') }}</label>
                <code class="text-info">https://sandbox.bimakwik.com/api/v1</code>
            </div>
            <div class="d-grid">
                <button class="btn btn-sm btn-outline-light">{{ __('developer.go_to_sandbox') }}</button>
            </div>
        </div>
    </div>
</div>

<style>
    .x-small { font-size: 0.7rem; }
    code { font-size: 0.8rem; background: rgba(13, 110, 253, 0.05); padding: 2px 5px; border-radius: 4px; }
</style>
@endsection

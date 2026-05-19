@extends('layouts.dashboard')

@section('dashboard_content')
<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold mb-1">Developer Portal</h2>
        <p class="text-muted small mb-0">API management and developer resources</p>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <p class="text-muted small mb-1">Active API Keys</p>
                <h3 class="fw-bold mb-0">24</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <p class="text-muted small mb-1">API Calls Today</p>
                <h3 class="fw-bold mb-0">12,456</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <p class="text-muted small mb-1">Success Rate</p>
                <h3 class="fw-bold mb-0">99.2%</h3>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <h5 class="fw-bold mb-3">API Documentation</h5>
        <div class="alert alert-info border-0">
            <i class="bi bi-info-circle me-2"></i>
            API documentation and endpoints would be listed here
        </div>
    </div>
</div>
@endsection

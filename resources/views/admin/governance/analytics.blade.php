@extends('layouts.dashboard')

@section('dashboard_content')
<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold mb-1">Advanced Analytics</h2>
        <p class="text-muted small mb-0">Business intelligence and data insights</p>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <p class="text-muted small mb-1">Total Revenue</p>
                <h3 class="fw-bold mb-0">TZS 245M</h3>
                <small class="text-success"><i class="bi bi-arrow-up"></i> 24.5%</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <p class="text-muted small mb-1">Active Policies</p>
                <h3 class="fw-bold mb-0">12,456</h3>
                <small class="text-success"><i class="bi bi-arrow-up"></i> 12.3%</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <p class="text-muted small mb-1">Claims Ratio</p>
                <h3 class="fw-bold mb-0">45.2%</h3>
                <small class="text-warning"><i class="bi bi-dash"></i> Stable</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <p class="text-muted small mb-1">Customer Satisfaction</p>
                <h3 class="fw-bold mb-0">4.8/5</h3>
                <small class="text-success"><i class="bi bi-arrow-up"></i> 0.3</small>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <h5 class="fw-bold mb-4">Revenue Trends</h5>
        <div class="alert alert-info border-0">
            <i class="bi bi-info-circle me-2"></i>
            Chart visualization would be integrated here using Chart.js or similar library
        </div>
    </div>
</div>
@endsection

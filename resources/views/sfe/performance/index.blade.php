@extends('layouts.dashboard')

@section('dashboard_title', 'Performance')

@section('dashboard_content')
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-4 h-100">
            <div class="text-muted small text-uppercase">Sales Total</div>
            <div class="fs-3 fw-bold">TZS {{ number_format($salesTotal, 2) }}</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-4 h-100">
            <div class="text-muted small text-uppercase">Active Policies</div>
            <div class="fs-3 fw-bold">{{ $activePolicies }}</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-4 h-100">
            <div class="text-muted small text-uppercase">Claims Logged</div>
            <div class="fs-3 fw-bold">{{ $claimCount }}</div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm p-4">
    <h6 class="fw-bold mb-3">Sales Performance</h6>
    <div class="row g-4">
        <div class="col-md-6">
            <div class="p-3 bg-light rounded-3 h-100">
                <div class="small text-muted mb-1">Policy Count</div>
                <div class="fs-4 fw-bold">{{ $policies->count() }}</div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="p-3 bg-light rounded-3 h-100">
                <div class="small text-muted mb-1">Claim Count</div>
                <div class="fs-4 fw-bold">{{ $claims->count() }}</div>
            </div>
        </div>
    </div>
</div>
@endsection

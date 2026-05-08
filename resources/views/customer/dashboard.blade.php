@extends('layouts.dashboard')

@section('dashboard_title', 'My Insurance Dashboard')

@section('dashboard_content')
<div class="row g-4 mb-4">
    <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm p-4 bg-gradient-primary text-white" style="background: linear-gradient(45deg, #0d6efd, #0dcaf0);">
            <h6 class="text-uppercase small fw-bold opacity-75">Active Policies</h6>
            <h2 class="fw-bold mb-0">2</h2>
            <p class="mt-3 small mb-0">Motor & Life Insurance</p>
        </div>
    </div>
    <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm p-4 bg-white">
            <h6 class="text-uppercase small fw-bold text-muted">Next Renewal</h6>
            <h2 class="fw-bold mb-0 text-primary">15 June</h2>
            <p class="mt-3 small mb-0 text-danger"><i class="bi bi-clock"></i> 12 days remaining</p>
        </div>
    </div>
    <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm p-4 bg-white">
            <h6 class="text-uppercase small fw-bold text-muted">Total Benefit Cover</h6>
            <h2 class="fw-bold mb-0 text-success">TZS 50.0M</h2>
            <p class="mt-3 small mb-0"><i class="bi bi-shield-check"></i> Fully Protected</p>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm p-4">
            <h5 class="fw-bold mb-4">My Active Policies</h5>
            <div class="list-group list-group-flush">
                <div class="list-group-item px-0 py-3 border-bottom">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 p-3 rounded-3 me-3 text-primary">
                            <i class="bi bi-car-front fs-3"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="fw-bold mb-1">Comprehensive Motor Insurance</h6>
                            <p class="small text-muted mb-0">Policy No: BK-MOT-2024-001</p>
                        </div>
                        <div class="text-end">
                            <span class="badge bg-success mb-1">Active</span>
                            <p class="small text-muted mb-0">Expires 15 June 2024</p>
                        </div>
                    </div>
                </div>
                <div class="list-group-item px-0 py-3 border-0">
                    <div class="d-flex align-items-center">
                        <div class="bg-info bg-opacity-10 p-3 rounded-3 me-3 text-info">
                            <i class="bi bi-person-check fs-3"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="fw-bold mb-1">Group Life Cover</h6>
                            <p class="small text-muted mb-0">Policy No: BK-LIFE-2024-085</p>
                        </div>
                        <div class="text-end">
                            <span class="badge bg-success mb-1">Active</span>
                            <p class="small text-muted mb-0">Expires 10 Jan 2025</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('pages.products') }}" class="btn btn-primary w-100">Buy New Policy</a>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm p-4 h-100">
            <h5 class="fw-bold mb-4">Quick Actions</h5>
            <div class="d-grid gap-3">
                <a href="{{ route('pages.claims') }}" class="btn btn-outline-danger d-flex align-items-center justify-content-center py-3">
                    <i class="bi bi-exclamation-octagon me-2"></i> File a New Claim
                </a>
                <a href="#" class="btn btn-outline-primary d-flex align-items-center justify-content-center py-3">
                    <i class="bi bi-download me-2"></i> Download ID Card
                </a>
                <a href="{{ route('support.help') }}" class="btn btn-outline-secondary d-flex align-items-center justify-content-center py-3">
                    <i class="bi bi-headset me-2"></i> Contact Support
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.dashboard')

@section('dashboard_title', 'Super Admin Dashboard')

@section('dashboard_content')
<!-- Header Stats -->
<div class="row g-4 mb-4">
    <div class="col-md-2 col-sm-6">
        <div class="card stat-card">
            <div class="stat-label">Total Users</div>
            <div class="stat-value">2,500</div>
            <div class="stat-trend text-success"><i class="bi bi-arrow-up"></i> 12.5%</div>
        </div>
    </div>
    <div class="col-md-2 col-sm-6">
        <div class="card stat-card">
            <div class="stat-label">Average Time</div>
            <div class="stat-value">1.51 <span class="fs-6 fw-normal">Sec</span></div>
            <div class="stat-trend text-danger"><i class="bi bi-arrow-down"></i> 3.2%</div>
        </div>
    </div>
    <div class="col-md-2 col-sm-6">
        <div class="card stat-card">
            <div class="stat-label">Total Visits</div>
            <div class="stat-value text-success">2,500</div>
            <div class="stat-trend text-success"><i class="bi bi-arrow-up"></i> 8.4%</div>
        </div>
    </div>
    <div class="col-md-2 col-sm-6">
        <div class="card stat-card">
            <div class="stat-label">Total Views</div>
            <div class="stat-value">4,567</div>
            <div class="stat-trend text-success"><i class="bi bi-arrow-up"></i> 15%</div>
        </div>
    </div>
    <div class="col-md-2 col-sm-6">
        <div class="card stat-card">
            <div class="stat-label">Unique Visitors</div>
            <div class="stat-value">2,315</div>
            <div class="stat-trend text-success"><i class="bi bi-arrow-up"></i> 4.1%</div>
        </div>
    </div>
    <div class="col-md-2 col-sm-6">
        <div class="card stat-card">
            <div class="stat-label">Total Interactions</div>
            <div class="stat-value">7,325</div>
            <div class="stat-trend text-success"><i class="bi bi-arrow-up"></i> 22%</div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <!-- Main Chart Section -->
    <div class="col-lg-8">
        <div class="card p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h6 class="fw-bold mb-0">Revenue Overview</h6>
                <div class="btn-group">
                    <button class="btn btn-sm btn-light active">Monthly</button>
                    <button class="btn btn-sm btn-light">Weekly</button>
                </div>
            </div>
            <div style="height: 300px; background: linear-gradient(to bottom, #f8fafc, #fff); border-radius: 8px; position: relative; overflow: hidden;">
                <!-- Placeholder for Chart - in real app use Chart.js -->
                <svg width="100%" height="100%" viewBox="0 0 800 300" preserveAspectRatio="none">
                    <path d="M0,250 Q100,100 200,180 T400,120 T600,200 T800,50 L800,300 L0,300 Z" fill="rgba(59, 130, 246, 0.1)" stroke="#3b82f6" stroke-width="3"/>
                    <path d="M0,280 Q150,200 300,250 T600,150 T800,200 L800,300 L0,300 Z" fill="rgba(16, 185, 129, 0.1)" stroke="#10b981" stroke-width="3"/>
                </svg>
                <div class="position-absolute bottom-0 w-100 p-3 d-flex justify-content-between text-muted small">
                    <span>Jan</span><span>Feb</span><span>Mar</span><span>Apr</span><span>May</span><span>Jun</span><span>Jul</span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Sidebar Charts -->
    <div class="col-lg-4">
        <div class="card p-4 h-100">
            <h6 class="fw-bold mb-4">Distribution Progress</h6>
            <div class="mb-4">
                <div class="d-flex justify-content-between mb-2">
                    <span class="small fw-semibold">Marketing</span>
                    <span class="small text-muted">65%</span>
                </div>
                <div class="progress" style="height: 8px; border-radius: 10px;">
                    <div class="progress-bar bg-primary" style="width: 65%"></div>
                </div>
            </div>
            <div class="mb-4 text-center">
                <div style="width: 150px; height: 150px; margin: 0 auto; border: 15px solid #f1f5f9; border-top: 15px solid #0d6efd; border-radius: 50%; display: flex; align-items: center; justify-content: center; position: relative;">
                    <div class="text-center">
                        <span class="d-block fw-bold fs-4">85%</span>
                        <span class="small text-muted">Completed</span>
                    </div>
                </div>
            </div>
            <div class="list-group list-group-flush small">
                <div class="list-group-item px-0 d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-circle-fill text-primary me-2" style="font-size: 0.5rem;"></i> Direct Sales</span>
                    <span class="fw-bold">45%</span>
                </div>
                <div class="list-group-item px-0 d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-circle-fill text-success me-2" style="font-size: 0.5rem;"></i> Agency</span>
                    <span class="fw-bold">30%</span>
                </div>
                <div class="list-group-item px-0 d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-circle-fill text-warning me-2" style="font-size: 0.5rem;"></i> Digital</span>
                    <span class="fw-bold">25%</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

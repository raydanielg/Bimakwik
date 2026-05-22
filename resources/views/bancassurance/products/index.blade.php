@extends('layouts.dashboard')

@section('dashboard_title', 'Bancassurance Products')

@section('dashboard_content')
<!-- Header -->
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h5 class="fw-bold mb-1"><i class="bi bi-box-seam me-2"></i>Bancassurance Products</h5>
                <p class="text-muted small mb-0">Manage insurance products for bank customers</p>
            </div>
            <button class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg me-2"></i>Add Product
            </button>
        </div>
    </div>
</div>

<!-- Product Stats -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <small class="text-muted">Total Products</small>
                        <h5 class="fw-bold mb-0">12</h5>
                    </div>
                    <div class="bg-primary bg-opacity-10 rounded-circle p-2">
                        <i class="bi bi-box-seam text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <small class="text-muted">Active</small>
                        <h5 class="fw-bold mb-0">10</h5>
                    </div>
                    <div class="bg-success bg-opacity-10 rounded-circle p-2">
                        <i class="bi bi-check-circle text-success"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <small class="text-muted">Inactive</small>
                        <h5 class="fw-bold mb-0">2</h5>
                    </div>
                    <div class="bg-warning bg-opacity-10 rounded-circle p-2">
                        <i class="bi bi-pause-circle text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <small class="text-muted">Categories</small>
                        <h5 class="fw-bold mb-0">4</h5>
                    </div>
                    <div class="bg-info bg-opacity-10 rounded-circle p-2">
                        <i class="bi bi-list text-info"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Products Grid -->
<div class="row g-3">
    <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex align-items-start justify-content-between mb-3">
                    <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-car text-primary fs-4"></i>
                    </div>
                    <span class="badge bg-success">Active</span>
                </div>
                <h6 class="fw-bold mb-2">Motor Insurance</h6>
                <p class="text-muted small mb-3">Comprehensive motor insurance for bank customers</p>
                <div class="d-flex justify-content-between align-items-center">
                    <small class="text-muted">From TZS 150,000</small>
                    <button class="btn btn-sm btn-outline-primary">View Details</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex align-items-start justify-content-between mb-3">
                    <div class="bg-success bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-heart text-success fs-4"></i>
                    </div>
                    <span class="badge bg-success">Active</span>
                </div>
                <h6 class="fw-bold mb-2">Life Insurance</h6>
                <p class="text-muted small mb-3">Life protection and savings plans</p>
                <div class="d-flex justify-content-between align-items-center">
                    <small class="text-muted">From TZS 50,000</small>
                    <button class="btn btn-sm btn-outline-primary">View Details</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex align-items-start justify-content-between mb-3">
                    <div class="bg-info bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-hospital text-info fs-4"></i>
                    </div>
                    <span class="badge bg-success">Active</span>
                </div>
                <h6 class="fw-bold mb-2">Health Insurance</h6>
                <p class="text-muted small mb-3">Medical cover for individuals and families</p>
                <div class="d-flex justify-content-between align-items-center">
                    <small class="text-muted">From TZS 80,000</small>
                    <button class="btn btn-sm btn-outline-primary">View Details</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex align-items-start justify-content-between mb-3">
                    <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-house text-warning fs-4"></i>
                    </div>
                    <span class="badge bg-success">Active</span>
                </div>
                <h6 class="fw-bold mb-2">Home Insurance</h6>
                <p class="text-muted small mb-3">Property and home contents protection</p>
                <div class="d-flex justify-content-between align-items-center">
                    <small class="text-muted">From TZS 100,000</small>
                    <button class="btn btn-sm btn-outline-primary">View Details</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex align-items-start justify-content-between mb-3">
                    <div class="bg-danger bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-travel text-danger fs-4"></i>
                    </div>
                    <span class="badge bg-warning">Inactive</span>
                </div>
                <h6 class="fw-bold mb-2">Travel Insurance</h6>
                <p class="text-muted small mb-3">Travel protection for domestic and international trips</p>
                <div class="d-flex justify-content-between align-items-center">
                    <small class="text-muted">From TZS 25,000</small>
                    <button class="btn btn-sm btn-outline-primary">View Details</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex align-items-start justify-content-between mb-3">
                    <div class="bg-secondary bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-shield text-secondary fs-4"></i>
                    </div>
                    <span class="badge bg-warning">Inactive</span>
                </div>
                <h6 class="fw-bold mb-2">Business Insurance</h6>
                <p class="text-muted small mb-3">Commercial insurance for SMEs and businesses</p>
                <div class="d-flex justify-content-between align-items-center">
                    <small class="text-muted">From TZS 200,000</small>
                    <button class="btn btn-sm btn-outline-primary">View Details</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

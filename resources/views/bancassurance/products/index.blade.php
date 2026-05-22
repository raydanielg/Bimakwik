@extends('layouts.dashboard')

@section('dashboard_title', 'Bancassurance Products')

@push('styles')
<style>
    .modal-backdrop {
        background-color: rgba(0, 0, 0, 0.5);
    }
    .modal-content {
        border: none;
        border-radius: 12px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
    }
    .modal-header {
        border-bottom: 1px solid #e9ecef;
        padding: 1.5rem;
    }
    .modal-body {
        padding: 1.5rem;
    }
    .modal-footer {
        border-top: 1px solid #e9ecef;
        padding: 1.5rem;
    }
    .form-label {
        font-weight: 500;
        color: #495057;
        margin-bottom: 0.5rem;
    }
    .form-control, .form-select, .form-check-input {
        border: 1px solid #dee2e6;
        padding: 0.75rem;
        border-radius: 8px;
    }
    .form-control:focus, .form-select:focus, .form-check-input:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15);
    }
</style>
@endpush

@section('dashboard_content')
<!-- Header -->
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h5 class="fw-bold mb-1"><i class="bi bi-box-seam me-2"></i>Bancassurance Products</h5>
                <p class="text-muted small mb-0">Manage insurance products for bank customers</p>
            </div>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addProductModal">
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
                    <div class="btn-group btn-group-sm">
                        <button class="btn btn-outline-primary view-product-btn" data-id="1" data-name="Motor Insurance" title="View">
                            <i class="bi bi-eye"></i>
                        </button>
                        <button class="btn btn-outline-secondary edit-product-btn" data-id="1" data-name="Motor Insurance" title="Edit">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn btn-outline-danger delete-product-btn" data-id="1" data-name="Motor Insurance" title="Delete">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
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
                    <div class="btn-group btn-group-sm">
                        <button class="btn btn-outline-primary view-product-btn" data-id="2" data-name="Life Insurance" title="View">
                            <i class="bi bi-eye"></i>
                        </button>
                        <button class="btn btn-outline-secondary edit-product-btn" data-id="2" data-name="Life Insurance" title="Edit">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn btn-outline-danger delete-product-btn" data-id="2" data-name="Life Insurance" title="Delete">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
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
                    <div class="btn-group btn-group-sm">
                        <button class="btn btn-outline-primary view-product-btn" data-id="3" data-name="Health Insurance" title="View">
                            <i class="bi bi-eye"></i>
                        </button>
                        <button class="btn btn-outline-secondary edit-product-btn" data-id="3" data-name="Health Insurance" title="Edit">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn btn-outline-danger delete-product-btn" data-id="3" data-name="Health Insurance" title="Delete">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
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
                    <div class="btn-group btn-group-sm">
                        <button class="btn btn-outline-primary view-product-btn" data-id="4" data-name="Home Insurance" title="View">
                            <i class="bi bi-eye"></i>
                        </button>
                        <button class="btn btn-outline-secondary edit-product-btn" data-id="4" data-name="Home Insurance" title="Edit">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn btn-outline-danger delete-product-btn" data-id="4" data-name="Home Insurance" title="Delete">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
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
                    <div class="btn-group btn-group-sm">
                        <button class="btn btn-outline-primary view-product-btn" data-id="5" data-name="Travel Insurance" title="View">
                            <i class="bi bi-eye"></i>
                        </button>
                        <button class="btn btn-outline-secondary edit-product-btn" data-id="5" data-name="Travel Insurance" title="Edit">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn btn-outline-danger delete-product-btn" data-id="5" data-name="Travel Insurance" title="Delete">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
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
                    <div class="btn-group btn-group-sm">
                        <button class="btn btn-outline-primary view-product-btn" data-id="6" data-name="Business Insurance" title="View">
                            <i class="bi bi-eye"></i>
                        </button>
                        <button class="btn btn-outline-secondary edit-product-btn" data-id="6" data-name="Business Insurance" title="Edit">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn btn-outline-danger delete-product-btn" data-id="6" data-name="Business Insurance" title="Delete">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

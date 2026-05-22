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

<!-- Add Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="addProductModalLabel">
                    <i class="bi bi-plus-lg me-2"></i>Add New Product
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addProductForm">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="productName" class="form-label">Product Name *</label>
                            <input type="text" class="form-control" id="productName" required placeholder="Enter product name">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="productCategory" class="form-label">Category *</label>
                            <select class="form-select" id="productCategory" required>
                                <option value="">Select Category</option>
                                <option value="Motor">Motor</option>
                                <option value="Life">Life</option>
                                <option value="Health">Health</option>
                                <option value="Home">Home</option>
                                <option value="Travel">Travel</option>
                                <option value="Business">Business</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="minPremium" class="form-label">Minimum Premium (TZS) *</label>
                            <input type="number" class="form-control" id="minPremium" required placeholder="Enter minimum premium" min="0">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="commissionRate" class="form-label">Commission Rate (%) *</label>
                            <input type="number" class="form-control" id="commissionRate" required placeholder="Enter commission rate" min="0" max="100">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="productDescription" class="form-label">Description *</label>
                        <textarea class="form-control" id="productDescription" rows="4" required placeholder="Enter product description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status *</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="productStatus" id="statusActive" value="active" checked>
                                <label class="form-check-label" for="statusActive">Active</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="productStatus" id="statusInactive" value="inactive">
                                <label class="form-check-label" for="statusInactive">Inactive</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="addProduct()">
                    <i class="bi bi-save me-2"></i>Add Product
                </button>
            </div>
        </div>
    </div>
</div>

<!-- View Product Modal -->
<div class="modal fade" id="viewProductModal" tabindex="-1" aria-labelledby="viewProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="viewProductModalLabel">
                    <i class="bi bi-box-seam me-2"></i>Product Details
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="productDetails">
                    <!-- Product details will be loaded here -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="editProduct()">
                    <i class="bi bi-pencil me-2"></i>Edit Product
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Product Modal -->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="editProductModalLabel">
                    <i class="bi bi-pencil me-2"></i>Edit Product
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editProductForm">
                    <input type="hidden" id="editProductId">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="editProductName" class="form-label">Product Name *</label>
                            <input type="text" class="form-control" id="editProductName" required placeholder="Enter product name">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="editProductCategory" class="form-label">Category *</label>
                            <select class="form-select" id="editProductCategory" required>
                                <option value="">Select Category</option>
                                <option value="Motor">Motor</option>
                                <option value="Life">Life</option>
                                <option value="Health">Health</option>
                                <option value="Home">Home</option>
                                <option value="Travel">Travel</option>
                                <option value="Business">Business</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="editMinPremium" class="form-label">Minimum Premium (TZS) *</label>
                            <input type="number" class="form-control" id="editMinPremium" required placeholder="Enter minimum premium" min="0">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="editCommissionRate" class="form-label">Commission Rate (%) *</label>
                            <input type="number" class="form-control" id="editCommissionRate" required placeholder="Enter commission rate" min="0" max="100">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="editProductDescription" class="form-label">Description *</label>
                        <textarea class="form-control" id="editProductDescription" rows="4" required placeholder="Enter product description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status *</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="editProductStatus" id="editStatusActive" value="active">
                                <label class="form-check-label" for="editStatusActive">Active</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="editProductStatus" id="editStatusInactive" value="inactive">
                                <label class="form-check-label" for="editStatusInactive">Inactive</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="updateProduct()">
                    <i class="bi bi-save me-2"></i>Update Product
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function addProduct() {
    const name = document.getElementById('productName').value;
    const category = document.getElementById('productCategory').value;
    const minPremium = document.getElementById('minPremium').value;
    const commissionRate = document.getElementById('commissionRate').value;
    const description = document.getElementById('productDescription').value;
    const status = document.querySelector('input[name="productStatus"]:checked').value;

    // Validation
    if (!name || !category || !minPremium || !commissionRate || !description) {
        Swal.fire({
            icon: 'error',
            title: 'Validation Error',
            text: 'Please fill in all required fields',
            confirmButtonColor: '#dc3545'
        });
        return;
    }

    // Show loading
    Swal.fire({
        title: 'Adding Product...',
        text: 'Please wait while we add the product',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    // AJAX call
    const formData = new FormData();
    formData.append('name', name);
    formData.append('category', category);
    formData.append('min_premium', minPremium);
    formData.append('commission_rate', commissionRate);
    formData.append('description', description);
    formData.append('status', status);

    fetch('/bancassurance/products', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const modal = bootstrap.Modal.getInstance(document.getElementById('addProductModal'));
            modal.hide();

            // Reset form
            document.getElementById('addProductForm').reset();

            Swal.fire({
                icon: 'success',
                title: 'Product Added Successfully!',
                html: `
                    <p><strong>Product:</strong> ${data.data.name}</p>
                    <p><strong>Category:</strong> ${data.data.category}</p>
                    <p><strong>Min Premium:</strong> TZS ${parseInt(data.data.min_premium).toLocaleString()}</p>
                    <p><strong>Commission:</strong> ${data.data.commission_rate}%</p>
                `,
                confirmButtonColor: '#0d6efd'
            }).then(() => {
                // Reload page to show new product
                location.reload();
            });
        } else {
            let errorMessage = data.message;
            if (data.errors) {
                const errorList = Object.values(data.errors).flat().join('<br>');
                errorMessage = data.message + '<br><br>' + errorList;
            }
            
            Swal.fire({
                icon: 'error',
                title: 'Error',
                html: errorMessage,
                confirmButtonColor: '#dc3545'
            });
        }
    })
    .catch(error => {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'An error occurred while adding product',
            confirmButtonColor: '#dc3545'
        });
        console.error('Error:', error);
    });
}

function viewProduct(productId, productName) {
    Swal.fire({
        title: 'Loading...',
        text: 'Fetching product details',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    fetch(`/bancassurance/products/${productId}`, {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const product = data.data;
            const statusBadge = product.status === 'active' 
                ? '<span class="badge bg-success d-inline-flex align-items-center"><i class="bi bi-check-circle-fill me-1"></i>Active</span>'
                : '<span class="badge bg-warning d-inline-flex align-items-center"><i class="bi bi-clock-fill me-1"></i>Inactive</span>';

            const featuresHtml = product.features ? product.features.map(f => `<li>${f}</li>`).join('') : '';

            document.getElementById('productDetails').innerHTML = `
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="text-muted small">Product Name</label>
                        <div class="fw-semibold">${product.name}</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted small">Status</label>
                        <div>${statusBadge}</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted small">Category</label>
                        <div>${product.category}</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted small">Minimum Premium</label>
                        <div>TZS ${parseInt(product.min_premium).toLocaleString()}</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted small">Commission Rate</label>
                        <div class="fw-bold text-success">${product.commission_rate}%</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted small">Created At</label>
                        <div>${product.created_at}</div>
                    </div>
                    <div class="col-12 mb-3">
                        <label class="text-muted small">Description</label>
                        <div>${product.description}</div>
                    </div>
                    ${featuresHtml ? `
                    <div class="col-12 mb-3">
                        <label class="text-muted small">Features</label>
                        <ul>${featuresHtml}</ul>
                    </div>
                    ` : ''}
                </div>
            `;

            Swal.close();
            const modal = new bootstrap.Modal(document.getElementById('viewProductModal'));
            modal.show();
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: data.message,
                confirmButtonColor: '#dc3545'
            });
        }
    })
    .catch(error => {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'An error occurred while fetching product details',
            confirmButtonColor: '#dc3545'
        });
        console.error('Error:', error);
    });
}

function editProduct() {
    Swal.fire({
        icon: 'info',
        title: 'Edit from View',
        text: 'Please use the edit button in the product card to edit this product',
        confirmButtonColor: '#0d6efd'
    });
}

function openEditProductModal(productId, productName) {
    Swal.fire({
        title: 'Loading...',
        text: 'Fetching product details for editing',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    fetch(`/bancassurance/products/${productId}`, {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const product = data.data;
            
            // Populate edit form
            document.getElementById('editProductId').value = product.id;
            document.getElementById('editProductName').value = product.name;
            document.getElementById('editProductCategory').value = product.category;
            document.getElementById('editMinPremium').value = product.min_premium;
            document.getElementById('editCommissionRate').value = product.commission_rate;
            document.getElementById('editProductDescription').value = product.description;
            
            // Set status radio
            if (product.status === 'active') {
                document.getElementById('editStatusActive').checked = true;
            } else {
                document.getElementById('editStatusInactive').checked = true;
            }

            Swal.close();
            
            // Close view modal if open
            const viewModal = bootstrap.Modal.getInstance(document.getElementById('viewProductModal'));
            if (viewModal) {
                viewModal.hide();
            }

            // Open edit modal
            const editModal = new bootstrap.Modal(document.getElementById('editProductModal'));
            editModal.show();
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: data.message,
                confirmButtonColor: '#dc3545'
            });
        }
    })
    .catch(error => {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'An error occurred while fetching product details',
            confirmButtonColor: '#dc3545'
        });
        console.error('Error:', error);
    });
}

function updateProduct() {
    const productId = document.getElementById('editProductId').value;
    const name = document.getElementById('editProductName').value;
    const category = document.getElementById('editProductCategory').value;
    const minPremium = document.getElementById('editMinPremium').value;
    const commissionRate = document.getElementById('editCommissionRate').value;
    const description = document.getElementById('editProductDescription').value;
    const status = document.querySelector('input[name="editProductStatus"]:checked').value;

    // Validation
    if (!name || !category || !minPremium || !commissionRate || !description) {
        Swal.fire({
            icon: 'error',
            title: 'Validation Error',
            text: 'Please fill in all required fields',
            confirmButtonColor: '#dc3545'
        });
        return;
    }

    // Show loading
    Swal.fire({
        title: 'Updating Product...',
        text: 'Please wait while we update the product',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    // AJAX call
    const formData = new FormData();
    formData.append('name', name);
    formData.append('category', category);
    formData.append('min_premium', minPremium);
    formData.append('commission_rate', commissionRate);
    formData.append('description', description);
    formData.append('status', status);

    fetch(`/bancassurance/products/${productId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const modal = bootstrap.Modal.getInstance(document.getElementById('editProductModal'));
            modal.hide();

            // Reset form
            document.getElementById('editProductForm').reset();

            Swal.fire({
                icon: 'success',
                title: 'Product Updated Successfully!',
                html: `
                    <p><strong>Product:</strong> ${data.data.name}</p>
                    <p><strong>Category:</strong> ${data.data.category}</p>
                    <p><strong>Min Premium:</strong> TZS ${parseInt(data.data.min_premium).toLocaleString()}</p>
                    <p><strong>Commission:</strong> ${data.data.commission_rate}%</p>
                `,
                confirmButtonColor: '#0d6efd'
            }).then(() => {
                // Reload page to show updated data
                location.reload();
            });
        } else {
            let errorMessage = data.message;
            if (data.errors) {
                const errorList = Object.values(data.errors).flat().join('<br>');
                errorMessage = data.message + '<br><br>' + errorList;
            }
            
            Swal.fire({
                icon: 'error',
                title: 'Error',
                html: errorMessage,
                confirmButtonColor: '#dc3545'
            });
        }
    })
    .catch(error => {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'An error occurred while updating product',
            confirmButtonColor: '#dc3545'
        });
        console.error('Error:', error);
    });
}

function deleteProduct(productId, productName) {
    Swal.fire({
        title: 'Delete Product',
        text: `Are you sure you want to delete "${productName}"?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: 'Deleting...',
                text: 'Please wait while we delete the product',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            fetch(`/bancassurance/products/${productId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted!',
                        text: 'Product has been deleted successfully',
                        confirmButtonColor: '#0d6efd'
                    }).then(() => {
                        // Reload page to show updated data
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message,
                        confirmButtonColor: '#dc3545'
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred while deleting product',
                    confirmButtonColor: '#dc3545'
                });
                console.error('Error:', error);
            });
        }
    });
}

// Attach all button listeners
function attachProductListeners() {
    document.querySelectorAll('.view-product-btn').forEach(btn => {
        btn.removeEventListener('click', handleViewProductClick);
        btn.addEventListener('click', handleViewProductClick);
    });
    
    document.querySelectorAll('.edit-product-btn').forEach(btn => {
        btn.removeEventListener('click', handleEditProductClick);
        btn.addEventListener('click', handleEditProductClick);
    });
    
    document.querySelectorAll('.delete-product-btn').forEach(btn => {
        btn.removeEventListener('click', handleDeleteProductClick);
        btn.addEventListener('click', handleDeleteProductClick);
    });
}

function handleViewProductClick(e) {
    const btn = e.target.closest('.view-product-btn');
    const productId = btn.getAttribute('data-id');
    const productName = btn.getAttribute('data-name');
    viewProduct(productId, productName);
}

function handleEditProductClick(e) {
    const btn = e.target.closest('.edit-product-btn');
    const productId = btn.getAttribute('data-id');
    const productName = btn.getAttribute('data-name');
    openEditProductModal(productId, productName);
}

function handleDeleteProductClick(e) {
    const btn = e.target.closest('.delete-product-btn');
    const productId = btn.getAttribute('data-id');
    const productName = btn.getAttribute('data-name');
    deleteProduct(productId, productName);
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    attachProductListeners();
});
</script>
@endpush
@endsection

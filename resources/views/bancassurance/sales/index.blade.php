@extends('layouts.dashboard')

@section('dashboard_title', 'Insurance Sales')

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
    .form-control, .form-select {
        border: 1px solid #dee2e6;
        padding: 0.75rem;
        border-radius: 8px;
    }
    .form-control:focus, .form-select:focus {
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
                <h5 class="fw-bold mb-1"><i class="bi bi-cart me-2"></i>Insurance Sales</h5>
                <p class="text-muted small mb-0">Track all insurance sales across branches</p>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-outline-primary btn-sm" onclick="exportSales()">
                    <i class="bi bi-file-earmark-pdf me-2"></i>Export PDF
                </button>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addSaleModal">
                    <i class="bi bi-plus-lg me-2"></i>New Sale
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Sales Stats -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <small class="text-muted">Total Sales</small>
                        <h5 class="fw-bold mb-0">TZS 45.8M</h5>
                    </div>
                    <div class="bg-primary bg-opacity-10 rounded-circle p-2">
                        <i class="bi bi-cash-stack text-primary"></i>
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
                        <small class="text-muted">Policies Sold</small>
                        <h5 class="fw-bold mb-0">156</h5>
                    </div>
                    <div class="bg-success bg-opacity-10 rounded-circle p-2">
                        <i class="bi bi-file-earmark-text text-success"></i>
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
                        <small class="text-muted">This Month</small>
                        <h5 class="fw-bold mb-0">TZS 12.3M</h5>
                    </div>
                    <div class="bg-info bg-opacity-10 rounded-circle p-2">
                        <i class="bi bi-calendar text-info"></i>
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
                        <small class="text-muted">Target</small>
                        <h5 class="fw-bold mb-0">92%</h5>
                    </div>
                    <div class="bg-warning bg-opacity-10 rounded-circle p-2">
                        <i class="bi bi-graph-up text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Sales Table -->
<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="fw-bold mb-0">Recent Sales</h6>
            <div class="input-group" style="width: 250px;">
                <span class="input-group-text bg-light border-0">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text" class="form-control border-0 bg-light" placeholder="Search sales...">
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Policy No</th>
                        <th>Customer</th>
                        <th>Product</th>
                        <th>Premium</th>
                        <th>Branch</th>
                        <th>Sold By</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><span class="fw-semibold text-primary">POL-2024-001234</span></td>
                        <td>Hamis Juma</td>
                        <td>Motor Insurance</td>
                        <td>TZS 450,000</td>
                        <td>Branch A</td>
                        <td>John Doe</td>
                        <td>Today</td>
                        <td>
                            <span class="badge bg-success d-inline-flex align-items-center">
                                <i class="bi bi-check-circle-fill me-1"></i>Active
                            </span>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-primary view-sale-btn" data-id="1" data-policy="POL-2024-001234" title="View">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-outline-secondary edit-sale-btn" data-id="1" data-policy="POL-2024-001234" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="fw-semibold text-primary">POL-2024-001235</span></td>
                        <td>Sarah Peter</td>
                        <td>Life Insurance</td>
                        <td>TZS 280,000</td>
                        <td>Branch B</td>
                        <td>Jane Smith</td>
                        <td>Yesterday</td>
                        <td>
                            <span class="badge bg-success d-inline-flex align-items-center">
                                <i class="bi bi-check-circle-fill me-1"></i>Active
                            </span>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-primary view-sale-btn" data-id="2" data-policy="POL-2024-001235" title="View">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-outline-secondary edit-sale-btn" data-id="2" data-policy="POL-2024-001235" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="fw-semibold text-primary">POL-2024-001236</span></td>
                        <td>David Omondi</td>
                        <td>Health Insurance</td>
                        <td>TZS 120,000</td>
                        <td>Branch A</td>
                        <td>John Doe</td>
                        <td>2 days ago</td>
                        <td>
                            <span class="badge bg-warning d-inline-flex align-items-center">
                                <i class="bi bi-clock-fill me-1"></i>Pending
                            </span>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-primary view-sale-btn" data-id="3" data-policy="POL-2024-001236" title="View">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-outline-secondary edit-sale-btn" data-id="3" data-policy="POL-2024-001236" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Sale Modal -->
<div class="modal fade" id="addSaleModal" tabindex="-1" aria-labelledby="addSaleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="addSaleModalLabel">
                    <i class="bi bi-cart-plus me-2"></i>New Insurance Sale
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addSaleForm">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="customerName" class="form-label">Customer Name *</label>
                            <input type="text" class="form-control" id="customerName" required placeholder="Enter customer name">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="customerEmail" class="form-label">Customer Email *</label>
                            <input type="email" class="form-control" id="customerEmail" required placeholder="Enter email">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="customerPhone" class="form-label">Customer Phone *</label>
                            <input type="text" class="form-control" id="customerPhone" required placeholder="Enter phone number">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="product" class="form-label">Insurance Product *</label>
                            <select class="form-select" id="product" required>
                                <option value="">Select Product</option>
                                @foreach($products as $p)
                                <option value="{{ $p->id }}">{{ $p->product_name }} (TZS {{ number_format($p->base_premium, 0) }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="premium" class="form-label">Premium Amount (TZS) *</label>
                            <input type="number" class="form-control" id="premium" required placeholder="Enter premium amount" min="0">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="branch" class="form-label">Branch *</label>
                            <select class="form-select" id="branch" required>
                                <option value="">Select Branch</option>
                                <option value="Branch A">Branch A</option>
                                <option value="Branch B">Branch B</option>
                                <option value="Branch C">Branch C</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="soldBy" class="form-label">Sold By *</label>
                            <input type="text" class="form-control" id="soldBy" required placeholder="Agent name">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="policyStartDate" class="form-label">Policy Start Date *</label>
                            <input type="date" class="form-control" id="policyStartDate" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="policyEndDate" class="form-label">Policy End Date *</label>
                            <input type="date" class="form-control" id="policyEndDate" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="companyCode" class="form-label">Company Code</label>
                            <input type="text" class="form-control" id="companyCode" placeholder="e.g. ICC113">
                            <div class="form-text">TIRA insurer company code</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="salePointCode" class="form-label">Sale Point Code</label>
                            <input type="text" class="form-control" id="salePointCode" placeholder="e.g. SP677">
                            <div class="form-text">TIRA sale point identifier</div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="addSale()">
                    <i class="bi bi-save me-2"></i>Record Sale
                </button>
            </div>
        </div>
    </div>
</div>

<!-- View Sale Modal -->
<div class="modal fade" id="viewSaleModal" tabindex="-1" aria-labelledby="viewSaleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="viewSaleModalLabel">
                    <i class="bi bi-cart me-2"></i>Sale Details
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="saleDetails">
                    <!-- Sale details will be loaded here -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="editSale()">
                    <i class="bi bi-pencil me-2"></i>Edit Sale
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Sale Modal -->
<div class="modal fade" id="editSaleModal" tabindex="-1" aria-labelledby="editSaleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="editSaleModalLabel">
                    <i class="bi bi-pencil me-2"></i>Edit Insurance Sale
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editSaleForm">
                    <input type="hidden" id="editSaleId">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="editCustomerName" class="form-label">Customer Name *</label>
                            <input type="text" class="form-control" id="editCustomerName" required placeholder="Enter customer name">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="editCustomerEmail" class="form-label">Customer Email *</label>
                            <input type="email" class="form-control" id="editCustomerEmail" required placeholder="Enter email">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="editCustomerPhone" class="form-label">Customer Phone *</label>
                            <input type="text" class="form-control" id="editCustomerPhone" required placeholder="Enter phone number">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="editProduct" class="form-label">Insurance Product *</label>
                            <select class="form-select" id="editProduct" required>
                                <option value="">Select Product</option>
                                @foreach($products as $p)
                                <option value="{{ $p->id }}">{{ $p->product_name }} (TZS {{ number_format($p->base_premium, 0) }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="editPremium" class="form-label">Premium Amount (TZS) *</label>
                            <input type="number" class="form-control" id="editPremium" required placeholder="Enter premium amount" min="0">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="editBranch" class="form-label">Branch *</label>
                            <select class="form-select" id="editBranch" required>
                                <option value="">Select Branch</option>
                                <option value="Branch A">Branch A</option>
                                <option value="Branch B">Branch B</option>
                                <option value="Branch C">Branch C</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="editSoldBy" class="form-label">Sold By *</label>
                            <input type="text" class="form-control" id="editSoldBy" required placeholder="Agent name">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="editPolicyStartDate" class="form-label">Policy Start Date *</label>
                            <input type="date" class="form-control" id="editPolicyStartDate" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="editPolicyEndDate" class="form-label">Policy End Date *</label>
                            <input type="date" class="form-control" id="editPolicyEndDate" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="editCompanyCode" class="form-label">Company Code</label>
                            <input type="text" class="form-control" id="editCompanyCode" placeholder="e.g. ICC113">
                            <div class="form-text">TIRA insurer company code</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="editSalePointCode" class="form-label">Sale Point Code</label>
                            <input type="text" class="form-control" id="editSalePointCode" placeholder="e.g. SP677">
                            <div class="form-text">TIRA sale point identifier</div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="updateSale()">
                    <i class="bi bi-save me-2"></i>Update Sale
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function addSale() {
    const customerName = document.getElementById('customerName').value;
    const customerEmail = document.getElementById('customerEmail').value;
    const customerPhone = document.getElementById('customerPhone').value;
    const product = document.getElementById('product').value;
    const premium = document.getElementById('premium').value;
    const branch = document.getElementById('branch').value;
    const soldBy = document.getElementById('soldBy').value;
    const policyStartDate = document.getElementById('policyStartDate').value;
    const policyEndDate = document.getElementById('policyEndDate').value;

    // Validation
    if (!customerName || !customerEmail || !customerPhone || !product || !premium || !branch || !soldBy || !policyStartDate || !policyEndDate) {
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
        title: 'Recording Sale...',
        text: 'Please wait while we record the sale',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    const companyCode = document.getElementById('companyCode').value;
    const salePointCode = document.getElementById('salePointCode').value;

    const formData = new FormData();
    formData.append('customer_name', customerName);
    formData.append('customer_email', customerEmail);
    formData.append('customer_phone', customerPhone);
    formData.append('product_id', product);
    formData.append('premium', premium);
    formData.append('branch', branch);
    formData.append('sold_by', soldBy);
    formData.append('policy_start_date', policyStartDate);
    formData.append('policy_end_date', policyEndDate);
    formData.append('company_code', companyCode);
    formData.append('sale_point_code', salePointCode);

    fetch('/bancassurance/sales', {
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
            const modal = bootstrap.Modal.getInstance(document.getElementById('addSaleModal'));
            modal.hide();

            // Reset form
            document.getElementById('addSaleForm').reset();

            // Add new row to table
            const tableBody = document.querySelector('tbody');
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td><span class="fw-semibold text-primary">${data.data.policy_number}</span></td>
                <td>${data.data.customer_name}</td>
                <td>${data.data.product}</td>
                <td>TZS ${parseInt(data.data.premium).toLocaleString()}</td>
                <td>${data.data.branch}</td>
                <td>${data.data.sold_by}</td>
                <td>Just now</td>
                <td>
                    <span class="badge bg-warning d-inline-flex align-items-center">
                        <i class="bi bi-clock-fill me-1"></i>Pending
                    </span>
                </td>
                <td>
                    <div class="btn-group btn-group-sm">
                        <button class="btn btn-outline-primary view-sale-btn" data-id="${data.data.id}" data-policy="${data.data.policy_number}" title="View">
                            <i class="bi bi-eye"></i>
                        </button>
                        <button class="btn btn-outline-secondary edit-sale-btn" data-id="${data.data.id}" data-policy="${data.data.policy_number}" title="Edit">
                            <i class="bi bi-pencil"></i>
                        </button>
                    </div>
                </td>
            `;
            tableBody.insertBefore(newRow, tableBody.firstChild);

            // Re-attach listeners
            attachViewSaleListeners();
            attachEditSaleListeners();

            Swal.fire({
                icon: 'success',
                title: 'Sale Recorded Successfully!',
                html: `
                    <p><strong>Policy No:</strong> ${data.data.policy_number}</p>
                    <p><strong>Customer:</strong> ${data.data.customer_name}</p>
                    <p><strong>Premium:</strong> TZS ${parseInt(data.data.premium).toLocaleString()}</p>
                    <p><strong>Status:</strong> <span class="badge bg-warning">Pending</span></p>
                `,
                confirmButtonColor: '#0d6efd'
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
            text: 'An error occurred while recording sale',
            confirmButtonColor: '#dc3545'
        });
        console.error('Error:', error);
    });
}

function viewSale(saleId, policyNumber) {
    Swal.fire({
        title: 'Loading...',
        text: 'Fetching sale details',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    fetch(`/bancassurance/sales/${saleId}`, {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const sale = data.data;
            const statusBadge = sale.status === 'Active' 
                ? '<span class="badge bg-success d-inline-flex align-items-center"><i class="bi bi-check-circle-fill me-1"></i>Active</span>'
                : '<span class="badge bg-warning d-inline-flex align-items-center"><i class="bi bi-clock-fill me-1"></i>Pending</span>';

            document.getElementById('saleDetails').innerHTML = `
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="text-muted small">Policy Number</label>
                        <div class="fw-semibold text-primary">${sale.policy_number}</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted small">Status</label>
                        <div>${statusBadge}</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted small">Customer Name</label>
                        <div>${sale.customer_name}</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted small">Customer Email</label>
                        <div>${sale.customer_email}</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted small">Customer Phone</label>
                        <div>${sale.customer_phone}</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted small">Product</label>
                        <div>${sale.product}</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted small">Premium</label>
                        <div>TZS ${parseInt(sale.premium).toLocaleString()}</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted small">Branch</label>
                        <div>${sale.branch}</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted small">Sold By</label>
                        <div>${sale.sold_by}</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted small">Policy Start Date</label>
                        <div>${sale.policy_start_date}</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted small">Policy End Date</label>
                        <div>${sale.policy_end_date}</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted small">Created At</label>
                        <div>${sale.created_at}</div>
                    </div>
                    <div class="col-12 mb-3">
                        <label class="text-muted small">Notes</label>
                        <div>${sale.notes || 'No notes'}</div>
                    </div>
                </div>
            `;

            Swal.close();
            const modal = new bootstrap.Modal(document.getElementById('viewSaleModal'));
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
            text: 'An error occurred while fetching sale details',
            confirmButtonColor: '#dc3545'
        });
        console.error('Error:', error);
    });
}

function exportSales() {
    Swal.fire({
        icon: 'info',
        title: 'Export to PDF',
        text: 'Export functionality coming soon',
        confirmButtonColor: '#0d6efd'
    });
}

function editSale() {
    // This function is called from View Sale modal
    // For now, show a message
    Swal.fire({
        icon: 'info',
        title: 'Edit from View',
        text: 'Please use the edit button in the table to edit this sale',
        confirmButtonColor: '#0d6efd'
    });
}

function openEditSaleModal(saleId, policyNumber) {
    Swal.fire({
        title: 'Loading...',
        text: 'Fetching sale details for editing',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    fetch(`/bancassurance/sales/${saleId}`, {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const sale = data.data;
            
            // Populate edit form
            document.getElementById('editSaleId').value = sale.id;
            document.getElementById('editCustomerName').value = sale.customer_name;
            document.getElementById('editCustomerEmail').value = sale.customer_email;
            document.getElementById('editCustomerPhone').value = sale.customer_phone;
            document.getElementById('editProduct').value = sale.product;
            document.getElementById('editPremium').value = sale.premium;
            document.getElementById('editBranch').value = sale.branch;
            document.getElementById('editSoldBy').value = sale.sold_by;
            document.getElementById('editPolicyStartDate').value = sale.policy_start_date;
            document.getElementById('editPolicyEndDate').value = sale.policy_end_date;

            Swal.close();
            
            // Close view modal if open
            const viewModal = bootstrap.Modal.getInstance(document.getElementById('viewSaleModal'));
            if (viewModal) {
                viewModal.hide();
            }

            // Open edit modal
            const editModal = new bootstrap.Modal(document.getElementById('editSaleModal'));
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
            text: 'An error occurred while fetching sale details',
            confirmButtonColor: '#dc3545'
        });
        console.error('Error:', error);
    });
}

function updateSale() {
    const saleId = document.getElementById('editSaleId').value;
    const customerName = document.getElementById('editCustomerName').value;
    const customerEmail = document.getElementById('editCustomerEmail').value;
    const customerPhone = document.getElementById('editCustomerPhone').value;
    const product = document.getElementById('editProduct').value;
    const premium = document.getElementById('editPremium').value;
    const branch = document.getElementById('editBranch').value;
    const soldBy = document.getElementById('editSoldBy').value;
    const policyStartDate = document.getElementById('editPolicyStartDate').value;
    const policyEndDate = document.getElementById('editPolicyEndDate').value;

    // Validation
    if (!customerName || !customerEmail || !customerPhone || !product || !premium || !branch || !soldBy || !policyStartDate || !policyEndDate) {
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
        title: 'Updating Sale...',
        text: 'Please wait while we update the sale',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    // AJAX call
    const formData = new FormData();
    formData.append('customer_name', customerName);
    formData.append('customer_email', customerEmail);
    formData.append('customer_phone', customerPhone);
    formData.append('product', product);
    formData.append('premium', premium);
    formData.append('branch', branch);
    formData.append('sold_by', soldBy);
    formData.append('policy_start_date', policyStartDate);
    formData.append('policy_end_date', policyEndDate);

    fetch(`/bancassurance/sales/${saleId}`, {
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
            const modal = bootstrap.Modal.getInstance(document.getElementById('editSaleModal'));
            modal.hide();

            // Reset form
            document.getElementById('editSaleForm').reset();

            // Update table row (simplified - in real app, update specific row)
            Swal.fire({
                icon: 'success',
                title: 'Sale Updated Successfully!',
                html: `
                    <p><strong>Customer:</strong> ${data.data.customer_name}</p>
                    <p><strong>Product:</strong> ${data.data.product}</p>
                    <p><strong>Premium:</strong> TZS ${parseInt(data.data.premium).toLocaleString()}</p>
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
            text: 'An error occurred while updating sale',
            confirmButtonColor: '#dc3545'
        });
        console.error('Error:', error);
    });
}

// Attach view button listeners
function attachViewSaleListeners() {
    document.querySelectorAll('.view-sale-btn').forEach(btn => {
        btn.removeEventListener('click', handleViewSaleClick);
        btn.addEventListener('click', handleViewSaleClick);
    });
}

function handleViewSaleClick(e) {
    const btn = e.target.closest('.view-sale-btn');
    const saleId = btn.getAttribute('data-id');
    const policyNumber = btn.getAttribute('data-policy');
    viewSale(saleId, policyNumber);
}

// Attach edit button listeners
function attachEditSaleListeners() {
    document.querySelectorAll('.edit-sale-btn').forEach(btn => {
        btn.removeEventListener('click', handleEditSaleClick);
        btn.addEventListener('click', handleEditSaleClick);
    });
}

function handleEditSaleClick(e) {
    const btn = e.target.closest('.edit-sale-btn');
    const saleId = btn.getAttribute('data-id');
    const policyNumber = btn.getAttribute('data-policy');
    openEditSaleModal(saleId, policyNumber);
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    attachViewSaleListeners();
    attachEditSaleListeners();
});
</script>
@endpush
@endsection

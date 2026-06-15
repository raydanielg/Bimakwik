@extends('layouts.dashboard')

@section('dashboard_title', 'My Sales')

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
                <h5 class="fw-bold mb-1"><i class="bi bi-person-lines-fill me-2"></i>My Sales</h5>
                <p class="text-muted small mb-0">Track your personal sales performance</p>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-outline-primary btn-sm" onclick="exportMySales()">
                    <i class="bi bi-file-earmark-pdf me-2"></i>Export Report
                </button>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addMySaleModal">
                    <i class="bi bi-plus-lg me-2"></i>New Sale
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Personal Stats -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <small class="text-muted">My Sales</small>
                        <h5 class="fw-bold mb-0">TZS 8.5M</h5>
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
                        <small class="text-muted">My Commission</small>
                        <h5 class="fw-bold mb-0">TZS 850K</h5>
                    </div>
                    <div class="bg-success bg-opacity-10 rounded-circle p-2">
                        <i class="bi bi-wallet text-success"></i>
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
                        <h5 class="fw-bold mb-0">28</h5>
                    </div>
                    <div class="bg-info bg-opacity-10 rounded-circle p-2">
                        <i class="bi bi-file-earmark-text text-info"></i>
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
                        <small class="text-muted">Rank</small>
                        <h5 class="fw-bold mb-0">#3</h5>
                    </div>
                    <div class="bg-warning bg-opacity-10 rounded-circle p-2">
                        <i class="bi bi-trophy text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- My Sales Table -->
<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="fw-bold mb-0">My Sales History</h6>
            <div class="input-group" style="width: 250px;">
                <span class="input-group-text bg-light border-0">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text" class="form-control border-0 bg-light" placeholder="Search my sales...">
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
                        <th>Commission</th>
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
                        <td>TZS 45,000</td>
                        <td>Today</td>
                        <td>
                            <span class="badge bg-success d-inline-flex align-items-center">
                                <i class="bi bi-check-circle-fill me-1"></i>Active
                            </span>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-primary view-my-sale-btn" data-id="1" data-policy="POL-2024-001234" title="View">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-outline-secondary edit-my-sale-btn" data-id="1" data-policy="POL-2024-001234" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn btn-outline-info report-my-sale-btn" data-id="1" data-policy="POL-2024-001234" title="Report">
                                    <i class="bi bi-file-earmark-text"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="fw-semibold text-primary">POL-2024-001235</span></td>
                        <td>Sarah Peter</td>
                        <td>Life Insurance</td>
                        <td>TZS 280,000</td>
                        <td>TZS 28,000</td>
                        <td>Yesterday</td>
                        <td>
                            <span class="badge bg-success d-inline-flex align-items-center">
                                <i class="bi bi-check-circle-fill me-1"></i>Active
                            </span>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-primary view-my-sale-btn" data-id="2" data-policy="POL-2024-001235" title="View">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-outline-secondary edit-my-sale-btn" data-id="2" data-policy="POL-2024-001235" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn btn-outline-info report-my-sale-btn" data-id="2" data-policy="POL-2024-001235" title="Report">
                                    <i class="bi bi-file-earmark-text"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="fw-semibold text-primary">POL-2024-001236</span></td>
                        <td>David Omondi</td>
                        <td>Health Insurance</td>
                        <td>TZS 120,000</td>
                        <td>TZS 12,000</td>
                        <td>2 days ago</td>
                        <td>
                            <span class="badge bg-warning d-inline-flex align-items-center">
                                <i class="bi bi-clock-fill me-1"></i>Pending
                            </span>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-primary view-my-sale-btn" data-id="3" data-policy="POL-2024-001236" title="View">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-outline-secondary edit-my-sale-btn" data-id="3" data-policy="POL-2024-001236" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn btn-outline-info report-my-sale-btn" data-id="3" data-policy="POL-2024-001236" title="Report">
                                    <i class="bi bi-file-earmark-text"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add My Sale Modal -->
<div class="modal fade" id="addMySaleModal" tabindex="-1" aria-labelledby="addMySaleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="addMySaleModalLabel">
                    <i class="bi bi-cart-plus me-2"></i>New Personal Sale
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addMySaleForm">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="myCustomerName" class="form-label">Customer Name *</label>
                            <input type="text" class="form-control" id="myCustomerName" required placeholder="Enter customer name">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="myCustomerEmail" class="form-label">Customer Email *</label>
                            <input type="email" class="form-control" id="myCustomerEmail" required placeholder="Enter email">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="myCustomerPhone" class="form-label">Customer Phone *</label>
                            <input type="text" class="form-control" id="myCustomerPhone" required placeholder="Enter phone number">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="myProduct" class="form-label">Insurance Product *</label>
                            <select class="form-select" id="myProduct" required>
                                <option value="">Select Product</option>
                                @foreach($products as $p)
                                <option value="{{ $p->id }}">{{ $p->product_name }} (TZS {{ number_format($p->base_premium, 0) }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="myPremium" class="form-label">Premium Amount (TZS) *</label>
                            <input type="number" class="form-control" id="myPremium" required placeholder="Enter premium amount" min="0">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="myBranch" class="form-label">Branch *</label>
                            <select class="form-select" id="myBranch" required>
                                <option value="">Select Branch</option>
                                <option value="Branch A">Branch A</option>
                                <option value="Branch B">Branch B</option>
                                <option value="Branch C">Branch C</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="myPolicyEndDate" class="form-label">Policy End Date *</label>
                            <input type="date" class="form-control" id="myPolicyEndDate" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="myCompanyCode" class="form-label">Company Code</label>
                            <input type="text" class="form-control" id="myCompanyCode" placeholder="e.g. ICC113">
                            <div class="form-text">TIRA insurer company code</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="mySalePointCode" class="form-label">Sale Point Code</label>
                            <input type="text" class="form-control" id="mySalePointCode" placeholder="e.g. SP677">
                            <div class="form-text">TIRA sale point identifier</div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="addMySale()">
                    <i class="bi bi-save me-2"></i>Record Sale
                </button>
            </div>
        </div>
    </div>
</div>

<!-- View My Sale Modal -->
<div class="modal fade" id="viewMySaleModal" tabindex="-1" aria-labelledby="viewMySaleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="viewMySaleModalLabel">
                    <i class="bi bi-cart me-2"></i>Sale Details
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="mySaleDetails">
                    <!-- Sale details will be loaded here -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="editMySale()">
                    <i class="bi bi-pencil me-2"></i>Edit Sale
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Edit My Sale Modal -->
<div class="modal fade" id="editMySaleModal" tabindex="-1" aria-labelledby="editMySaleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="editMySaleModalLabel">
                    <i class="bi bi-pencil me-2"></i>Edit Personal Sale
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editMySaleForm">
                    <input type="hidden" id="editMySaleId">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="editMyCustomerName" class="form-label">Customer Name *</label>
                            <input type="text" class="form-control" id="editMyCustomerName" required placeholder="Enter customer name">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="editMyCustomerEmail" class="form-label">Customer Email *</label>
                            <input type="email" class="form-control" id="editMyCustomerEmail" required placeholder="Enter email">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="editMyCustomerPhone" class="form-label">Customer Phone *</label>
                            <input type="text" class="form-control" id="editMyCustomerPhone" required placeholder="Enter phone number">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="editMyProduct" class="form-label">Insurance Product *</label>
                            <select class="form-select" id="editMyProduct" required>
                                <option value="">Select Product</option>
                                @foreach($products as $p)
                                <option value="{{ $p->id }}">{{ $p->product_name }} (TZS {{ number_format($p->base_premium, 0) }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="editMyPremium" class="form-label">Premium Amount (TZS) *</label>
                            <input type="number" class="form-control" id="editMyPremium" required placeholder="Enter premium amount" min="0">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="editMyBranch" class="form-label">Branch *</label>
                            <select class="form-select" id="editMyBranch" required>
                                <option value="">Select Branch</option>
                                <option value="Branch A">Branch A</option>
                                <option value="Branch B">Branch B</option>
                                <option value="Branch C">Branch C</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="editMyPolicyStartDate" class="form-label">Policy Start Date *</label>
                            <input type="date" class="form-control" id="editMyPolicyStartDate" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="editMyPolicyEndDate" class="form-label">Policy End Date *</label>
                            <input type="date" class="form-control" id="editMyPolicyEndDate" required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="updateMySale()">
                    <i class="bi bi-save me-2"></i>Update Sale
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function addMySale() {
    const customerName = document.getElementById('myCustomerName').value;
    const customerEmail = document.getElementById('myCustomerEmail').value;
    const customerPhone = document.getElementById('myCustomerPhone').value;
    const product = document.getElementById('myProduct').value;
    const premium = document.getElementById('myPremium').value;
    const branch = document.getElementById('myBranch').value;
    const policyStartDate = document.getElementById('myPolicyStartDate').value;
    const policyEndDate = document.getElementById('myPolicyEndDate').value;

    // Validation
    if (!customerName || !customerEmail || !customerPhone || !product || !premium || !branch || !policyStartDate || !policyEndDate) {
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

    const companyCode = document.getElementById('myCompanyCode').value;
    const salePointCode = document.getElementById('mySalePointCode').value;

    const formData = new FormData();
    formData.append('customer_name', customerName);
    formData.append('customer_email', customerEmail);
    formData.append('customer_phone', customerPhone);
    formData.append('product_id', product);
    formData.append('premium', premium);
    formData.append('branch', branch);
    formData.append('sold_by', 'Current User');
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
            const modal = bootstrap.Modal.getInstance(document.getElementById('addMySaleModal'));
            modal.hide();

            // Reset form
            document.getElementById('addMySaleForm').reset();

            // Add new row to table
            const tableBody = document.querySelector('tbody');
            const newRow = document.createElement('tr');
            const commission = Math.round(parseInt(data.data.premium) * 0.1);
            newRow.innerHTML = `
                <td><span class="fw-semibold text-primary">${data.data.policy_number}</span></td>
                <td>${data.data.customer_name}</td>
                <td>${data.data.product}</td>
                <td>TZS ${parseInt(data.data.premium).toLocaleString()}</td>
                <td>TZS ${commission.toLocaleString()}</td>
                <td>Just now</td>
                <td>
                    <span class="badge bg-warning d-inline-flex align-items-center">
                        <i class="bi bi-clock-fill me-1"></i>Pending
                    </span>
                </td>
                <td>
                    <div class="btn-group btn-group-sm">
                        <button class="btn btn-outline-primary view-my-sale-btn" data-id="${data.data.id}" data-policy="${data.data.policy_number}" title="View">
                            <i class="bi bi-eye"></i>
                        </button>
                        <button class="btn btn-outline-secondary edit-my-sale-btn" data-id="${data.data.id}" data-policy="${data.data.policy_number}" title="Edit">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn btn-outline-info report-my-sale-btn" data-id="${data.data.id}" data-policy="${data.data.policy_number}" title="Report">
                            <i class="bi bi-file-earmark-text"></i>
                        </button>
                    </div>
                </td>
            `;
            tableBody.insertBefore(newRow, tableBody.firstChild);

            // Re-attach listeners
            attachMySaleListeners();

            Swal.fire({
                icon: 'success',
                title: 'Sale Recorded Successfully!',
                html: `
                    <p><strong>Policy No:</strong> ${data.data.policy_number}</p>
                    <p><strong>Customer:</strong> ${data.data.customer_name}</p>
                    <p><strong>Premium:</strong> TZS ${parseInt(data.data.premium).toLocaleString()}</p>
                    <p><strong>Commission:</strong> TZS ${commission.toLocaleString()}</p>
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

function viewMySale(saleId, policyNumber) {
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
            const commission = Math.round(parseInt(sale.premium) * 0.1);
            const statusBadge = sale.status === 'Active' 
                ? '<span class="badge bg-success d-inline-flex align-items-center"><i class="bi bi-check-circle-fill me-1"></i>Active</span>'
                : '<span class="badge bg-warning d-inline-flex align-items-center"><i class="bi bi-clock-fill me-1"></i>Pending</span>';

            document.getElementById('mySaleDetails').innerHTML = `
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
                        <label class="text-muted small">Commission (10%)</label>
                        <div class="fw-bold text-success">TZS ${commission.toLocaleString()}</div>
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
                </div>
            `;

            Swal.close();
            const modal = new bootstrap.Modal(document.getElementById('viewMySaleModal'));
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

function editMySale() {
    // This function is called from View Sale modal
    // For now, show a message
    Swal.fire({
        icon: 'info',
        title: 'Edit from View',
        text: 'Please use the edit button in the table to edit this sale',
        confirmButtonColor: '#0d6efd'
    });
}

function openEditMySaleModal(saleId, policyNumber) {
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
            document.getElementById('editMySaleId').value = sale.id;
            document.getElementById('editMyCustomerName').value = sale.customer_name;
            document.getElementById('editMyCustomerEmail').value = sale.customer_email;
            document.getElementById('editMyCustomerPhone').value = sale.customer_phone;
            document.getElementById('editMyProduct').value = sale.product;
            document.getElementById('editMyPremium').value = sale.premium;
            document.getElementById('editMyBranch').value = sale.branch;
            document.getElementById('editMyPolicyStartDate').value = sale.policy_start_date;
            document.getElementById('editMyPolicyEndDate').value = sale.policy_end_date;

            Swal.close();
            
            // Close view modal if open
            const viewModal = bootstrap.Modal.getInstance(document.getElementById('viewMySaleModal'));
            if (viewModal) {
                viewModal.hide();
            }

            // Open edit modal
            const editModal = new bootstrap.Modal(document.getElementById('editMySaleModal'));
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

function updateMySale() {
    const saleId = document.getElementById('editMySaleId').value;
    const customerName = document.getElementById('editMyCustomerName').value;
    const customerEmail = document.getElementById('editMyCustomerEmail').value;
    const customerPhone = document.getElementById('editMyCustomerPhone').value;
    const product = document.getElementById('editMyProduct').value;
    const premium = document.getElementById('editMyPremium').value;
    const branch = document.getElementById('editMyBranch').value;
    const policyStartDate = document.getElementById('editMyPolicyStartDate').value;
    const policyEndDate = document.getElementById('editMyPolicyEndDate').value;

    // Validation
    if (!customerName || !customerEmail || !customerPhone || !product || !premium || !branch || !policyStartDate || !policyEndDate) {
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
    formData.append('sold_by', 'Current User');
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
            const modal = bootstrap.Modal.getInstance(document.getElementById('editMySaleModal'));
            modal.hide();

            // Reset form
            document.getElementById('editMySaleForm').reset();

            // Update table row (simplified - in real app, update specific row)
            const commission = Math.round(parseInt(data.data.premium) * 0.1);
            Swal.fire({
                icon: 'success',
                title: 'Sale Updated Successfully!',
                html: `
                    <p><strong>Customer:</strong> ${data.data.customer_name}</p>
                    <p><strong>Product:</strong> ${data.data.product}</p>
                    <p><strong>Premium:</strong> TZS ${parseInt(data.data.premium).toLocaleString()}</p>
                    <p><strong>Commission:</strong> TZS ${commission.toLocaleString()}</p>
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

function generateMySaleReport(saleId, policyNumber) {
    Swal.fire({
        icon: 'info',
        title: 'Generating Report',
        text: 'Report generation coming soon',
        confirmButtonColor: '#0d6efd'
    });
}

function exportMySales() {
    Swal.fire({
        icon: 'info',
        title: 'Export Report',
        text: 'Export functionality coming soon',
        confirmButtonColor: '#0d6efd'
    });
}

// Attach all button listeners
function attachMySaleListeners() {
    document.querySelectorAll('.view-my-sale-btn').forEach(btn => {
        btn.removeEventListener('click', handleViewMySaleClick);
        btn.addEventListener('click', handleViewMySaleClick);
    });
    
    document.querySelectorAll('.edit-my-sale-btn').forEach(btn => {
        btn.removeEventListener('click', handleEditMySaleClick);
        btn.addEventListener('click', handleEditMySaleClick);
    });
    
    document.querySelectorAll('.report-my-sale-btn').forEach(btn => {
        btn.removeEventListener('click', handleReportMySaleClick);
        btn.addEventListener('click', handleReportMySaleClick);
    });
}

function handleViewMySaleClick(e) {
    const btn = e.target.closest('.view-my-sale-btn');
    const saleId = btn.getAttribute('data-id');
    const policyNumber = btn.getAttribute('data-policy');
    viewMySale(saleId, policyNumber);
}

function handleEditMySaleClick(e) {
    const btn = e.target.closest('.edit-my-sale-btn');
    const saleId = btn.getAttribute('data-id');
    const policyNumber = btn.getAttribute('data-policy');
    openEditMySaleModal(saleId, policyNumber);
}

function handleReportMySaleClick(e) {
    const btn = e.target.closest('.report-my-sale-btn');
    const saleId = btn.getAttribute('data-id');
    const policyNumber = btn.getAttribute('data-policy');
    generateMySaleReport(saleId, policyNumber);
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    attachMySaleListeners();
});
</script>
@endpush
@endsection

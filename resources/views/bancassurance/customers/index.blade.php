@extends('layouts.dashboard')

@section('dashboard_title', 'Bank Customers')

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
                <h5 class="fw-bold mb-1"><i class="bi bi-people me-2"></i>Bank Customers</h5>
                <p class="text-muted small mb-0">Manage bank customer referrals and conversions</p>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-outline-primary btn-sm" onclick="exportCustomers()">
                    <i class="bi bi-file-earmark-pdf me-2"></i>Export PDF
                </button>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addCustomerModal">
                    <i class="bi bi-plus-lg me-2"></i>Add Customer
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Customer Stats -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <small class="text-muted">Total Customers</small>
                        <h5 class="fw-bold mb-0">1,245</h5>
                    </div>
                    <div class="bg-primary bg-opacity-10 rounded-circle p-2">
                        <i class="bi bi-people text-primary"></i>
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
                        <small class="text-muted">Converted</small>
                        <h5 class="fw-bold mb-0">856</h5>
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
                        <small class="text-muted">Pending</small>
                        <h5 class="fw-bold mb-0">389</h5>
                    </div>
                    <div class="bg-warning bg-opacity-10 rounded-circle p-2">
                        <i class="bi bi-clock text-warning"></i>
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
                        <small class="text-muted">Conversion Rate</small>
                        <h5 class="fw-bold mb-0">68.7%</h5>
                    </div>
                    <div class="bg-info bg-opacity-10 rounded-circle p-2">
                        <i class="bi bi-graph-up text-info"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Customers Table -->
<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="fw-bold mb-0">Customer List</h6>
            <div class="input-group" style="width: 250px;">
                <span class="input-group-text bg-light border-0">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text" class="form-control border-0 bg-light" placeholder="Search customers...">
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Bank Account</th>
                        <th>Interest</th>
                        <th>Status</th>
                        <th>Referred By</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="bg-secondary bg-opacity-10 rounded-circle p-2 me-2">
                                    <i class="bi bi-person text-secondary"></i>
                                </div>
                                <div>
                                    <div class="fw-semibold">Hamis Juma</div>
                                    <small class="text-muted">hamis@email.com</small>
                                </div>
                            </div>
                        </td>
                        <td>CRDB ...8821</td>
                        <td>Motor Insurance</td>
                        <td>
                            <span class="badge bg-success d-inline-flex align-items-center">
                                <i class="bi bi-check-circle-fill me-1"></i>Converted
                            </span>
                        </td>
                        <td>Branch A</td>
                        <td>Today</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-primary view-btn" data-id="1" data-name="Hamis Juma" title="View">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-outline-secondary" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="bg-secondary bg-opacity-10 rounded-circle p-2 me-2">
                                    <i class="bi bi-person text-secondary"></i>
                                </div>
                                <div>
                                    <div class="fw-semibold">Sarah Peter</div>
                                    <small class="text-muted">sarah@email.com</small>
                                </div>
                            </div>
                        </td>
                        <td>NMB ...4432</td>
                        <td>Life Insurance</td>
                        <td>
                            <span class="badge bg-warning d-inline-flex align-items-center">
                                <i class="bi bi-clock-fill me-1"></i>Pending
                            </span>
                        </td>
                        <td>Branch B</td>
                        <td>Yesterday</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-primary view-btn" data-id="2" data-name="Sarah Peter" title="View">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-outline-secondary" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="bg-secondary bg-opacity-10 rounded-circle p-2 me-2">
                                    <i class="bi bi-person text-secondary"></i>
                                </div>
                                <div>
                                    <div class="fw-semibold">David Omondi</div>
                                    <small class="text-muted">david@email.com</small>
                                </div>
                            </div>
                        </td>
                        <td>NBC ...9912</td>
                        <td>Health Insurance</td>
                        <td>
                            <span class="badge bg-success d-inline-flex align-items-center">
                                <i class="bi bi-check-circle-fill me-1"></i>Converted
                            </span>
                        </td>
                        <td>Branch A</td>
                        <td>2 days ago</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-primary view-btn" data-id="3" data-name="David Omondi" title="View">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-outline-secondary" title="Edit">
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

<!-- Add Customer Modal -->
<div class="modal fade" id="addCustomerModal" tabindex="-1" aria-labelledby="addCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="addCustomerModalLabel">
                    <i class="bi bi-person-plus me-2"></i>Add New Customer
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addCustomerForm">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstName" class="form-label">First Name *</label>
                            <input type="text" class="form-control" id="firstName" required placeholder="Enter first name">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName" class="form-label">Last Name *</label>
                            <input type="text" class="form-control" id="lastName" required placeholder="Enter last name">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email *</label>
                            <input type="email" class="form-control" id="email" required placeholder="Enter email">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Phone *</label>
                            <input type="text" class="form-control" id="phone" required placeholder="Enter phone number">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="bankName" class="form-label">Bank Name *</label>
                            <select class="form-select" id="bankName" required>
                                <option value="">Select Bank</option>
                                <option value="CRDB Bank">CRDB Bank</option>
                                <option value="NMB Bank">NMB Bank</option>
                                <option value="NBC Bank">NBC Bank</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="bankAccount" class="form-label">Bank Account *</label>
                            <input type="text" class="form-control" id="bankAccount" required placeholder="Enter account number">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="interest" class="form-label">Insurance Interest *</label>
                            <select class="form-select" id="interest" required>
                                <option value="">Select Interest</option>
                                <option value="Motor Insurance">Motor Insurance</option>
                                <option value="Life Insurance">Life Insurance</option>
                                <option value="Health Insurance">Health Insurance</option>
                                <option value="Travel Insurance">Travel Insurance</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="referredBy" class="form-label">Referred By *</label>
                            <input type="text" class="form-control" id="referredBy" required placeholder="Branch or Agent">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="addCustomer()">
                    <i class="bi bi-save me-2"></i>Add Customer
                </button>
            </div>
        </div>
    </div>
</div>

<!-- View Customer Modal -->
<div class="modal fade" id="viewCustomerModal" tabindex="-1" aria-labelledby="viewCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="viewCustomerModalLabel">
                    <i class="bi bi-person me-2"></i>Customer Details
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="customerDetails">
                    <!-- Customer details will be loaded here -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="editCustomer()">
                    <i class="bi bi-pencil me-2"></i>Edit Customer
                </button>
            </div>
        </div>
    </div>
</div>

<!-- PDF Preview Modal -->
<div class="modal fade" id="pdfPreviewModal" tabindex="-1" aria-labelledby="pdfPreviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="pdfPreviewModalLabel">
                    <i class="bi bi-file-earmark-pdf me-2"></i>PDF Preview
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-light">
                <div class="a4-page bg-white mx-auto shadow-sm" style="width: 210mm; min-height: 297mm; padding: 20mm;">
                    <!-- Header -->
                    <div class="text-center mb-4 border-bottom pb-3">
                        <div class="d-flex align-items-center justify-content-center mb-2">
                            <img src="/logo.png" alt="Bimakwik Logo" class="me-3" style="height: 60px; width: auto;">
                            <div>
                                <h4 class="fw-bold mb-0 text-primary">BIMAKWIK</h4>
                                <p class="text-muted small mb-0">Bank Customer Referrals Report</p>
                            </div>
                        </div>
                    </div>

                    <!-- Report Info -->
                    <div class="row mb-4">
                        <div class="col-6">
                            <p class="mb-1"><strong>Report Date:</strong> <span id="reportDate"></span></p>
                            <p class="mb-1"><strong>Generated By:</strong> Bancassurance System</p>
                        </div>
                        <div class="col-6 text-end">
                            <p class="mb-1"><strong>Total Customers:</strong> <span id="totalCustomers">1,245</span></p>
                            <p class="mb-1"><strong>Report Ref:</strong> <span id="reportRef">BIM-2024-001</span></p>
                        </div>
                    </div>

                    <!-- Summary Stats -->
                    <div class="row mb-4">
                        <div class="col-4">
                            <div class="border p-2 text-center">
                                <small class="text-muted">Total Customers</small>
                                <h5 class="fw-bold mb-0 text-primary">1,245</h5>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="border p-2 text-center">
                                <small class="text-muted">Converted</small>
                                <h5 class="fw-bold mb-0 text-success">856</h5>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="border p-2 text-center">
                                <small class="text-muted">Pending</small>
                                <h5 class="fw-bold mb-0 text-warning">389</h5>
                            </div>
                        </div>
                    </div>

                    <!-- Customer Table -->
                    <h6 class="fw-bold mb-3">Customer List</h6>
                    <table class="table table-bordered table-sm">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Customer Name</th>
                                <th>Email</th>
                                <th>Bank</th>
                                <th>Interest</th>
                                <th>Status</th>
                                <th>Referred By</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Hamis Juma</td>
                                <td>hamis@email.com</td>
                                <td>CRDB Bank</td>
                                <td>Motor Insurance</td>
                                <td><span class="badge bg-success">Converted</span></td>
                                <td>Branch A</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Sarah Peter</td>
                                <td>sarah@email.com</td>
                                <td>NMB Bank</td>
                                <td>Life Insurance</td>
                                <td><span class="badge bg-warning">Pending</span></td>
                                <td>Branch B</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>David Omondi</td>
                                <td>david@email.com</td>
                                <td>NBC Bank</td>
                                <td>Health Insurance</td>
                                <td><span class="badge bg-success">Converted</span></td>
                                <td>Branch A</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Grace Mwamba</td>
                                <td>grace@email.com</td>
                                <td>CRDB Bank</td>
                                <td>Travel Insurance</td>
                                <td><span class="badge bg-success">Converted</span></td>
                                <td>Branch C</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>John Masanja</td>
                                <td>john@email.com</td>
                                <td>NMB Bank</td>
                                <td>Motor Insurance</td>
                                <td><span class="badge bg-warning">Pending</span></td>
                                <td>Branch A</td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Footer -->
                    <div class="mt-5 pt-3 border-top">
                        <div class="row">
                            <div class="col-6">
                                <small class="text-muted">This is an official report generated by Bimakwik Bancassurance System</small>
                            </div>
                            <div class="col-6 text-end">
                                <small class="text-muted">Page 1 of 1</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="downloadPDF()">
                    <i class="bi bi-download me-2"></i>Download PDF
                </button>
                <button type="button" class="btn btn-success" onclick="printPDF()">
                    <i class="bi bi-printer me-2"></i>Print
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Clean PDF Preview Modal (for download) -->
<div class="modal fade" id="cleanPdfPreviewModal" tabindex="-1" aria-labelledby="cleanPdfPreviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="cleanPdfPreviewModalLabel">
                    <i class="bi bi-file-earmark-pdf me-2"></i>Clean PDF Preview
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-light">
                <div class="a4-page bg-white mx-auto shadow-sm" style="width: 210mm; min-height: 297mm; padding: 20mm;">
                    <!-- Header -->
                    <div class="text-center mb-4 border-bottom pb-3">
                        <div class="d-flex align-items-center justify-content-center mb-2">
                            <img src="/logo.png" alt="Bimakwik Logo" class="me-3" style="height: 60px; width: auto;">
                            <div>
                                <h4 class="fw-bold mb-0 text-primary">BIMAKWIK</h4>
                                <p class="text-muted small mb-0">Bank Customer Referrals Report</p>
                            </div>
                        </div>
                    </div>

                    <!-- Report Info -->
                    <div class="row mb-4">
                        <div class="col-6">
                            <p class="mb-1"><strong>Report Date:</strong> <span id="cleanReportDate"></span></p>
                            <p class="mb-1"><strong>Generated By:</strong> Bancassurance System</p>
                        </div>
                        <div class="col-6 text-end">
                            <p class="mb-1"><strong>Total Customers:</strong> <span id="cleanTotalCustomers">1,245</span></p>
                            <p class="mb-1"><strong>Report Ref:</strong> <span id="cleanReportRef">BIM-2024-001</span></p>
                        </div>
                    </div>

                    <!-- Customer Table (Clean - no badges) -->
                    <h6 class="fw-bold mb-3">Customer List</h6>
                    <table class="table table-bordered table-sm">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Customer Name</th>
                                <th>Email</th>
                                <th>Bank</th>
                                <th>Interest</th>
                                <th>Status</th>
                                <th>Referred By</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Hamis Juma</td>
                                <td>hamis@email.com</td>
                                <td>CRDB Bank</td>
                                <td>Motor Insurance</td>
                                <td>Converted</td>
                                <td>Branch A</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Sarah Peter</td>
                                <td>sarah@email.com</td>
                                <td>NMB Bank</td>
                                <td>Life Insurance</td>
                                <td>Pending</td>
                                <td>Branch B</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>David Omondi</td>
                                <td>david@email.com</td>
                                <td>NBC Bank</td>
                                <td>Health Insurance</td>
                                <td>Converted</td>
                                <td>Branch A</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Grace Mwamba</td>
                                <td>grace@email.com</td>
                                <td>CRDB Bank</td>
                                <td>Travel Insurance</td>
                                <td>Converted</td>
                                <td>Branch C</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>John Masanja</td>
                                <td>john@email.com</td>
                                <td>NMB Bank</td>
                                <td>Motor Insurance</td>
                                <td>Pending</td>
                                <td>Branch A</td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Footer -->
                    <div class="mt-5 pt-3 border-top">
                        <div class="row">
                            <div class="col-6">
                                <small class="text-muted">This is an official report generated by Bimakwik Bancassurance System</small>
                            </div>
                            <div class="col-6 text-end">
                                <small class="text-muted">Page 1 of 1</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="downloadCleanPDF()">
                    <i class="bi bi-download me-2"></i>Download PDF
                </button>
                <button type="button" class="btn btn-success" onclick="printCleanPDF()">
                    <i class="bi bi-printer me-2"></i>Print
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function addCustomer() {
    const firstName = document.getElementById('firstName').value;
    const lastName = document.getElementById('lastName').value;
    const email = document.getElementById('email').value;
    const phone = document.getElementById('phone').value;
    const bankName = document.getElementById('bankName').value;
    const bankAccount = document.getElementById('bankAccount').value;
    const interest = document.getElementById('interest').value;
    const referredBy = document.getElementById('referredBy').value;

    // Validation
    if (!firstName || !lastName || !email || !phone || !bankName || !bankAccount || !interest || !referredBy) {
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
        title: 'Adding Customer...',
        text: 'Please wait while we add the customer',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    // AJAX call
    const formData = new FormData();
    formData.append('first_name', firstName);
    formData.append('last_name', lastName);
    formData.append('email', email);
    formData.append('phone', phone);
    formData.append('bank_account', bankAccount);
    formData.append('bank_name', bankName);
    formData.append('interest', interest);
    formData.append('referred_by', referredBy);

    fetch('/bancassurance/customers', {
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
            const modal = bootstrap.Modal.getInstance(document.getElementById('addCustomerModal'));
            modal.hide();

            // Reset form
            document.getElementById('addCustomerForm').reset();

            // Add new row to table
            const tableBody = document.querySelector('tbody');
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td>
                    <div class="d-flex align-items-center">
                        <div class="bg-secondary bg-opacity-10 rounded-circle p-2 me-2">
                            <i class="bi bi-person text-secondary"></i>
                        </div>
                        <div>
                            <div class="fw-semibold">${data.data.first_name} ${data.data.last_name}</div>
                            <small class="text-muted">${data.data.email}</small>
                        </div>
                    </div>
                </td>
                <td>${data.data.bank_name} ...${data.data.bank_account.slice(-4)}</td>
                <td>${data.data.interest}</td>
                <td>
                    <span class="badge bg-warning d-inline-flex align-items-center">
                        <i class="bi bi-clock-fill me-1"></i>Pending
                    </span>
                </td>
                <td>${data.data.referred_by}</td>
                <td>Just now</td>
                <td>
                    <div class="btn-group btn-group-sm">
                        <button class="btn btn-outline-primary view-btn" data-id="${data.data.id}" data-name="${data.data.first_name} ${data.data.last_name}" title="View">
                            <i class="bi bi-eye"></i>
                        </button>
                        <button class="btn btn-outline-secondary" title="Edit">
                            <i class="bi bi-pencil"></i>
                        </button>
                    </div>
                </td>
            `;
            tableBody.insertBefore(newRow, tableBody.firstChild);

            // Re-attach listeners
            attachViewListeners();

            Swal.fire({
                icon: 'success',
                title: 'Customer Added Successfully!',
                html: `
                    <p><strong>Name:</strong> ${data.data.first_name} ${data.data.last_name}</p>
                    <p><strong>Email:</strong> ${data.data.email}</p>
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
            text: 'An error occurred while adding customer',
            confirmButtonColor: '#dc3545'
        });
        console.error('Error:', error);
    });
}

function viewCustomer(customerId, customerName) {
    Swal.fire({
        title: 'Loading...',
        text: 'Fetching customer details',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    fetch(`/bancassurance/customers/${customerId}`, {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const customer = data.data;
            const statusBadge = customer.status === 'Converted' 
                ? '<span class="badge bg-success d-inline-flex align-items-center"><i class="bi bi-check-circle-fill me-1"></i>Converted</span>'
                : '<span class="badge bg-warning d-inline-flex align-items-center"><i class="bi bi-clock-fill me-1"></i>Pending</span>';

            document.getElementById('customerDetails').innerHTML = `
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="text-muted small">Full Name</label>
                        <div class="fw-semibold">${customer.first_name} ${customer.last_name}</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted small">Status</label>
                        <div>${statusBadge}</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted small">Email</label>
                        <div>${customer.email}</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted small">Phone</label>
                        <div>${customer.phone}</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted small">Bank</label>
                        <div>${customer.bank_name}</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted small">Bank Account</label>
                        <div>${customer.bank_account}</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted small">Insurance Interest</label>
                        <div>${customer.interest}</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted small">Referred By</label>
                        <div>${customer.referred_by}</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted small">Created At</label>
                        <div>${customer.created_at}</div>
                    </div>
                    <div class="col-12 mb-3">
                        <label class="text-muted small">Notes</label>
                        <div>${customer.notes || 'No notes'}</div>
                    </div>
                </div>
            `;

            Swal.close();
            const modal = new bootstrap.Modal(document.getElementById('viewCustomerModal'));
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
            text: 'An error occurred while fetching customer details',
            confirmButtonColor: '#dc3545'
        });
        console.error('Error:', error);
    });
}

function exportCustomers() {
    Swal.fire({
        title: 'Generating PDF...',
        text: 'Please wait while we generate the PDF report',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    fetch('/bancassurance/customers/export', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update report info
            document.getElementById('reportDate').textContent = new Date().toLocaleDateString();
            document.getElementById('totalCustomers').textContent = data.data.total_customers;
            document.getElementById('reportRef').textContent = 'BIM-' + new Date().getFullYear() + '-' + String(Math.floor(Math.random() * 1000)).padStart(3, '0');

            Swal.close();
            
            // Open PDF preview modal
            const modal = new bootstrap.Modal(document.getElementById('pdfPreviewModal'));
            modal.show();
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Export Failed',
                text: data.message,
                confirmButtonColor: '#dc3545'
            });
        }
    })
    .catch(error => {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'An error occurred during export',
            confirmButtonColor: '#dc3545'
        });
        console.error('Error:', error);
    });
}

function downloadPDF() {
    Swal.fire({
        icon: 'success',
        title: 'Downloading PDF...',
        text: 'Your PDF is being downloaded',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    setTimeout(() => {
        Swal.fire({
            icon: 'success',
            title: 'Download Complete!',
            text: 'PDF file has been downloaded successfully',
            confirmButtonColor: '#0d6efd'
        });
        
        const modal = bootstrap.Modal.getInstance(document.getElementById('pdfPreviewModal'));
        modal.hide();
    }, 1500);
}

function printPDF() {
    Swal.fire({
        icon: 'info',
        title: 'Preparing Print...',
        text: 'Opening print dialog for A4 report',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    setTimeout(() => {
        Swal.close();
        
        // Print only the A4 page
        const a4Page = document.querySelector('.a4-page');
        const originalContent = document.body.innerHTML;
        
        document.body.innerHTML = a4Page.outerHTML;
        window.print();
        document.body.innerHTML = originalContent;
        
        // Re-attach listeners after restoring content
        location.reload();
    }, 1000);
}

function editCustomer() {
    Swal.fire({
        icon: 'info',
        title: 'Edit Customer',
        text: 'Edit functionality coming soon',
        confirmButtonColor: '#0d6efd'
    });
}

// Attach view button listeners
function attachViewListeners() {
    document.querySelectorAll('.view-btn').forEach(btn => {
        btn.removeEventListener('click', handleViewClick);
        btn.addEventListener('click', handleViewClick);
    });
}

function handleViewClick(e) {
    const btn = e.target.closest('.view-btn');
    const customerId = btn.getAttribute('data-id');
    const customerName = btn.getAttribute('data-name');
    viewCustomer(customerId, customerName);
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    attachViewListeners();
});
</script>
@endpush
@endsection

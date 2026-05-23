@extends('layouts.dashboard')

@section('dashboard_title', 'Compliance')

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
    
    /* Tabs Styles */
    .nav-tabs {
        border-bottom: 2px solid #e9ecef;
    }
    .nav-tabs .nav-link {
        border: none;
        color: #6c757d;
        font-weight: 500;
        padding: 1rem 1.5rem;
        border-radius: 8px 8px 0 0;
        margin-right: 0.25rem;
    }
    .nav-tabs .nav-link:hover {
        color: #0d6efd;
        background: #f8f9fa;
    }
    .nav-tabs .nav-link.active {
        color: #0d6efd;
        background: #fff;
        border-bottom: 2px solid #0d6efd;
        font-weight: 600;
    }
    
    /* PDF Preview Modal Styles */
    .pdf-preview-container {
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        padding: 2rem;
        max-height: 500px;
        overflow-y: auto;
    }
    
    .pdf-header {
        text-align: center;
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #0d6efd;
    }
    
    .pdf-title {
        font-size: 1.5rem;
        font-weight: bold;
        color: #0d6efd;
        margin-bottom: 0.5rem;
    }
    
    .pdf-subtitle {
        font-size: 0.9rem;
        color: #6c757d;
    }
    
    .pdf-section {
        margin-bottom: 1.5rem;
    }
    
    .pdf-section-title {
        font-weight: bold;
        color: #343a40;
        margin-bottom: 0.5rem;
        font-size: 1.1rem;
    }
    
    .pdf-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 1rem;
    }
    
    .pdf-table th,
    .pdf-table td {
        border: 1px solid #dee2e6;
        padding: 0.75rem;
        text-align: left;
    }
    
    .pdf-table th {
        background: #e9ecef;
        font-weight: bold;
    }
    
    .pdf-footer {
        margin-top: 2rem;
        padding-top: 1rem;
        border-top: 1px solid #dee2e6;
        text-align: center;
        color: #6c757d;
        font-size: 0.85rem;
    }
</style>
@endpush

@section('dashboard_content')
<!-- Header -->
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h5 class="fw-bold mb-1"><i class="bi bi-shield-check me-2"></i>Compliance</h5>
                <p class="text-muted small mb-0">Manage regulatory compliance and requirements</p>
            </div>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addCheckModal">
                <i class="bi bi-plus-lg me-2"></i>Add Check
            </button>
        </div>
    </div>
</div>

<!-- Compliance Stats -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <small class="text-muted">Compliance Score</small>
                        <h5 class="fw-bold mb-0">96%</h5>
                    </div>
                    <div class="bg-success bg-opacity-10 rounded-circle p-2">
                        <i class="bi bi-shield-check text-success"></i>
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
                        <small class="text-muted">Pending Checks</small>
                        <h5 class="fw-bold mb-0">3</h5>
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
                        <small class="text-muted">Completed</small>
                        <h5 class="fw-bold mb-0">42</h5>
                    </div>
                    <div class="bg-info bg-opacity-10 rounded-circle p-2">
                        <i class="bi bi-check-circle text-info"></i>
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
                        <small class="text-muted">Next Audit</small>
                        <h5 class="fw-bold mb-0">5 Days</h5>
                    </div>
                    <div class="bg-primary bg-opacity-10 rounded-circle p-2">
                        <i class="bi bi-calendar text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Compliance Checklist -->
<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="fw-bold mb-0">Compliance Checklist</h6>
            <div class="input-group" style="width: 250px;">
                <span class="input-group-text bg-light border-0">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text" class="form-control border-0 bg-light" placeholder="Search checks...">
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Check Item</th>
                        <th>Category</th>
                        <th>Due Date</th>
                        <th>Assigned To</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>AML/KYC Verification</td>
                        <td>Regulatory</td>
                        <td>May 25, 2024</td>
                        <td>John Doe</td>
                        <td>
                            <span class="badge bg-success d-inline-flex align-items-center">
                                <i class="bi bi-check-circle-fill me-1"></i>Completed
                            </span>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-primary view-check-btn" data-id="1" data-item="AML/KYC Verification" title="View">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Data Protection Audit</td>
                        <td>Privacy</td>
                        <td>May 28, 2024</td>
                        <td>Jane Smith</td>
                        <td>
                            <span class="badge bg-info d-inline-flex align-items-center">
                                <i class="bi bi-arrow-repeat me-1"></i>In Progress
                            </span>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-primary view-check-btn" data-id="2" data-item="Data Protection Audit" title="View">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>TIRA Compliance Report</td>
                        <td>Regulatory</td>
                        <td>May 30, 2024</td>
                        <td>John Doe</td>
                        <td>
                            <span class="badge bg-warning d-inline-flex align-items-center">
                                <i class="bi bi-clock-fill me-1"></i>Pending
                            </span>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-primary view-check-btn" data-id="3" data-item="TIRA Compliance Report" title="View">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Check Modal -->
<div class="modal fade" id="addCheckModal" tabindex="-1" aria-labelledby="addCheckModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="addCheckModalLabel">
                    <i class="bi bi-plus-lg me-2"></i>Add New Compliance Check
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addCheckForm">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="checkItem" class="form-label">Check Item *</label>
                            <input type="text" class="form-control" id="checkItem" required placeholder="Enter check item">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="checkCategory" class="form-label">Category *</label>
                            <select class="form-select" id="checkCategory" required>
                                <option value="">Select Category</option>
                                <option value="Regulatory">Regulatory</option>
                                <option value="Privacy">Privacy</option>
                                <option value="Security">Security</option>
                                <option value="Financial">Financial</option>
                                <option value="Operational">Operational</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="dueDate" class="form-label">Due Date *</label>
                            <input type="date" class="form-control" id="dueDate" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="assignedTo" class="form-label">Assigned To *</label>
                            <input type="text" class="form-control" id="assignedTo" required placeholder="Enter assignee name">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="checkDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="checkDescription" rows="3" placeholder="Enter check description (optional)"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="addCheck()">
                    <i class="bi bi-plus-lg me-2"></i>Add Check
                </button>
            </div>
        </div>
    </div>
</div>

<!-- View Check Modal (PDF Preview) -->
<div class="modal fade" id="viewCheckModal" tabindex="-1" aria-labelledby="viewCheckModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="viewCheckModalLabel">
                    <i class="bi bi-file-earmark-pdf me-2"></i>Compliance Check Preview
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="checkPreview" class="pdf-preview-container">
                    <!-- Check preview will be loaded here -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" onclick="downloadCheck()">
                    <i class="bi bi-download me-2"></i>Download PDF
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function addCheck() {
    const checkItem = document.getElementById('checkItem').value;
    const checkCategory = document.getElementById('checkCategory').value;
    const dueDate = document.getElementById('dueDate').value;
    const assignedTo = document.getElementById('assignedTo').value;
    const checkDescription = document.getElementById('checkDescription').value;

    // Validation
    if (!checkItem || !checkCategory || !dueDate || !assignedTo) {
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
        title: 'Adding Check...',
        text: 'Please wait while we add the compliance check',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    // AJAX call
    const formData = new FormData();
    formData.append('check_item', checkItem);
    formData.append('category', checkCategory);
    formData.append('due_date', dueDate);
    formData.append('assigned_to', assignedTo);
    formData.append('description', checkDescription);

    fetch('/bancassurance/compliance/checks', {
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
            const modal = bootstrap.Modal.getInstance(document.getElementById('addCheckModal'));
            modal.hide();

            // Reset form
            document.getElementById('addCheckForm').reset();

            // Add new row to table
            const tableBody = document.querySelector('tbody');
            const newRow = document.createElement('tr');
            const statusBadge = '<span class="badge bg-warning d-inline-flex align-items-center"><i class="bi bi-clock-fill me-1"></i>Pending</span>';
            newRow.innerHTML = `
                <td>${data.data.check_item}</td>
                <td>${data.data.category}</td>
                <td>${data.data.due_date}</td>
                <td>${data.data.assigned_to}</td>
                <td>${statusBadge}</td>
                <td>
                    <div class="btn-group btn-group-sm">
                        <button class="btn btn-outline-primary view-check-btn" data-id="${data.data.id}" data-item="${data.data.check_item}" title="View">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </td>
            `;
            tableBody.insertBefore(newRow, tableBody.firstChild);

            // Re-attach listeners
            attachCheckListeners();

            Swal.fire({
                icon: 'success',
                title: 'Check Added Successfully!',
                html: `
                    <p><strong>Check Item:</strong> ${data.data.check_item}</p>
                    <p><strong>Category:</strong> ${data.data.category}</p>
                    <p><strong>Due Date:</strong> ${data.data.due_date}</p>
                    <p><strong>Assigned To:</strong> ${data.data.assigned_to}</p>
                    <p><strong>Status:</strong> ${statusBadge}</p>
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
            text: 'An error occurred while adding check',
            confirmButtonColor: '#dc3545'
        });
        console.error('Error:', error);
    });
}

function viewCheck(checkId, checkItem) {
    Swal.fire({
        title: 'Loading...',
        text: 'Fetching check details',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    fetch(`/bancassurance/compliance/checks/${checkId}`, {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const check = data.data;
            const statusBadge = check.status === 'Completed' 
                ? '<span class="badge bg-success d-inline-flex align-items-center"><i class="bi bi-check-circle-fill me-1"></i>Completed</span>'
                : check.status === 'In Progress' 
                ? '<span class="badge bg-info d-inline-flex align-items-center"><i class="bi bi-arrow-repeat me-1"></i>In Progress</span>'
                : '<span class="badge bg-warning d-inline-flex align-items-center"><i class="bi bi-clock-fill me-1"></i>Pending</span>';

            const evidenceHtml = check.evidence ? check.evidence.map(e => `<li>${e}</li>`).join('') : '';

            document.getElementById('checkPreview').innerHTML = `
                <div class="pdf-header">
                    <div class="pdf-title">BIMAKWIK BANCASSURANCE</div>
                    <div class="pdf-subtitle">Compliance Check Report</div>
                    <div class="pdf-subtitle">Check ID: ${check.id}</div>
                </div>
                
                <div class="pdf-section">
                    <div class="pdf-section-title">Check Information</div>
                    <table class="pdf-table">
                        <tr>
                            <th>Check Item</th>
                            <td>${check.check_item}</td>
                        </tr>
                        <tr>
                            <th>Category</th>
                            <td>${check.category}</td>
                        </tr>
                        <tr>
                            <th>Due Date</th>
                            <td>${check.due_date}</td>
                        </tr>
                        <tr>
                            <th>Assigned To</th>
                            <td>${check.assigned_to}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>${statusBadge}</td>
                        </tr>
                        <tr>
                            <th>Created Date</th>
                            <td>${check.created_at}</td>
                        </tr>
                    </table>
                </div>
                
                <div class="pdf-section">
                    <div class="pdf-section-title">Description</div>
                    <p>${check.description || 'No description provided.'}</p>
                </div>
                
                ${evidenceHtml ? `
                <div class="pdf-section">
                    <div class="pdf-section-title">Evidence Documents</div>
                    <ul>${evidenceHtml}</ul>
                </div>
                ` : ''}
                
                <div class="pdf-footer">
                    <p>This compliance check was generated by Bimakwik Bancassurance System</p>
                    <p>Generated on: ${check.created_at}</p>
                </div>
            `;

            Swal.close();
            const modal = new bootstrap.Modal(document.getElementById('viewCheckModal'));
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
            text: 'An error occurred while fetching check details',
            confirmButtonColor: '#dc3545'
        });
        console.error('Error:', error);
    });
}

function downloadCheck(checkId) {
    if (!checkId) {
        Swal.fire({
            icon: 'info',
            title: 'Download Check',
            text: 'Please select a check to download',
            confirmButtonColor: '#0d6efd'
        });
        return;
    }

    Swal.fire({
        title: 'Downloading...',
        text: 'Please wait while we download the check',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    // Simulate download
    setTimeout(() => {
        Swal.fire({
            icon: 'success',
            title: 'Downloaded!',
            text: 'Compliance check has been downloaded successfully',
            confirmButtonColor: '#0d6efd'
        });
    }, 1500);
}

// Attach all button listeners
function attachCheckListeners() {
    document.querySelectorAll('.view-check-btn').forEach(btn => {
        btn.removeEventListener('click', handleViewCheckClick);
        btn.addEventListener('click', handleViewCheckClick);
    });
}

function handleViewCheckClick(e) {
    const btn = e.target.closest('.view-check-btn');
    const checkId = btn.getAttribute('data-id');
    const checkItem = btn.getAttribute('data-item');
    viewCheck(checkId, checkItem);
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    attachCheckListeners();
});
</script>
@endpush
@endsection

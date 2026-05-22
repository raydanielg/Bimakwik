@extends('layouts.dashboard')

@section('dashboard_title', 'Bank Integration')

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
                <h5 class="fw-bold mb-1"><i class="bi bi-link-45deg me-2"></i>Bank Integration</h5>
                <p class="text-muted small mb-0">Connect and manage bank system integrations</p>
            </div>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addIntegrationModal">
                <i class="bi bi-plus-lg me-2"></i>Add Integration
            </button>
        </div>
    </div>
</div>

<!-- Integration Status -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <small class="text-muted">Active Integrations</small>
                        <h5 class="fw-bold mb-0">3</h5>
                    </div>
                    <div class="bg-success bg-opacity-10 rounded-circle p-2">
                        <i class="bi bi-check-circle text-success"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <small class="text-muted">Pending Setup</small>
                        <h5 class="fw-bold mb-0">1</h5>
                    </div>
                    <div class="bg-warning bg-opacity-10 rounded-circle p-2">
                        <i class="bi bi-clock text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <small class="text-muted">API Calls Today</small>
                        <h5 class="fw-bold mb-0">1,245</h5>
                    </div>
                    <div class="bg-info bg-opacity-10 rounded-circle p-2">
                        <i class="bi bi-activity text-info"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bank Integrations List -->
<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <h6 class="fw-bold mb-3">Connected Banks</h6>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Bank Name</th>
                        <th>Integration Type</th>
                        <th>Status</th>
                        <th>Last Sync</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-2">
                                    <i class="bi bi-bank text-primary"></i>
                                </div>
                                <div>
                                    <div class="fw-semibold">CRDB Bank</div>
                                    <small class="text-muted">Tanzania</small>
                                </div>
                            </div>
                        </td>
                        <td>API Integration</td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td>2 mins ago</td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary sync-btn" data-id="1">Sync</button>
                            <button class="btn btn-sm btn-outline-secondary settings-btn" data-id="1" data-bank="CRDB Bank" data-status="active">Settings</button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="bg-success bg-opacity-10 rounded-circle p-2 me-2">
                                    <i class="bi bi-bank text-success"></i>
                                </div>
                                <div>
                                    <div class="fw-semibold">NMB Bank</div>
                                    <small class="text-muted">Tanzania</small>
                                </div>
                            </div>
                        </td>
                        <td>API Integration</td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td>5 mins ago</td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary sync-btn" data-id="2">Sync</button>
                            <button class="btn btn-sm btn-outline-secondary settings-btn" data-id="2" data-bank="NMB Bank" data-status="active">Settings</button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="bg-warning bg-opacity-10 rounded-circle p-2 me-2">
                                    <i class="bi bi-bank text-warning"></i>
                                </div>
                                <div>
                                    <div class="fw-semibold">NBC Bank</div>
                                    <small class="text-muted">Tanzania</small>
                                </div>
                            </div>
                        </td>
                        <td>API Integration</td>
                        <td><span class="badge bg-warning">Pending</span></td>
                        <td>Never</td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary">Setup</button>
                            <button class="btn btn-sm btn-outline-secondary">Remove</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Integration Modal -->
<div class="modal fade" id="addIntegrationModal" tabindex="-1" aria-labelledby="addIntegrationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="addIntegrationModalLabel">
                    <i class="bi bi-link-45deg me-2"></i>Add New Bank Integration
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addIntegrationForm">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="bankName" class="form-label">Bank Name *</label>
                            <input type="text" class="form-control" id="bankName" required placeholder="e.g., CRDB Bank">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="bankCountry" class="form-label">Country *</label>
                            <select class="form-select" id="bankCountry" required>
                                <option value="">Select Country</option>
                                <option value="Tanzania">Tanzania</option>
                                <option value="Kenya">Kenya</option>
                                <option value="Uganda">Uganda</option>
                                <option value="Rwanda">Rwanda</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="integrationType" class="form-label">Integration Type *</label>
                            <select class="form-select" id="integrationType" required>
                                <option value="">Select Type</option>
                                <option value="API Integration">API Integration</option>
                                <option value="SFTP Integration">SFTP Integration</option>
                                <option value="Webhook Integration">Webhook Integration</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="apiEndpoint" class="form-label">API Endpoint</label>
                            <input type="url" class="form-control" id="apiEndpoint" placeholder="https://api.bank.com">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="apiKey" class="form-label">API Key</label>
                            <input type="password" class="form-control" id="apiKey" placeholder="Enter API Key">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="apiSecret" class="form-label">API Secret</label>
                            <input type="password" class="form-control" id="apiSecret" placeholder="Enter API Secret">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" rows="3" placeholder="Brief description of the integration"></textarea>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="testConnection">
                        <label class="form-check-label" for="testConnection">
                            Test connection after setup
                        </label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="saveIntegration()">
                    <i class="bi bi-save me-2"></i>Save Integration
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function saveIntegration() {
    const bankName = document.getElementById('bankName').value;
    const bankCountry = document.getElementById('bankCountry').value;
    const integrationType = document.getElementById('integrationType').value;
    const apiEndpoint = document.getElementById('apiEndpoint').value;
    const apiKey = document.getElementById('apiKey').value;
    const apiSecret = document.getElementById('apiSecret').value;
    const description = document.getElementById('description').value;
    const testConnection = document.getElementById('testConnection').checked;

    // Client-side validation
    if (!bankName || !bankCountry || !integrationType) {
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
        title: 'Saving Integration...',
        text: 'Please wait while we save the bank integration',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    // AJAX call to backend
    const formData = new FormData();
    formData.append('bank_name', bankName);
    formData.append('bank_country', bankCountry);
    formData.append('integration_type', integrationType);
    formData.append('api_endpoint', apiEndpoint);
    formData.append('api_key', apiKey);
    formData.append('api_secret', apiSecret);
    formData.append('description', description);
    formData.append('test_connection', testConnection ? '1' : '0');

    fetch('/bancassurance/integration', {
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
            const modal = bootstrap.Modal.getInstance(document.getElementById('addIntegrationModal'));
            modal.hide();

            // Reset form
            document.getElementById('addIntegrationForm').reset();

            // Show success message
            Swal.fire({
                icon: 'success',
                title: 'Integration Added Successfully!',
                html: `
                    <div class="text-start">
                        <p><strong>Bank:</strong> ${data.data.bank_name}</p>
                        <p><strong>Country:</strong> ${data.data.bank_country}</p>
                        <p><strong>Type:</strong> ${data.data.integration_type}</p>
                        <p><strong>Status:</strong> <span class="badge bg-warning">Pending Setup</span></p>
                        ${data.data.connection_test ? '<p><strong>Connection Test:</strong> <span class="badge bg-success">Passed</span></p>' : ''}
                    </div>
                `,
                confirmButtonColor: '#0d6efd',
                confirmButtonText: 'Done'
            }).then(() => {
                // Add new row to table
                const tableBody = document.querySelector('tbody');
                const newRow = document.createElement('tr');
                newRow.innerHTML = `
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="bg-warning bg-opacity-10 rounded-circle p-2 me-2">
                                <i class="bi bi-bank text-warning"></i>
                            </div>
                            <div>
                                <div class="fw-semibold">${data.data.bank_name}</div>
                                <small class="text-muted">${data.data.bank_country}</small>
                            </div>
                        </div>
                    </td>
                    <td>${data.data.integration_type}</td>
                    <td><span class="badge bg-warning">Pending</span></td>
                    <td>Never</td>
                    <td>
                        <button class="btn btn-sm btn-outline-primary sync-btn" data-id="${data.data.id}">Sync</button>
                        <button class="btn btn-sm btn-outline-secondary">Settings</button>
                    </td>
                `;
                tableBody.insertBefore(newRow, tableBody.firstChild);
                
                // Re-attach sync button event listener
                attachSyncListeners();
            });
        } else {
            // Show validation errors
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
            text: 'An error occurred while saving the integration',
            confirmButtonColor: '#dc3545'
        });
        console.error('Error:', error);
    });
}

// Sync button functionality
function attachSyncListeners() {
    document.querySelectorAll('.sync-btn').forEach(btn => {
        btn.removeEventListener('click', handleSyncClick);
        btn.addEventListener('click', handleSyncClick);
    });
}

function handleSyncClick(e) {
    const btn = e.target;
    const bankId = btn.getAttribute('data-id') || '1';
    
    Swal.fire({
        title: 'Syncing...',
        text: 'Syncing bank data...',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    fetch(`/bancassurance/integration/sync/${bankId}`, {
        method: 'POST',
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
                title: 'Sync Complete',
                html: `
                    <p>Bank data has been synced successfully</p>
                    <p><strong>Last Sync:</strong> ${data.data.last_sync}</p>
                    <p><strong>Records Synced:</strong> ${data.data.records_synced}</p>
                `,
                confirmButtonColor: '#0d6efd'
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Sync Failed',
                text: data.message,
                confirmButtonColor: '#dc3545'
            });
        }
    })
    .catch(error => {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'An error occurred during sync',
            confirmButtonColor: '#dc3545'
        });
        console.error('Error:', error);
    });
}

// Initialize sync listeners on page load
document.addEventListener('DOMContentLoaded', function() {
    attachSyncListeners();
});
</script>
@endpush
@endsection

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
                            <button class="btn btn-sm btn-outline-primary setup-btn" data-id="3" data-bank="NBC Bank">Setup</button>
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

<!-- Settings Modal -->
<div class="modal fade" id="settingsModal" tabindex="-1" aria-labelledby="settingsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="settingsModalLabel">
                    <i class="bi bi-gear me-2"></i>Bank Integration Settings
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="settingsForm">
                    <input type="hidden" id="settingsBankId">
                    
                    <!-- Status Section -->
                    <div class="card border-0 bg-light mb-3">
                        <div class="card-body p-3">
                            <h6 class="fw-bold mb-3"><i class="bi bi-toggle-on me-2"></i>Status</h6>
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <div class="fw-semibold" id="settingsBankName">CRDB Bank</div>
                                    <small class="text-muted">Enable or disable this integration</small>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="statusToggle" style="width: 3em; height: 1.5em;">
                                    <label class="form-check-label" for="statusToggle" id="statusLabel">Active</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sync Settings -->
                    <div class="card border-0 bg-light mb-3">
                        <div class="card-body p-3">
                            <h6 class="fw-bold mb-3"><i class="bi bi-arrow-repeat me-2"></i>Sync Settings</h6>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="autoSync">
                                        <label class="form-check-label" for="autoSync">Auto Sync</label>
                                    </div>
                                    <small class="text-muted">Automatically sync data</small>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="syncInterval" class="form-label">Sync Interval (minutes)</label>
                                    <input type="number" class="form-control" id="syncInterval" min="1" max="60" value="5">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- API Settings -->
                    <div class="card border-0 bg-light mb-3">
                        <div class="card-body p-3">
                            <h6 class="fw-bold mb-3"><i class="bi bi-code-slash me-2"></i>API Settings</h6>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="apiTimeout" class="form-label">API Timeout (seconds)</label>
                                    <input type="number" class="form-control" id="apiTimeout" min="5" max="120" value="30">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="retryAttempts" class="form-label">Retry Attempts</label>
                                    <input type="number" class="form-control" id="retryAttempts" min="1" max="10" value="3">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Notification Settings -->
                    <div class="card border-0 bg-light mb-3">
                        <div class="card-body p-3">
                            <h6 class="fw-bold mb-3"><i class="bi bi-bell me-2"></i>Notifications</h6>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="notificationEnabled">
                                <label class="form-check-label" for="notificationEnabled">Enable Notifications</label>
                            </div>
                            <small class="text-muted">Receive alerts for sync failures and errors</small>
                        </div>
                    </div>

                    <!-- Log Settings -->
                    <div class="card border-0 bg-light mb-3">
                        <div class="card-body p-3">
                            <h6 class="fw-bold mb-3"><i class="bi bi-journal-text me-2"></i>Logging</h6>
                            <label for="logLevel" class="form-label">Log Level</label>
                            <select class="form-select" id="logLevel">
                                <option value="debug">Debug</option>
                                <option value="info">Info</option>
                                <option value="warning">Warning</option>
                                <option value="error">Error</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="saveSettings()">
                    <i class="bi bi-save me-2"></i>Save Settings
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Setup Modal -->
<div class="modal fade" id="setupModal" tabindex="-1" aria-labelledby="setupModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="setupModalLabel">
                    <i class="bi bi-gear-fill me-2"></i>Complete Bank Integration Setup
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="setupForm">
                    <input type="hidden" id="setupBankId">
                    
                    <!-- Bank Info -->
                    <div class="alert alert-info mb-3">
                        <i class="bi bi-info-circle me-2"></i>
                        <strong>Bank:</strong> <span id="setupBankName">NBC Bank</span>
                    </div>

                    <!-- API Configuration -->
                    <div class="card border-0 bg-light mb-3">
                        <div class="card-body p-3">
                            <h6 class="fw-bold mb-3"><i class="bi bi-code-slash me-2"></i>API Configuration</h6>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="setupApiEndpoint" class="form-label">API Endpoint *</label>
                                    <input type="url" class="form-control" id="setupApiEndpoint" required placeholder="https://api.bank.com/v1">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="setupApiKey" class="form-label">API Key *</label>
                                    <input type="text" class="form-control" id="setupApiKey" required placeholder="Enter API Key">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="setupApiSecret" class="form-label">API Secret *</label>
                                    <input type="password" class="form-control" id="setupApiSecret" required placeholder="Enter API Secret">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Database Configuration -->
                    <div class="card border-0 bg-light mb-3">
                        <div class="card-body p-3">
                            <h6 class="fw-bold mb-3"><i class="bi bi-database me-2"></i>Database Configuration</h6>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="dbHost" class="form-label">Database Host *</label>
                                    <input type="text" class="form-control" id="dbHost" required placeholder="localhost">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="dbPort" class="form-label">Database Port *</label>
                                    <input type="number" class="form-control" id="dbPort" required placeholder="3306" min="1" max="65535">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="dbName" class="form-label">Database Name *</label>
                                    <input type="text" class="form-control" id="dbName" required placeholder="bank_integration_db">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="dbUser" class="form-label">Database User *</label>
                                    <input type="text" class="form-control" id="dbUser" required placeholder="db_user">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="dbPassword" class="form-label">Database Password *</label>
                                    <input type="password" class="form-control" id="dbPassword" required placeholder="Enter password">
                                </div>
                            </div>
                            <button type="button" class="btn btn-outline-primary btn-sm mt-2" onclick="testDatabaseConnection()">
                                <i class="bi bi-plug me-2"></i>Test Connection
                            </button>
                            <div id="connectionStatus" class="mt-2"></div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" onclick="completeSetup()">
                    <i class="bi bi-check-circle me-2"></i>Complete Setup
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
    attachSettingsListeners();
    attachSetupListeners();
});

// Setup button functionality
function attachSetupListeners() {
    document.querySelectorAll('.setup-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const bankId = this.getAttribute('data-id');
            const bankName = this.getAttribute('data-bank');
            openSetupModal(bankId, bankName);
        });
    });
}

function openSetupModal(bankId, bankName) {
    document.getElementById('setupBankId').value = bankId;
    document.getElementById('setupBankName').textContent = bankName;
    
    // Clear form
    document.getElementById('setupForm').reset();
    document.getElementById('connectionStatus').innerHTML = '';
    
    // Open modal
    const modal = new bootstrap.Modal(document.getElementById('setupModal'));
    modal.show();
}

function testDatabaseConnection() {
    const dbHost = document.getElementById('dbHost').value;
    const dbPort = document.getElementById('dbPort').value;
    const dbName = document.getElementById('dbName').value;
    const dbUser = document.getElementById('dbUser').value;
    const dbPassword = document.getElementById('dbPassword').value;
    
    // Validation
    if (!dbHost || !dbPort || !dbName || !dbUser || !dbPassword) {
        Swal.fire({
            icon: 'error',
            title: 'Validation Error',
            text: 'Please fill in all database fields',
            confirmButtonColor: '#dc3545'
        });
        return;
    }
    
    // Show testing status
    const connectionStatus = document.getElementById('connectionStatus');
    connectionStatus.innerHTML = '<div class="alert alert-warning"><i class="bi bi-hourglass-split me-2"></i>Testing connection...</div>';
    
    // AJAX call to test connection
    const formData = new FormData();
    formData.append('database_host', dbHost);
    formData.append('database_port', dbPort);
    formData.append('database_name', dbName);
    formData.append('database_user', dbUser);
    formData.append('database_password', dbPassword);
    
    fetch('/bancassurance/integration/test-connection', {
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
            connectionStatus.innerHTML = `
                <div class="alert alert-success">
                    <i class="bi bi-check-circle me-2"></i>
                    <strong>Connection Successful!</strong><br>
                    <small>Connection time: ${data.data.connection_time} | Database: ${data.data.database_version}</small>
                </div>
            `;
        } else {
            connectionStatus.innerHTML = `
                <div class="alert alert-danger">
                    <i class="bi bi-x-circle me-2"></i>
                    <strong>Connection Failed!</strong><br>
                    <small>${data.message}</small>
                </div>
            `;
        }
    })
    .catch(error => {
        connectionStatus.innerHTML = `
            <div class="alert alert-danger">
                <i class="bi bi-x-circle me-2"></i>
                <strong>Connection Failed!</strong><br>
                <small>An error occurred while testing connection</small>
            </div>
        `;
        console.error('Error:', error);
    });
}

function completeSetup() {
    const bankId = document.getElementById('setupBankId').value;
    const apiEndpoint = document.getElementById('setupApiEndpoint').value;
    const apiKey = document.getElementById('setupApiKey').value;
    const apiSecret = document.getElementById('setupApiSecret').value;
    const dbHost = document.getElementById('dbHost').value;
    const dbPort = document.getElementById('dbPort').value;
    const dbName = document.getElementById('dbName').value;
    const dbUser = document.getElementById('dbUser').value;
    const dbPassword = document.getElementById('dbPassword').value;
    
    // Validation
    if (!apiEndpoint || !apiKey || !apiSecret || !dbHost || !dbPort || !dbName || !dbUser || !dbPassword) {
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
        title: 'Completing Setup...',
        text: 'Please wait while we complete the bank integration setup',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
    
    // AJAX call to complete setup
    const formData = new FormData();
    formData.append('api_endpoint', apiEndpoint);
    formData.append('api_key', apiKey);
    formData.append('api_secret', apiSecret);
    formData.append('database_host', dbHost);
    formData.append('database_port', dbPort);
    formData.append('database_name', dbName);
    formData.append('database_user', dbUser);
    formData.append('database_password', dbPassword);
    
    fetch(`/bancassurance/integration/setup/${bankId}`, {
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
            const modal = bootstrap.Modal.getInstance(document.getElementById('setupModal'));
            modal.hide();
            
            // Update table row
            const row = document.querySelector(`.setup-btn[data-id="${bankId}"]`).closest('tr');
            const statusBadge = row.querySelector('.badge');
            statusBadge.textContent = 'Active';
            statusBadge.className = 'badge bg-success';
            
            // Change Setup button to Sync and Settings
            const actionsCell = row.querySelector('td:last-child');
            actionsCell.innerHTML = `
                <button class="btn btn-sm btn-outline-primary sync-btn" data-id="${bankId}">Sync</button>
                <button class="btn btn-sm btn-outline-secondary settings-btn" data-id="${bankId}" data-bank="${document.getElementById('setupBankName').textContent}" data-status="active">Settings</button>
            `;
            
            // Re-attach listeners
            attachSyncListeners();
            attachSettingsListeners();
            
            Swal.fire({
                icon: 'success',
                title: 'Setup Completed Successfully!',
                html: `
                    <p>Bank integration has been set up and activated</p>
                    <p><strong>Status:</strong> <span class="badge bg-success">Active</span></p>
                `,
                confirmButtonColor: '#0d6efd'
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Setup Failed',
                text: data.message,
                confirmButtonColor: '#dc3545'
            });
        }
    })
    .catch(error => {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'An error occurred while completing setup',
            confirmButtonColor: '#dc3545'
        });
        console.error('Error:', error);
    });
}

// Settings button functionality
function attachSettingsListeners() {
    document.querySelectorAll('.settings-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const bankId = this.getAttribute('data-id');
            const bankName = this.getAttribute('data-bank');
            const status = this.getAttribute('data-status');
            openSettingsModal(bankId, bankName, status);
        });
    });
}

function openSettingsModal(bankId, bankName, status) {
    document.getElementById('settingsBankId').value = bankId;
    document.getElementById('settingsBankName').textContent = bankName;
    
    // Set status toggle
    const statusToggle = document.getElementById('statusToggle');
    const statusLabel = document.getElementById('statusLabel');
    statusToggle.checked = status === 'active';
    statusLabel.textContent = status === 'active' ? 'Active' : 'Disabled';
    
    // Load settings from backend
    fetch(`/bancassurance/integration/settings/${bankId}`, {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Populate form with settings
            document.getElementById('autoSync').checked = data.data.auto_sync;
            document.getElementById('syncInterval').value = data.data.sync_interval;
            document.getElementById('apiTimeout').value = data.data.api_timeout;
            document.getElementById('retryAttempts').value = data.data.retry_attempts;
            document.getElementById('notificationEnabled').checked = data.data.notification_enabled;
            document.getElementById('logLevel').value = data.data.log_level;
        }
    })
    .catch(error => {
        console.error('Error loading settings:', error);
    });
    
    // Open modal
    const modal = new bootstrap.Modal(document.getElementById('settingsModal'));
    modal.show();
}

function saveSettings() {
    const bankId = document.getElementById('settingsBankId').value;
    const status = document.getElementById('statusToggle').checked ? 'active' : 'disabled';
    const autoSync = document.getElementById('autoSync').checked;
    const syncInterval = document.getElementById('syncInterval').value;
    const apiTimeout = document.getElementById('apiTimeout').value;
    const retryAttempts = document.getElementById('retryAttempts').value;
    const notificationEnabled = document.getElementById('notificationEnabled').checked;
    const logLevel = document.getElementById('logLevel').value;
    
    // Show loading
    Swal.fire({
        title: 'Saving Settings...',
        text: 'Please wait while we save the settings',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
    
    // Save status first
    const formData = new FormData();
    formData.append('status', status);
    
    fetch(`/bancassurance/integration/status/${bankId}`, {
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
            // Update status badge in table
            const statusBadge = document.querySelector(`.settings-btn[data-id="${bankId}"]`).closest('tr').querySelector('.badge');
            statusBadge.textContent = status === 'active' ? 'Active' : 'Disabled';
            statusBadge.className = `badge bg-${status === 'active' ? 'success' : 'secondary'}`;
            
            // Update data-status attribute
            document.querySelector(`.settings-btn[data-id="${bankId}"]`).setAttribute('data-status', status);
            
            // Save other settings
            const settingsFormData = new FormData();
            settingsFormData.append('auto_sync', autoSync ? '1' : '0');
            settingsFormData.append('sync_interval', syncInterval);
            settingsFormData.append('api_timeout', apiTimeout);
            settingsFormData.append('retry_attempts', retryAttempts);
            settingsFormData.append('notification_enabled', notificationEnabled ? '1' : '0');
            settingsFormData.append('log_level', logLevel);
            
            return fetch(`/bancassurance/integration/settings/${bankId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: settingsFormData
            });
        } else {
            throw new Error(data.message);
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const modal = bootstrap.Modal.getInstance(document.getElementById('settingsModal'));
            modal.hide();
            
            Swal.fire({
                icon: 'success',
                title: 'Settings Saved Successfully!',
                text: 'Bank integration settings have been updated',
                confirmButtonColor: '#0d6efd'
            });
        } else {
            throw new Error(data.message);
        }
    })
    .catch(error => {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: error.message || 'An error occurred while saving settings',
            confirmButtonColor: '#dc3545'
        });
        console.error('Error:', error);
    });
}

// Status toggle change handler
document.getElementById('statusToggle').addEventListener('change', function() {
    const statusLabel = document.getElementById('statusLabel');
    statusLabel.textContent = this.checked ? 'Active' : 'Disabled';
});
</script>
@endpush
@endsection

@extends('layouts.dashboard')

@section('dashboard_title', 'Compliance & Reports')

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
                <h5 class="fw-bold mb-1"><i class="bi bi-file-earmark-bar-graph me-2"></i>Compliance & Reports</h5>
                <p class="text-muted small mb-0">Generate and manage compliance reports</p>
            </div>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#generateReportModal">
                <i class="bi bi-plus-lg me-2"></i>Generate Report
            </button>
        </div>
    </div>
</div>

<!-- Report Stats -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <small class="text-muted">Total Reports</small>
                        <h5 class="fw-bold mb-0">45</h5>
                    </div>
                    <div class="bg-primary bg-opacity-10 rounded-circle p-2">
                        <i class="bi bi-file-earmark text-primary"></i>
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
                        <h5 class="fw-bold mb-0">12</h5>
                    </div>
                    <div class="bg-success bg-opacity-10 rounded-circle p-2">
                        <i class="bi bi-calendar text-success"></i>
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
                        <small class="text-muted">Pending Review</small>
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
                        <small class="text-muted">Compliance Score</small>
                        <h5 class="fw-bold mb-0">96%</h5>
                    </div>
                    <div class="bg-info bg-opacity-10 rounded-circle p-2">
                        <i class="bi bi-shield-check text-info"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Reports Table -->
<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="fw-bold mb-0">Recent Reports</h6>
            <div class="input-group" style="width: 250px;">
                <span class="input-group-text bg-light border-0">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text" class="form-control border-0 bg-light" placeholder="Search reports...">
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Report ID</th>
                        <th>Report Type</th>
                        <th>Period</th>
                        <th>Generated By</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><span class="fw-semibold text-primary">RPT-2024-001</span></td>
                        <td>Monthly Sales Report</td>
                        <td>May 2024</td>
                        <td>John Doe</td>
                        <td>Today</td>
                        <td>
                            <span class="badge bg-success d-inline-flex align-items-center">
                                <i class="bi bi-check-circle-fill me-1"></i>Approved
                            </span>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-primary view-report-btn" data-id="RPT-2024-001" title="View">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-outline-success download-report-btn" data-id="RPT-2024-001" title="Download">
                                    <i class="bi bi-download"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="fw-semibold text-primary">RPT-2024-002</span></td>
                        <td>Compliance Report</td>
                        <td>Q2 2024</td>
                        <td>Jane Smith</td>
                        <td>Yesterday</td>
                        <td>
                            <span class="badge bg-warning d-inline-flex align-items-center">
                                <i class="bi bi-clock-fill me-1"></i>Pending
                            </span>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-primary view-report-btn" data-id="RPT-2024-002" title="View">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-outline-success download-report-btn" data-id="RPT-2024-002" title="Download">
                                    <i class="bi bi-download"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="fw-semibold text-primary">RPT-2024-003</span></td>
                        <td>Performance Report</td>
                        <td>May 2024</td>
                        <td>John Doe</td>
                        <td>2 days ago</td>
                        <td>
                            <span class="badge bg-success d-inline-flex align-items-center">
                                <i class="bi bi-check-circle-fill me-1"></i>Approved
                            </span>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-primary view-report-btn" data-id="RPT-2024-003" title="View">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-outline-success download-report-btn" data-id="RPT-2024-003" title="Download">
                                    <i class="bi bi-download"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Generate Report Modal -->
<div class="modal fade" id="generateReportModal" tabindex="-1" aria-labelledby="generateReportModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="generateReportModalLabel">
                    <i class="bi bi-file-earmark-plus me-2"></i>Generate New Report
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="generateReportForm">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="reportType" class="form-label">Report Type *</label>
                            <select class="form-select" id="reportType" required>
                                <option value="">Select Report Type</option>
                                <option value="Monthly Sales Report">Monthly Sales Report</option>
                                <option value="Compliance Report">Compliance Report</option>
                                <option value="Performance Report">Performance Report</option>
                                <option value="Claims Report">Claims Report</option>
                                <option value="Commission Report">Commission Report</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="reportPeriod" class="form-label">Period *</label>
                            <select class="form-select" id="reportPeriod" required>
                                <option value="">Select Period</option>
                                <option value="January 2024">January 2024</option>
                                <option value="February 2024">February 2024</option>
                                <option value="March 2024">March 2024</option>
                                <option value="April 2024">April 2024</option>
                                <option value="May 2024">May 2024</option>
                                <option value="Q1 2024">Q1 2024</option>
                                <option value="Q2 2024">Q2 2024</option>
                                <option value="YTD 2024">YTD 2024</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="reportDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="reportDescription" rows="3" placeholder="Enter report description (optional)"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="generateReport()">
                    <i class="bi bi-file-earmark-plus me-2"></i>Generate Report
                </button>
            </div>
        </div>
    </div>
</div>

<!-- View Report Modal (PDF Preview) -->
<div class="modal fade" id="viewReportModal" tabindex="-1" aria-labelledby="viewReportModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="viewReportModalLabel">
                    <i class="bi bi-file-earmark-pdf me-2"></i>Report Preview
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="reportPreview" class="pdf-preview-container">
                    <!-- Report preview will be loaded here -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" onclick="downloadReport()">
                    <i class="bi bi-download me-2"></i>Download PDF
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script>
let currentReportId = null;

function generateReport() {
    const reportType = document.getElementById('reportType').value;
    const reportPeriod = document.getElementById('reportPeriod').value;
    const reportDescription = document.getElementById('reportDescription').value;

    // Validation
    if (!reportType || !reportPeriod) {
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
        title: 'Generating Report...',
        text: 'Please wait while we generate the report',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    // AJAX call
    const formData = new FormData();
    formData.append('report_type', reportType);
    formData.append('period', reportPeriod);
    formData.append('description', reportDescription);

    fetch('/bancassurance/reports/generate', {
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
            const modal = bootstrap.Modal.getInstance(document.getElementById('generateReportModal'));
            modal.hide();

            // Reset form
            document.getElementById('generateReportForm').reset();

            // Add new row to table
            const tableBody = document.querySelector('tbody');
            const newRow = document.createElement('tr');
            const statusBadge = '<span class="badge bg-warning d-inline-flex align-items-center"><i class="bi bi-clock-fill me-1"></i>Pending</span>';
            newRow.innerHTML = `
                <td><span class="fw-semibold text-primary">${data.data.id}</span></td>
                <td>${data.data.report_type}</td>
                <td>${data.data.period}</td>
                <td>${data.data.generated_by}</td>
                <td>Just now</td>
                <td>${statusBadge}</td>
                <td>
                    <div class="btn-group btn-group-sm">
                        <button class="btn btn-outline-primary view-report-btn" data-id="${data.data.id}" title="View">
                            <i class="bi bi-eye"></i>
                        </button>
                        <button class="btn btn-outline-success download-report-btn" data-id="${data.data.id}" title="Download">
                            <i class="bi bi-download"></i>
                        </button>
                    </div>
                </td>
            `;
            tableBody.insertBefore(newRow, tableBody.firstChild);

            // Re-attach listeners
            attachReportListeners();

            Swal.fire({
                icon: 'success',
                title: 'Report Generated Successfully!',
                html: `
                    <p><strong>Report ID:</strong> ${data.data.id}</p>
                    <p><strong>Type:</strong> ${data.data.report_type}</p>
                    <p><strong>Period:</strong> ${data.data.period}</p>
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
            text: 'An error occurred while generating report',
            confirmButtonColor: '#dc3545'
        });
        console.error('Error:', error);
    });
}

function viewReport(reportId) {
    currentReportId = reportId;
    
    Swal.fire({
        title: 'Loading...',
        text: 'Fetching report details',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    fetch(`/bancassurance/reports/${reportId}`, {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const report = data.data;
            const statusBadge = report.status === 'Approved' 
                ? '<span class="badge bg-success d-inline-flex align-items-center"><i class="bi bi-check-circle-fill me-1"></i>Approved</span>'
                : '<span class="badge bg-warning d-inline-flex align-items-center"><i class="bi bi-clock-fill me-1"></i>Pending</span>';

            document.getElementById('reportPreview').innerHTML = `
                <div class="pdf-header">
                    <div class="pdf-title">BIMAKWIK BANCASSURANCE</div>
                    <div class="pdf-subtitle">${report.report_type}</div>
                    <div class="pdf-subtitle">Report ID: ${report.id}</div>
                </div>
                
                <div class="pdf-section">
                    <div class="pdf-section-title">Report Information</div>
                    <table class="pdf-table">
                        <tr>
                            <th>Report Type</th>
                            <td>${report.report_type}</td>
                        </tr>
                        <tr>
                            <th>Period</th>
                            <td>${report.period}</td>
                        </tr>
                        <tr>
                            <th>Generated By</th>
                            <td>${report.generated_by}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>${statusBadge}</td>
                        </tr>
                        <tr>
                            <th>Generated Date</th>
                            <td>${report.created_at}</td>
                        </tr>
                    </table>
                </div>
                
                <div class="pdf-section">
                    <div class="pdf-section-title">Description</div>
                    <p>${report.description || 'No description provided.'}</p>
                </div>
                
                <div class="pdf-section">
                    <div class="pdf-section-title">Report Data</div>
                    <table class="pdf-table">
                        <tr>
                            <th>Total Sales</th>
                            <td>${report.data.total_sales}</td>
                        </tr>
                        <tr>
                            <th>Total Premium</th>
                            <td>${report.data.total_premium}</td>
                        </tr>
                        <tr>
                            <th>Total Commission</th>
                            <td>${report.data.total_commission}</td>
                        </tr>
                        <tr>
                            <th>Active Policies</th>
                            <td>${report.data.active_policies}</td>
                        </tr>
                        <tr>
                            <th>Pending Policies</th>
                            <td>${report.data.pending_policies}</td>
                        </tr>
                    </table>
                </div>
                
                <div class="pdf-footer">
                    <p>This report was generated by Bimakwik Bancassurance System</p>
                    <p>Generated on: ${report.created_at}</p>
                </div>
            `;

            Swal.close();
            const modal = new bootstrap.Modal(document.getElementById('viewReportModal'));
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
            text: 'An error occurred while fetching report details',
            confirmButtonColor: '#dc3545'
        });
        console.error('Error:', error);
    });
}

function downloadReport(reportId) {
    // If reportId is not provided, use currentReportId
    const idToDownload = reportId || currentReportId;
    
    if (!idToDownload) {
        Swal.fire({
            icon: 'info',
            title: 'Download Report',
            text: 'Please select a report to download',
            confirmButtonColor: '#0d6efd'
        });
        return;
    }

    Swal.fire({
        title: 'Generating PDF...',
        text: 'Please wait while we generate the PDF',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    // Get the report preview element
    const element = document.getElementById('reportPreview');
    
    // Configure html2pdf options
    const opt = {
        margin: 10,
        filename: `report_${idToDownload}_${new Date().toISOString().slice(0,10)}.pdf`,
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
    };

    // Generate and download PDF
    html2pdf().set(opt).from(element).save().then(() => {
        Swal.fire({
            icon: 'success',
            title: 'Downloaded!',
            text: `Report has been downloaded successfully as PDF`,
            confirmButtonColor: '#0d6efd'
        });
    }).catch(error => {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'An error occurred while generating PDF',
            confirmButtonColor: '#dc3545'
        });
        console.error('Error:', error);
    });
}

// Attach all button listeners
function attachReportListeners() {
    document.querySelectorAll('.view-report-btn').forEach(btn => {
        btn.removeEventListener('click', handleViewReportClick);
        btn.addEventListener('click', handleViewReportClick);
    });
    
    document.querySelectorAll('.download-report-btn').forEach(btn => {
        btn.removeEventListener('click', handleDownloadReportClick);
        btn.addEventListener('click', handleDownloadReportClick);
    });
}

function handleViewReportClick(e) {
    const btn = e.target.closest('.view-report-btn');
    const reportId = btn.getAttribute('data-id');
    viewReport(reportId);
}

function handleDownloadReportClick(e) {
    const btn = e.target.closest('.download-report-btn');
    const reportId = btn.getAttribute('data-id');
    downloadReport(reportId);
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    attachReportListeners();
});
</script>
@endpush
@endsection

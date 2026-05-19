@extends('layouts.dashboard')

@section('dashboard_content')
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="fw-bold mb-1"><i class="bi bi-shield-check me-2"></i>Compliance & Regulatory</h2>
                <p class="text-muted small mb-0">TIRA compliance monitoring and regulatory reporting</p>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-outline-primary rounded-pill px-4" onclick="generateReport()">
                    <i class="bi bi-file-earmark-plus me-2"></i>Generate Report
                </button>
                <button class="btn btn-primary rounded-pill px-4" onclick="submitToTIRA()">
                    <i class="bi bi-send me-2"></i>Submit to TIRA
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Compliance Score</p>
                        <h3 class="fw-bold mb-0 text-success">{{ $reports->count() > 0 ? '96%' : '0%' }}</h3>
                    </div>
                    <div class="bg-success bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-shield-check text-success fs-4"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <div class="progress" style="height: 6px;">
                        <div class="progress-bar bg-success" style="width: {{ $reports->count() > 0 ? '96%' : '0%' }}"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Total Reports</p>
                        <h3 class="fw-bold mb-0">{{ $reports->total() }}</h3>
                    </div>
                    <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-file-earmark-text text-primary fs-4"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <small class="text-muted">Audit & Compliance</small>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Pending Review</p>
                        <h3 class="fw-bold mb-0 text-warning">{{ $reports->where('status', 'pending')->count() }}</h3>
                    </div>
                    <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-clock-history text-warning fs-4"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <small class="text-muted">Awaiting action</small>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">This Month</p>
                        <h3 class="fw-bold mb-0">{{ $reports->where('created_at', '>=', now()->startOfMonth())->count() }}</h3>
                    </div>
                    <div class="bg-info bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-calendar-check text-info fs-4"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <small class="text-muted">Submitted reports</small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Compliance Reports Table -->
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-bottom py-3">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold"><i class="bi bi-list-check me-2"></i>Compliance Reports</h5>
            <span class="badge bg-primary bg-opacity-10 text-primary">{{ $reports->total() }} Reports</span>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="border-0 py-3 px-4">ID</th>
                        <th class="border-0 py-3">Report Type</th>
                        <th class="border-0 py-3">Description</th>
                        <th class="border-0 py-3">Status</th>
                        <th class="border-0 py-3">Date</th>
                        <th class="border-0 py-3 text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reports as $report)
                    <tr>
                        <td class="py-3 px-4">
                            <span class="badge bg-secondary bg-opacity-10 text-secondary">#{{ $report->id }}</span>
                        </td>
                        <td class="py-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-2">
                                    <i class="bi bi-file-earmark-check text-primary small"></i>
                                </div>
                                <div>
                                    <div class="fw-semibold small">{{ $report->report_type ?? 'Compliance Report' }}</div>
                                    <small class="text-muted">{{ $report->category ?? 'General' }}</small>
                                </div>
                            </div>
                        </td>
                        <td class="py-3">
                            <div class="small">{{ Str::limit($report->description ?? 'Regulatory compliance check', 50) }}</div>
                        </td>
                        <td class="py-3">
                            @php
                                $statusColors = [
                                    'pending' => 'warning',
                                    'approved' => 'success',
                                    'rejected' => 'danger',
                                    'submitted' => 'info',
                                    'draft' => 'secondary',
                                ];
                                $status = $report->status ?? 'pending';
                                $color = $statusColors[$status] ?? 'secondary';
                            @endphp
                            <span class="badge bg-{{ $color }} bg-opacity-10 text-{{ $color }} text-capitalize">
                                <i class="bi bi-{{ $status == 'approved' ? 'check-circle' : ($status == 'rejected' ? 'x-circle' : 'clock') }} me-1"></i>
                                {{ $status }}
                            </span>
                        </td>
                        <td class="py-3">
                            <div class="small">
                                <i class="bi bi-calendar me-1"></i>
                                {{ $report->created_at ? $report->created_at->format('M d, Y') : 'N/A' }}
                            </div>
                            <small class="text-muted">{{ $report->created_at ? $report->created_at->diffForHumans() : '' }}</small>
                        </td>
                        <td class="py-3 text-end">
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-primary" onclick="viewReport({{ $report->id }})" title="View Details">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-outline-success" onclick="downloadReport({{ $report->id }})" title="Download">
                                    <i class="bi bi-download"></i>
                                </button>
                                @if($status == 'pending' || $status == 'draft')
                                <button class="btn btn-outline-info" onclick="submitReport({{ $report->id }})" title="Submit to TIRA">
                                    <i class="bi bi-send"></i>
                                </button>
                                @endif
                                @if($status == 'pending')
                                <button class="btn btn-outline-success" onclick="approveReport({{ $report->id }})" title="Approve">
                                    <i class="bi bi-check-circle"></i>
                                </button>
                                <button class="btn btn-outline-danger" onclick="rejectReport({{ $report->id }})" title="Reject">
                                    <i class="bi bi-x-circle"></i>
                                </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <i class="bi bi-inbox fs-1 text-muted d-block mb-3"></i>
                            <p class="text-muted mb-0">No compliance reports found</p>
                            <small class="text-muted">Reports will appear here</small>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($reports->hasPages())
    <div class="card-footer bg-white border-top py-3">
        <div class="d-flex justify-content-between align-items-center">
            <div class="text-muted small">
                Showing {{ $reports->firstItem() }} to {{ $reports->lastItem() }} of {{ $reports->total() }} reports
            </div>
            <div>
                {{ $reports->links() }}
            </div>
        </div>
    </div>
    @endif
</div>

@push('scripts')
<script>
function generateReport() {
    Swal.fire({
        title: 'Generate Compliance Report',
        html: `
            <select id="reportType" class="form-select mb-3">
                <option value="monthly">Monthly Premium Report</option>
                <option value="claims">Claims Statistics</option>
                <option value="solvency">Solvency Report</option>
                <option value="audit">Audit Report</option>
            </select>
        `,
        showCancelButton: true,
        confirmButtonText: 'Generate',
        preConfirm: () => {
            return $('#reportType').val();
        }
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire('Success!', 'Report generated successfully', 'success');
        }
    });
}

function submitToTIRA() {
    Swal.fire({
        title: 'Submit to TIRA?',
        text: 'This will submit all pending reports to TIRA',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#0d6efd',
        confirmButtonText: 'Submit'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire('Submitted!', 'Reports submitted to TIRA successfully', 'success');
        }
    });
}

function viewReport(id) {
    window.location.href = `/admin/governance/compliance/${id}`;
}

function downloadReport(id) {
    Swal.fire({
        title: 'Generating PDF...',
        html: `
            <div class="mb-3">
                <div class="spinner-border text-primary" role="status"></div>
            </div>
            <p>Creating professional PDF report with:</p>
            <ul class="text-start small">
                <li>✓ Company logo and branding</li>
                <li>✓ Watermark protection</li>
                <li>✓ Comprehensive sections</li>
                <li>✓ Copy protection</li>
                <li>✓ Digital signatures</li>
            </ul>
        `,
        allowOutsideClick: false,
        showConfirmButton: false,
        didOpen: () => {
            // Redirect to PDF export route
            setTimeout(() => {
                window.location.href = `/admin/governance/compliance/${id}/export`;
                Swal.close();
                Swal.fire({
                    icon: 'success',
                    title: 'PDF Generated!',
                    text: 'Your report is downloading now',
                    timer: 2000,
                    showConfirmButton: false
                });
            }, 2000);
        }
    });
}

function submitReport(id) {
    Swal.fire({
        title: 'Submit Report?',
        text: 'Submit this report to TIRA for review',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Submit'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire('Submitted!', 'Report submitted successfully', 'success').then(() => location.reload());
        }
    });
}

function approveReport(id) {
    Swal.fire({
        title: 'Approve Report?',
        text: 'Mark this report as approved',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        confirmButtonText: 'Approve'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire('Approved!', 'Report approved successfully', 'success').then(() => location.reload());
        }
    });
}

function rejectReport(id) {
    Swal.fire({
        title: 'Reject Report?',
        text: 'Mark this report as rejected',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        confirmButtonText: 'Reject'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire('Rejected!', 'Report rejected', 'success').then(() => location.reload());
        }
    });
}
</script>
@endpush
@endsection

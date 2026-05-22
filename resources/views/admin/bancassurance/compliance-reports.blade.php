@extends('layouts.dashboard')

@section('dashboard_content')
<div class="container-fluid py-4">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">Compliance & Reports</h1>
            <p class="text-muted mb-0">Generate and manage compliance reports</p>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-outline-primary" onclick="generateReport()">
                <i class="bi bi-file-earmark-plus me-2"></i>Generate Report
            </button>
            <button class="btn btn-primary" onclick="exportAll()">
                <i class="bi bi-download me-2"></i>Export All
            </button>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-primary bg-opacity-10 rounded-3 p-3">
                                <i class="bi bi-file-earmark-text text-primary fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Total Reports</h6>
                            <h4 class="mb-0 fw-bold">{{ $reports->total() }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-success bg-opacity-10 rounded-3 p-3">
                                <i class="bi bi-check-circle text-success fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Completed</h6>
                            <h4 class="mb-0 fw-bold">{{ $reports->where('status', 'completed')->count() }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-warning bg-opacity-10 rounded-3 p-3">
                                <i class="bi bi-clock text-warning fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Pending</h6>
                            <h4 class="mb-0 fw-bold">{{ $reports->where('status', 'pending')->count() }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-info bg-opacity-10 rounded-3 p-3">
                                <i class="bi bi-calendar text-info fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">This Month</h6>
                            <h4 class="mb-0 fw-bold">{{ $reports->where('date', '>=', date('Y-m-01'))->count() }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reports Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-semibold">Report History</h5>
                <div class="input-group" style="width: 300px;">
                    <span class="input-group-text bg-light border-0">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" class="form-control border-0 bg-light" placeholder="Search reports...">
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th class="border-0 py-3 px-4">Report Type</th>
                            <th class="border-0 py-3">Period</th>
                            <th class="border-0 py-3">Status</th>
                            <th class="border-0 py-3">Generated By</th>
                            <th class="border-0 py-3">Date</th>
                            <th class="border-0 py-3 text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reports as $report)
                        <tr>
                            <td class="py-3 px-4">
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                        <i class="bi bi-file-earmark-text text-primary"></i>
                                    </div>
                                    <div>
                                        <div class="fw-semibold">{{ $report['report_type'] }}</div>
                                        <small class="text-muted">ID: #{{ $report['id'] }}</small>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3">
                                <span class="badge bg-info bg-opacity-10 text-info">{{ $report['period'] }}</span>
                            </td>
                            <td class="py-3">
                                @if($report['status'] == 'completed')
                                    <span class="badge bg-success bg-opacity-10 text-success">
                                        <i class="bi bi-check-circle me-1"></i>Completed
                                    </span>
                                @else
                                    <span class="badge bg-warning bg-opacity-10 text-warning">
                                        <i class="bi bi-clock me-1"></i>Pending
                                    </span>
                                @endif
                            </td>
                            <td class="py-3">
                                <small class="text-muted">{{ $report['generated_by'] }}</small>
                            </td>
                            <td class="py-3">
                                <small class="text-muted">{{ $report['date'] }}</small>
                            </td>
                            <td class="py-3 text-end">
                                <div class="btn-group btn-group-sm">
                                    <button class="btn btn-outline-primary" onclick="viewReport({{ $report['id'] }})" title="View Report">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button class="btn btn-outline-success" onclick="downloadReport({{ $report['id'] }})" title="Download">
                                        <i class="bi bi-download"></i>
                                    </button>
                                    <button class="btn btn-outline-secondary" onclick="shareReport({{ $report['id'] }})" title="Share">
                                        <i class="bi bi-share"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <i class="bi bi-inbox fs-1 text-muted d-block mb-3"></i>
                                <p class="text-muted mb-0">No reports found</p>
                                <small class="text-muted">Generate your first report to get started</small>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($reports->hasPages())
        <div class="card-footer bg-white border-0 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">Showing {{ $reports->firstItem() }} to {{ $reports->lastItem() }} of {{ $reports->total() }} reports</small>
                <div>
                    {{ $reports->links() }}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
function generateReport() {
    Swal.fire({
        title: 'Generate New Report',
        html: `
            <div class="text-start">
                <div class="mb-3">
                    <label class="form-label">Report Type</label>
                    <select id="reportType" class="form-select">
                        <option>Monthly Sales Report</option>
                        <option>Bank Performance Report</option>
                        <option>Commission Report</option>
                        <option>Compliance Audit</option>
                        <option>Customer Analysis</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Period</label>
                    <select id="period" class="form-select">
                        <option>This Month</option>
                        <option>Last Month</option>
                        <option>This Quarter</option>
                        <option>This Year</option>
                        <option>Custom Range</option>
                    </select>
                </div>
            </div>
        `,
        showCancelButton: true,
        confirmButtonText: 'Generate',
        preConfirm: () => {
            return {
                type: document.getElementById('reportType').value,
                period: document.getElementById('period').value
            };
        }
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire('Success!', 'Report generated successfully', 'success');
        }
    });
}

function viewReport(id) {
    Swal.fire({
        title: 'Report Details',
        text: 'Viewing report details for ID: ' + id,
        icon: 'info'
    });
}

function downloadReport(id) {
    Swal.fire({
        title: 'Downloading...',
        html: '<div class="spinner-border text-primary" role="status"></div>',
        allowOutsideClick: false,
        showConfirmButton: false,
        didOpen: () => {
            setTimeout(() => {
                Swal.fire('Success!', 'Report downloaded successfully', 'success');
            }, 1500);
        }
    });
}

function shareReport(id) {
    Swal.fire({
        title: 'Share Report',
        text: 'Share report via email for ID: ' + id,
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Share'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire('Success!', 'Report shared successfully', 'success');
        }
    });
}

function exportAll() {
    Swal.fire({
        title: 'Exporting All Reports...',
        html: '<div class="spinner-border text-primary" role="status"></div>',
        allowOutsideClick: false,
        showConfirmButton: false,
        didOpen: () => {
            setTimeout(() => {
                Swal.fire('Success!', 'All reports exported successfully', 'success');
            }, 2000);
        }
    });
}
</script>
@endpush
@endsection

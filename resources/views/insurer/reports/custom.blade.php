@extends('layouts.dashboard')

@section('content')
<div class="container-fluid py-4">
    @include('insurer._partials.page-header', [
        'title' => 'Custom Reports',
        'subtitle' => 'Create and manage custom report templates',
        'icon' => 'bi-gear-fill'
    ])

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-file-earmark-plus-fill text-primary fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Custom Reports</h6>
                            <h4 class="mb-0 fw-bold">{{ $reports->total() ?? 0 }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-success bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-check-circle-fill text-success fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Active</h6>
                            <h4 class="mb-0 fw-bold">0</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-warning bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-clock-fill text-warning fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Scheduled</h6>
                            <h4 class="mb-0 fw-bold">0</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-info bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-download-fill text-info fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Total Runs</h6>
                            <h4 class="mb-0 fw-bold">0</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white border-0 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Create Custom Report</h5>
            </div>
        </div>
        <div class="card-body">
            <form>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Report Name</label>
                        <input type="text" class="form-control" placeholder="Enter report name">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Data Source</label>
                        <select class="form-select">
                            <option>Policies</option>
                            <option>Claims</option>
                            <option>Customers</option>
                            <option>Payments</option>
                            <option>Commissions</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Date Range</label>
                        <select class="form-select">
                            <option>Last 7 Days</option>
                            <option>Last 30 Days</option>
                            <option>Last 90 Days</option>
                            <option>This Year</option>
                            <option>Custom Range</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Group By</label>
                        <select class="form-select">
                            <option>Daily</option>
                            <option>Weekly</option>
                            <option>Monthly</option>
                            <option>Quarterly</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Output Format</label>
                        <select class="form-select">
                            <option>PDF</option>
                            <option>Excel</option>
                            <option>CSV</option>
                        </select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label fw-semibold">Select Fields</label>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" checked>
                                    <label class="form-check-label">ID</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" checked>
                                    <label class="form-check-label">Date</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" checked>
                                    <label class="form-check-label">Amount</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox">
                                    <label class="form-check-label">Status</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox">
                                    <label class="form-check-label">Customer</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox">
                                    <label class="form-check-label">Product</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox">
                                    <label class="form-check-label">Region</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox">
                                    <label class="form-check-label">Channel</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> Save Report Template
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Saved Custom Reports</h5>
                <button class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-lg me-1"></i> New Report
                </button>
            </div>
        </div>
        <div class="card-body">
            @if($reports->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Report Name</th>
                                <th>Data Source</th>
                                <th>Created By</th>
                                <th>Last Run</th>
                                <th>Schedule</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reports as $report)
                                <tr>
                                    <td class="fw-bold">{{ $report->name ?? 'N/A' }}</td>
                                    <td>{{ $report->data_source ?? 'N/A' }}</td>
                                    <td>{{ $report->created_by ?? 'N/A' }}</td>
                                    <td>{{ $report->last_run_at?->format('M d, Y H:i') ?? 'Never' }}</td>
                                    <td>{{ $report->schedule ?? 'Manual' }}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <button class="btn btn-outline-primary"><i class="bi bi-play-fill"></i></button>
                                            <button class="btn btn-outline-secondary"><i class="bi bi-pencil"></i></button>
                                            <button class="btn btn-outline-danger"><i class="bi bi-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $reports->links() }}
            @else
                @include('insurer._partials.empty-state', [
                    'icon' => 'bi-gear-fill',
                    'title' => 'No Custom Reports',
                    'text' => 'No custom reports have been created yet. Use the form above to create one.'
                ])
            @endif
        </div>
    </div>
</div>
@endsection

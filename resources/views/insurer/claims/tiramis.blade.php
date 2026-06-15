@extends('layouts.dashboard')

@section('content')
<div class="container-fluid py-4">
    @include('insurer._partials.page-header', [
        'title' => 'TIR-AMIS Exports',
        'subtitle' => 'Manage TIR-AMIS regulatory data exports',
        'icon' => 'bi-file-earmark-spreadsheet'
    ])

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-file-earmark-text-fill text-primary fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Total Exports</h6>
                            <h4 class="mb-0 fw-bold">{{ $stats['total'] ?? $reports->total() ?? 0 }}</h4>
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
                            <h6 class="mb-0 text-muted">Successful</h6>
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
                        <div class="bg-danger bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-x-circle-fill text-danger fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Failed</h6>
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
                            <h6 class="mb-0 text-muted">Pending</h6>
                            <h4 class="mb-0 fw-bold">0</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Export History</h5>
                <button class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-lg me-1"></i> New Export
                </button>
            </div>
        </div>
        <div class="card-body">
            @if($exports->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Export ID</th>
                                <th>Report Type</th>
                                <th>Period</th>
                                <th>Records</th>
                                <th>Status</th>
                                <th>Submitted Date</th>
                                <th>Response Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($exports as $export)
                                <tr>
                                    <td><span class="fw-bold">#{{ $export->id ?? '-' }}</span></td>
                                    <td>{{ $export->report_type ?? 'N/A' }}</td>
                                    <td>{{ $export->period ?? 'N/A' }}</td>
                                    <td>{{ $export->record_count ?? 0 }}</td>
                                    <td>
                                        @if($export->status === 'completed')
                                            <span class="badge bg-success">Completed</span>
                                        @elseif($export->status === 'failed')
                                            <span class="badge bg-danger">Failed</span>
                                        @elseif($export->status === 'pending')
                                            <span class="badge bg-warning">Pending</span>
                                        @else
                                            <span class="badge bg-secondary">{{ $export->status ?? 'Unknown' }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $export->submitted_at?->format('M d, Y H:i') ?? 'N/A' }}</td>
                                    <td>{{ $export->response_at?->format('M d, Y H:i') ?? '-' }}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <button class="btn btn-outline-primary"><i class="bi bi-eye"></i></button>
                                            <button class="btn btn-outline-secondary"><i class="bi bi-download"></i></button>
                                            <button class="btn btn-outline-info"><i class="bi bi-arrow-repeat"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $exports->links() }}
            @else
                @include('insurer._partials.empty-state', [
                    'icon' => 'bi-file-earmark-spreadsheet',
                    'title' => 'No Exports Found',
                    'text' => 'No TIR-AMIS exports have been generated yet.'
                ])
            @endif
        </div>
    </div>
</div>
@endsection

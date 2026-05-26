@extends('layouts.dashboard')

@section('content')
<div class="container-fluid py-4">
    @include('insurer._partials.page-header', [
        'title' => 'KYC Submissions',
        'subtitle' => 'Review and verify customer KYC documents',
        'icon' => 'bi-shield-check'
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
                            <h6 class="mb-0 text-muted">Total Submissions</h6>
                            <h4 class="mb-0 fw-bold">{{ $kyc->total() ?? 0 }}</h4>
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
                            <h6 class="mb-0 text-muted">Pending Review</h6>
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
                        <div class="bg-success bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-check-circle-fill text-success fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Verified</h6>
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
                            <h6 class="mb-0 text-muted">Rejected</h6>
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
                <h5 class="mb-0">KYC Submissions</h5>
                <div class="btn-group btn-group-sm">
                    <button class="btn btn-outline-primary"><i class="bi bi-download me-1"></i> Export</button>
                    <button class="btn btn-outline-secondary"><i class="bi bi-funnel me-1"></i> Filter</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if($kyc->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Submission ID</th>
                                <th>Customer</th>
                                <th>Document Type</th>
                                <th>Document Number</th>
                                <th>Submitted Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kyc as $submission)
                                <tr>
                                    <td><span class="fw-bold">#{{ $submission->id ?? '-' }}</span></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 35px; height: 35px;">
                                                <i class="bi bi-person-fill text-muted"></i>
                                            </div>
                                            <div>
                                                <div class="fw-bold">{{ $submission->customer->name ?? 'N/A' }}</div>
                                                <small class="text-muted">{{ $submission->customer->email ?? '' }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $submission->document_type ?? 'N/A' }}</td>
                                    <td>{{ $submission->document_number ?? 'N/A' }}</td>
                                    <td>{{ $submission->submitted_at?->format('M d, Y H:i') ?? 'N/A' }}</td>
                                    <td>
                                        @if($submission->status === 'verified')
                                            <span class="badge bg-success">Verified</span>
                                        @elseif($submission->status === 'pending')
                                            <span class="badge bg-warning">Pending</span>
                                        @elseif($submission->status === 'rejected')
                                            <span class="badge bg-danger">Rejected</span>
                                        @else
                                            <span class="badge bg-secondary">{{ $submission->status ?? 'Unknown' }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <button class="btn btn-outline-primary"><i class="bi bi-eye"></i></button>
                                            <button class="btn btn-outline-success"><i class="bi bi-check"></i></button>
                                            <button class="btn btn-outline-danger"><i class="bi bi-x"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $kyc->links() }}
            @else
                @include('insurer._partials.empty-state', [
                    'icon' => 'bi-shield-check',
                    'title' => 'No KYC Submissions',
                    'text' => 'No KYC submissions have been received yet.'
                ])
            @endif
        </div>
    </div>
</div>
@endsection

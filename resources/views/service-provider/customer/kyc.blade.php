@extends('layouts.dashboard')

@section('content')
<div class="container-fluid py-4">
    @include('service-provider._partials.page-header', [
        'title' => 'KYC Documents',
        'subtitle' => 'View customer KYC verification documents',
        'action' => '<a href="{{ route('service-provider.customer.show', $customer->id ?? 0) }}" class="btn btn-outline-primary"><i class="bi bi-arrow-left me-1"></i> Back to Profile</a>'
    ])

    @if($customer)
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                        <i class="bi bi-person-fill text-primary fs-3"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0">{{ $customer->name ?? 'N/A' }}</h5>
                        <p class="text-muted mb-0">{{ $customer->nin ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 py-3">
                <h5 class="mb-0">KYC Documents</h5>
            </div>
            <div class="card-body">
                @if($documents->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Document Type</th>
                                    <th>File Name</th>
                                    <th>Uploaded At</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($documents as $document)
                                    <tr>
                                        <td>{{ $document->document_type ?? 'N/A' }}</td>
                                        <td>{{ $document->file_name ?? 'N/A' }}</td>
                                        <td>{{ $document->created_at?->format('M d, Y H:i') ?? 'N/A' }}</td>
                                        <td>
                                            @if($document->status === 'verified')
                                                <span class="badge bg-success">Verified</span>
                                            @elseif($document->status === 'pending')
                                                <span class="badge bg-warning">Pending</span>
                                            @elseif($document->status === 'rejected')
                                                <span class="badge bg-danger">Rejected</span>
                                            @else
                                                <span class="badge bg-secondary">{{ $document->status }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ asset('uploads/kyc/' . $document->file_path) }}" target="_blank" class="btn btn-outline-primary"><i class="bi bi-eye"></i></a>
                                                <a href="{{ asset('uploads/kyc/' . $document->file_path) }}" download class="btn btn-outline-secondary"><i class="bi bi-download"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $documents->links() }}
                @else
                    @include('service-provider._partials.empty-state', [
                        'icon' => 'bi-file-earmark-text',
                        'title' => 'No KYC Documents',
                        'text' => 'No KYC documents have been uploaded yet.'
                    ])
                @endif
            </div>
        </div>
    @else
        @include('service-provider._partials.empty-state', [
            'icon' => 'bi-person',
            'title' => 'Customer Not Found',
            'text' => 'The requested customer could not be found.'
        ])
    @endif
</div>
@endsection

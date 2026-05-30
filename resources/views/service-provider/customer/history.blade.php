@extends('layouts.dashboard')

@section('content')
<div class="container-fluid py-4">
    @include('service-provider._partials.page-header', [
        'title' => 'Verification History',
        'subtitle' => 'View customer verification and KYC history',
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
                <h5 class="mb-0">Verification History</h5>
            </div>
            <div class="card-body">
                @if($history->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Date</th>
                                    <th>Action</th>
                                    <th>Status</th>
                                    <th>Notes</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($history as $record)
                                    <tr>
                                        <td>{{ $record->created_at?->format('M d, Y H:i') ?? 'N/A' }}</td>
                                        <td>{{ $record->action ?? 'N/A' }}</td>
                                        <td>
                                            @if($record->status === 'completed')
                                                <span class="badge bg-success">Completed</span>
                                            @elseif($record->status === 'pending')
                                                <span class="badge bg-warning">Pending</span>
                                            @elseif($record->status === 'failed')
                                                <span class="badge bg-danger">Failed</span>
                                            @else
                                                <span class="badge bg-secondary">{{ $record->status }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $record->notes ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $history->links() }}
                @else
                    @include('service-provider._partials.empty-state', [
                        'icon' => 'bi-clock-history',
                        'title' => 'No History',
                        'text' => 'No verification history found for this customer.'
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

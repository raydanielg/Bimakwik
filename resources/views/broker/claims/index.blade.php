@extends('layouts.dashboard')

@section('dashboard_content')
<div class="container-fluid py-4">
    @include('broker._partials.page-header', [
        'title' => 'Claims',
        'subtitle' => 'Track and manage insurance claims',
        'icon' => 'bi-file-earmark-medical'
    ])

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">All Claims</h5>
                <div class="btn-group btn-group-sm">
                    <button class="btn btn-outline-primary"><i class="bi bi-download me-1"></i> Export</button>
                    <button class="btn btn-outline-secondary"><i class="bi bi-funnel me-1"></i> Filter</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if($claims->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Claim ID</th>
                                <th>Customer</th>
                                <th>Policy</th>
                                <th>Amount</th>
                                <th>Date Filed</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($claims as $claim)
                                <tr>
                                    <td><span class="fw-bold">#{{ $claim->id ?? '-' }}</span></td>
                                    <td>{{ $claim->customer->name ?? 'N/A' }}</td>
                                    <td>{{ $claim->policy_number ?? 'N/A' }}</td>
                                    <td class="fw-bold">TZS {{ number_format($claim->amount ?? 0, 0) }}</td>
                                    <td>{{ $claim->created_at?->format('M d, Y') ?? 'N/A' }}</td>
                                    <td>
                                        @if($claim->status === 'approved')
                                            <span class="badge bg-success">Approved</span>
                                        @elseif($claim->status === 'pending')
                                            <span class="badge bg-warning">Pending</span>
                                        @elseif($claim->status === 'rejected')
                                            <span class="badge bg-danger">Rejected</span>
                                        @else
                                            <span class="badge bg-secondary">{{ $claim->status ?? 'Unknown' }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <button class="btn btn-outline-primary"><i class="bi bi-eye"></i></button>
                                            <button class="btn btn-outline-secondary"><i class="bi bi-pencil"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $claims->links() }}
            @else
                @include('broker._partials.empty-state', [
                    'icon' => 'bi-file-earmark-medical',
                    'title' => 'No Claims Found',
                    'text' => 'No claims have been filed yet.'
                ])
            @endif
        </div>
    </div>
</div>
@endsection


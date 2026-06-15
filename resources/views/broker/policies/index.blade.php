@extends('layouts.dashboard')

@section('dashboard_content')
<div class="container-fluid py-4">
    @include('broker._partials.page-header', [
        'title' => 'Policies',
        'subtitle' => 'Manage all insurance policies',
        'icon' => 'bi-shield-check'
    ])

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">All Policies</h5>
                <button class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-lg me-1"></i> New Policy
                </button>
            </div>
        </div>
        <div class="card-body">
            @if($policies->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Policy Number</th>
                                <th>Customer</th>
                                <th>Product</th>
                                <th>Premium</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($policies as $policy)
                                <tr>
                                    <td><span class="fw-bold">{{ $policy->policy_number ?? 'POL-' . $policy->id }}</span></td>
                                    <td>{{ $policy->customer->name ?? 'N/A' }}</td>
                                    <td>{{ $policy->product->product_name ?? 'N/A' }}</td>
                                    <td class="fw-bold">TZS {{ number_format($policy->premium_amount ?? 0, 0) }}</td>
                                    <td>{{ $policy->start_date?->format('M d, Y') ?? 'N/A' }}</td>
                                    <td>{{ $policy->end_date?->format('M d, Y') ?? 'N/A' }}</td>
                                    <td>
                                        @if($policy->status === 'active')
                                            <span class="badge bg-success">Active</span>
                                        @elseif($policy->status === 'expired')
                                            <span class="badge bg-danger">Expired</span>
                                        @else
                                            <span class="badge bg-secondary">{{ $policy->status ?? 'Unknown' }}</span>
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
                {{ $policies->links() }}
            @else
                @include('broker._partials.empty-state', [
                    'icon' => 'bi-shield-check',
                    'title' => 'No Policies Found',
                    'text' => 'There are no policies recorded yet.'
                ])
            @endif
        </div>
    </div>
</div>
@endsection


@extends('layouts.dashboard')

@section('content')
<div class="container-fluid py-4">
    @include('service-provider._partials.page-header', [
        'title' => 'Customer Profile',
        'subtitle' => 'View customer details and policy information',
        'action' => '<a href="{{ route('service-provider.customer.list') }}" class="btn btn-outline-primary"><i class="bi bi-arrow-left me-1"></i> Back to List</a>'
    ])

    @if($customer)
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 100px; height: 100px;">
                            <i class="bi bi-person-fill text-primary fs-1"></i>
                        </div>
                        <h5 class="fw-bold mb-1">{{ $customer->name ?? 'N/A' }}</h5>
                        <p class="text-muted mb-3">{{ $customer->nin ?? 'N/A' }}</p>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('service-provider.customer.kyc', $customer->id) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-file-earmark-text me-1"></i> KYC
                            </a>
                            <a href="{{ route('service-provider.customer.history', $customer->id) }}" class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-clock-history me-1"></i> History
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="fw-bold mb-4">Contact Information</h6>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block mb-1">Phone</small>
                                <strong>{{ $customer->phone ?? 'N/A' }}</strong>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block mb-1">Email</small>
                                <strong>{{ $customer->email ?? 'N/A' }}</strong>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block mb-1">Address</small>
                                <strong>{{ $customer->address ?? 'N/A' }}</strong>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block mb-1">Date of Birth</small>
                                <strong>{{ $customer->dob ?? 'N/A' }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 py-3">
                <h5 class="mb-0">Policies</h5>
            </div>
            <div class="card-body">
                @if($policies->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Policy Number</th>
                                    <th>Product</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Premium</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($policies as $policy)
                                    <tr>
                                        <td class="fw-bold">{{ $policy->policy_number ?? 'N/A' }}</td>
                                        <td>{{ $policy->product->product_name ?? 'N/A' }}</td>
                                        <td>{{ $policy->start_date?->format('M d, Y') ?? 'N/A' }}</td>
                                        <td>{{ $policy->end_date?->format('M d, Y') ?? 'N/A' }}</td>
                                        <td>TZS {{ number_format($policy->premium_amount ?? 0, 0) }}</td>
                                        <td>
                                            @if($policy->status === 'active')
                                                <span class="badge bg-success">Active</span>
                                            @elseif($policy->status === 'expired')
                                                <span class="badge bg-danger">Expired</span>
                                            @else
                                                <span class="badge bg-secondary">{{ $policy->status }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    @include('service-provider._partials.empty-state', [
                        'icon' => 'bi-shield',
                        'title' => 'No Policies',
                        'text' => 'This customer has no policies yet.'
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

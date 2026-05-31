@extends('layouts.dashboard')

@section('content')
<div class="container-fluid py-4">
    @include('service-provider._partials.page-header', [
        'title' => 'Customer Verification',
        'subtitle' => 'Verify customer policy coverage and eligibility'
    ])

    <div class="row">
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm p-4 h-100">
                <h6 class="fw-bold mb-4">Verify Policy</h6>
                <form action="{{ route('service-provider.customer.verify.submit') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Policy Number</label>
                        <input type="text" name="policy_number" class="form-control" placeholder="Enter policy number" value="{{ old('policy_number') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Customer ID / NIN</label>
                        <input type="text" name="customer_id" class="form-control" placeholder="Enter customer ID or NIN" value="{{ old('customer_id') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Phone Number</label>
                        <input type="text" name="phone_number" class="form-control" placeholder="Enter phone number" value="{{ old('phone_number') }}">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search me-2"></i> Verify Customer
                    </button>
                </form>
            </div>
        </div>
        
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm p-4 h-100">
                <h6 class="fw-bold mb-4">Verification Result</h6>
                @if($customer && $policy)
                    <div class="alert alert-success d-flex align-items-center mb-4">
                        <i class="bi bi-check-circle-fill fs-4 me-3"></i>
                        <div>
                            <strong>Customer Verified</strong>
                            <div class="small">Policy is active and valid</div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="bg-light rounded p-3 mb-3">
                                <small class="text-muted d-block mb-1">Customer Name</small>
                                <strong>{{ $customer->name ?? 'N/A' }}</strong>
                            </div>
                            <div class="bg-light rounded p-3 mb-3">
                                <small class="text-muted d-block mb-1">NIN</small>
                                <strong>{{ $customer->nin ?? 'N/A' }}</strong>
                            </div>
                            <div class="bg-light rounded p-3">
                                <small class="text-muted d-block mb-1">Phone</small>
                                <strong>{{ $customer->phone ?? 'N/A' }}</strong>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bg-light rounded p-3 mb-3">
                                <small class="text-muted d-block mb-1">Policy Number</small>
                                <strong>{{ $policy->policy_number ?? 'N/A' }}</strong>
                            </div>
                            <div class="bg-light rounded p-3 mb-3">
                                <small class="text-muted d-block mb-1">Product</small>
                                <strong>{{ $policy->product->product_name ?? 'N/A' }}</strong>
                            </div>
                            <div class="bg-light rounded p-3">
                                <small class="text-muted d-block mb-1">Status</small>
                                <span class="badge bg-success">Active</span>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <a href="{{ route('service-provider.customer.show', $customer->id) }}" class="btn btn-outline-primary flex-fill">
                            <i class="bi bi-person me-1"></i> View Profile
                        </a>
                        <a href="{{ route('service-provider.customer.kyc', $customer->id) }}" class="btn btn-outline-secondary flex-fill">
                            <i class="bi bi-file-earmark-text me-1"></i> KYC Documents
                        </a>
                    </div>
                @elseif($customer && !$policy)
                    <div class="alert alert-warning d-flex align-items-center mb-4">
                        <i class="bi bi-exclamation-triangle-fill fs-4 me-3"></i>
                        <div>
                            <strong>Customer Found - No Active Policy</strong>
                            <div class="small">Customer exists but has no active policies</div>
                        </div>
                    </div>
                    <div class="bg-light rounded p-3 mb-3">
                        <small class="text-muted d-block mb-1">Customer Name</small>
                        <strong>{{ $customer->name ?? 'N/A' }}</strong>
                    </div>
                @else
                    <div class="text-center py-5">
                        <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                            <i class="bi bi-search text-muted fs-2"></i>
                        </div>
                        <h5 class="fw-bold mb-2">No Verification Result</h5>
                        <p class="text-muted mb-0">Enter customer details above to verify policy coverage.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

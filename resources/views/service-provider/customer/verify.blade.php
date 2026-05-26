@extends('layouts.dashboard')

@section('content')
<div class="container-fluid py-4">
    @include('service-provider._partials.page-header', [
        'title' => 'Customer Verification',
        'subtitle' => 'Verify customer policy coverage and eligibility',
        'icon' => 'bi-person-vcard'
    ])

    <div class="row">
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm p-4 h-100">
                <h6 class="fw-bold mb-4">Verify Policy</h6>
                <form>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Policy Number</label>
                        <input type="text" class="form-control" placeholder="Enter policy number">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Customer ID / NIN</label>
                        <input type="text" class="form-control" placeholder="Enter customer ID or NIN">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Phone Number</label>
                        <input type="text" class="form-control" placeholder="Enter phone number">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search me-2"></i> Verify Customer
                    </button>
                </form>
            </div>
        </div>
        
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm p-4 h-100">
                <h6 class="fw-bold mb-4">Verification Result</h6>
                <div class="text-center py-5">
                    <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="bi bi-search text-muted fs-2"></i>
                    </div>
                    <h5 class="fw-bold mb-2">No Verification Result</h5>
                    <p class="text-muted mb-0">Enter customer details above to verify policy coverage.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

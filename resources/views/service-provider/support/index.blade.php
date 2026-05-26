@extends('layouts.dashboard')

@section('content')
<div class="container-fluid py-4">
    @include('service-provider._partials.page-header', [
        'title' => 'Support',
        'subtitle' => 'Get help and support',
        'icon' => 'bi-headset'
    ])

    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm p-4 h-100">
                <h6 class="fw-bold mb-4">Submit a Support Request</h6>
                <form>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Subject</label>
                        <input type="text" class="form-control" placeholder="Enter subject">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Category</label>
                        <select class="form-select">
                            <option>Billing Issue</option>
                            <option>Technical Issue</option>
                            <option>Policy Verification</option>
                            <option>Other</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Description</label>
                        <textarea class="form-control" rows="4" placeholder="Describe your issue"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Attachments</label>
                        <input type="file" class="form-control" multiple>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-send me-1"></i> Submit Request
                    </button>
                </form>
            </div>
        </div>
        
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm p-4 h-100">
                <h6 class="fw-bold mb-4">Contact Information</h6>
                <div class="mb-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                            <i class="bi bi-telephone-fill text-primary"></i>
                        </div>
                        <div>
                            <div class="fw-bold">Phone Support</div>
                            <div class="text-muted">+255 123 456 789</div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-success bg-opacity-10 p-2 rounded me-3">
                            <i class="bi bi-envelope-fill text-success"></i>
                        </div>
                        <div>
                            <div class="fw-bold">Email Support</div>
                            <div class="text-muted">support@bimakwik.co.tz</div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="bg-info bg-opacity-10 p-2 rounded me-3">
                            <i class="bi bi-clock-fill text-info"></i>
                        </div>
                        <div>
                            <div class="fw-bold">Working Hours</div>
                            <div class="text-muted">Mon - Fri: 8:00 AM - 5:00 PM</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3">
            <h5 class="mb-0">Recent Support Requests</h5>
        </div>
        <div class="card-body">
            @include('service-provider._partials.empty-state', [
                'icon' => 'bi-headset',
                'title' => 'No Support Requests',
                'text' => 'You have not submitted any support requests yet.'
            ])
        </div>
    </div>
</div>
@endsection

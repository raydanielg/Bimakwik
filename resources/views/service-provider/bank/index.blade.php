@extends('layouts.dashboard')

@section('content')
<div class="container-fluid py-4">
    @include('service-provider._partials.page-header', [
        'title' => 'Bank Details',
        'subtitle' => 'Manage payment bank information',
        'icon' => 'bi-bank'
    ])

    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm p-4">
                <h6 class="fw-bold mb-4">Bank Information</h6>
                <form>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Bank Name</label>
                            <input type="text" class="form-control" placeholder="Enter bank name">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Account Name</label>
                            <input type="text" class="form-control" placeholder="Enter account name">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Account Number</label>
                            <input type="text" class="form-control" placeholder="Enter account number">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Branch</label>
                            <input type="text" class="form-control" placeholder="Enter branch name">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Swift Code</label>
                            <input type="text" class="form-control" placeholder="Enter swift code">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Tax ID (TIN)</label>
                            <input type="text" class="form-control" placeholder="Enter tax ID">
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i> Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm p-4 h-100">
                <h6 class="fw-bold mb-4">Payment Settings</h6>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Payment Method</label>
                    <select class="form-select">
                        <option>Bank Transfer</option>
                        <option>Mobile Money</option>
                        <option>Check</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Minimum Payment Amount</label>
                    <input type="text" class="form-control" placeholder="Enter minimum amount">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Payment Frequency</label>
                    <select class="form-select">
                        <option>Daily</option>
                        <option>Weekly</option>
                        <option>Monthly</option>
                    </select>
                </div>
                <div class="alert alert-info small">
                    <i class="bi bi-info-circle me-1"></i>
                    Payments will be processed according to your selected frequency.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

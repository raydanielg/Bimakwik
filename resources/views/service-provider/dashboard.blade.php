@extends('layouts.dashboard')

@section('dashboard_title', __('service_provider.dashboard_title'))

@section('dashboard_content')
<!-- Provider Stats -->
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card stat-card border-start border-4 border-primary">
            <div class="card-body">
                <div class="stat-label">{{ __('service_provider.bills_submitted') }}</div>
                <div class="stat-value">145</div>
                <div class="stat-trend text-primary"><i class="bi bi-file-earmark-text"></i> {{ __('service_provider.total_this_month') }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card border-start border-4 border-warning">
            <div class="card-body">
                <div class="stat-label">{{ __('service_provider.pending_approval') }}</div>
                <div class="stat-value">12</div>
                <div class="stat-trend text-warning"><i class="bi bi-clock"></i> {{ __('service_provider.needs_review') }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card border-start border-4 border-success">
            <div class="card-body">
                <div class="stat-label">{{ __('service_provider.paid_amount') }}</div>
                <div class="stat-value">TZS 12.5M</div>
                <div class="stat-trend text-success"><i class="bi bi-check-circle"></i> {{ __('service_provider.successfully_paid') }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card border-start border-4 border-danger">
            <div class="card-body">
                <div class="stat-label">{{ __('service_provider.rejected_bills') }}</div>
                <div class="stat-value">3</div>
                <div class="stat-trend text-danger"><i class="bi bi-x-octagon"></i> {{ __('service_provider.view_reasons') }}</div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Verification Quick Search -->
    <div class="col-lg-6">
        <div class="card p-4 h-100">
            <h6 class="fw-bold mb-4"><i class="bi bi-person-vcard me-2 text-primary"></i> {{ __('service_provider.quick_customer_verification') }}</h6>
            <form>
                <div class="mb-3">
                    <label class="form-label small fw-bold">{{ __('service_provider.policy_number_label') }}</label>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="{{ __('service_provider.verification_placeholder') }}">
                        <button class="btn btn-primary" type="button">{{ __('service_provider.verify') }}</button>
                    </div>
                </div>
                <div class="p-3 bg-light rounded-3 border border-dashed text-center small text-muted">
                    {{ __('service_provider.verification_note') }}
                </div>
            </form>
        </div>
    </div>
    
    <!-- Recent Bills Status -->
    <div class="col-lg-6">
        <div class="card p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h6 class="fw-bold mb-0">{{ __('service_provider.recent_bill_submissions') }}</h6>
                <a href="#" class="btn btn-sm btn-link text-decoration-none">{{ __('service_provider.view_all') }}</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle small">
                    <thead>
                        <tr>
                            <th>{{ __('service_provider.patient_motor') }}</th>
                            <th>{{ __('service_provider.bill_no') }}</th>
                            <th>{{ __('service_provider.amount') }}</th>
                            <th>{{ __('service_provider.status') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Juma Bakari</td>
                            <td>#INV-9901</td>
                            <td>45,000</td>
                            <td><span class="badge bg-warning-soft text-warning">{{ __('service_provider.pending') }}</span></td>
                        </tr>
                        <tr>
                            <td>Anna Peter</td>
                            <td>#INV-9850</td>
                            <td>120,000</td>
                            <td><span class="badge bg-success-soft text-success">{{ __('service_provider.approved') }}</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-success-soft { background-color: rgba(25, 135, 84, 0.1); }
    .bg-warning-soft { background-color: rgba(255, 193, 7, 0.1); }
</style>
@endsection

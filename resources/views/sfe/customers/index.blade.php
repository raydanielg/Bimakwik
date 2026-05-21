@extends('layouts.dashboard')

@section('dashboard_title', __('sfe.customers_title'))

@section('dashboard_content')
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-4 h-100">
            <div class="text-muted small text-uppercase">{{ __('sfe.total_customers') }}</div>
            <div class="fs-3 fw-bold">{{ $customers->count() }}</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-4 h-100">
            <div class="text-muted small text-uppercase">{{ __('sfe.kyc_pending') }}</div>
            <div class="fs-3 fw-bold">{{ $kycPendingCount }}</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-4 h-100">
            <div class="text-muted small text-uppercase">{{ __('sfe.kyc_approved') }}</div>
            <div class="fs-3 fw-bold">{{ $kycApprovedCount }}</div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold mb-0">{{ __('sfe.customer_portfolio') }}</h6>
                <a href="{{ route('sfe.customers.create') }}" class="btn btn-sm btn-primary">{{ __('sfe.add_customer') }}</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle small">
                    <thead class="table-light">
                        <tr>
                            <th>{{ __('sfe.customer_no') }}</th>
                            <th>{{ __('sfe.city') }}</th>
                            <th>{{ __('sfe.occupation') }}</th>
                            <th>{{ __('sfe.kyc') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($customers as $customer)
                            <tr>
                                <td class="fw-semibold">{{ $customer->customer_number }}</td>
                                <td>{{ $customer->city ?? '-' }}</td>
                                <td>{{ $customer->occupation ?? '-' }}</td>
                                <td><span class="badge bg-{{ $customer->kyc_status === 'approved' ? 'success' : 'warning' }}-soft text-{{ $customer->kyc_status === 'approved' ? 'success' : 'warning' }}">{{ ucfirst($customer->kyc_status) }}</span></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-muted">{{ __('sfe.no_customers_found_yet') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm p-4 h-100">
            <h6 class="fw-bold mb-3">{{ __('sfe.recent_kyc_submissions') }}</h6>
            <div class="list-group list-group-flush small">
                @forelse($recentKyc as $submission)
                    <div class="list-group-item px-0 d-flex justify-content-between align-items-center">
                        <span>#{{ $submission->id }}</span>
                        <span class="badge bg-info-soft text-info">{{ ucfirst($submission->status) }}</span>
                    </div>
                @empty
                    <div class="text-muted small">{{ __('sfe.no_kyc_activity_yet') }}</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.dashboard')

@section('dashboard_title', 'SFE Customers')

@section('dashboard_content')
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-4 h-100">
            <div class="text-muted small text-uppercase">Total Customers</div>
            <div class="fs-3 fw-bold">{{ $customers->count() }}</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-4 h-100">
            <div class="text-muted small text-uppercase">KYC Pending</div>
            <div class="fs-3 fw-bold">{{ $kycPendingCount }}</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-4 h-100">
            <div class="text-muted small text-uppercase">KYC Approved</div>
            <div class="fs-3 fw-bold">{{ $kycApprovedCount }}</div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold mb-0">Customer Portfolio</h6>
                <a href="{{ route('sfe.customers.create') }}" class="btn btn-sm btn-primary">Add Customer</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle small">
                    <thead class="table-light">
                        <tr>
                            <th>Customer No</th>
                            <th>City</th>
                            <th>Occupation</th>
                            <th>KYC</th>
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
                                <td colspan="4" class="text-muted">No customers found yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm p-4 h-100">
            <h6 class="fw-bold mb-3">Recent KYC Submissions</h6>
            <div class="list-group list-group-flush small">
                @forelse($recentKyc as $submission)
                    <div class="list-group-item px-0 d-flex justify-content-between align-items-center">
                        <span>#{{ $submission->id }}</span>
                        <span class="badge bg-info-soft text-info">{{ ucfirst($submission->status) }}</span>
                    </div>
                @empty
                    <div class="text-muted small">No KYC activity yet.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

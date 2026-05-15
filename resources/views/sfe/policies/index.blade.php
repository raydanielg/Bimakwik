@extends('layouts.dashboard')

@section('dashboard_title', 'SFE Policies')

@section('dashboard_content')
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-4 h-100">
            <div class="text-muted small text-uppercase">Policies</div>
            <div class="fs-3 fw-bold">{{ $policies->count() }}</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-4 h-100">
            <div class="text-muted small text-uppercase">Active Policies</div>
            <div class="fs-3 fw-bold">{{ $activePolicies }}</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-4 h-100">
            <div class="text-muted small text-uppercase">Premium Total</div>
            <div class="fs-3 fw-bold">TZS {{ number_format($totalPremiums, 2) }}</div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="fw-bold mb-0">Policy Sales</h6>
        <a href="{{ route('sfe.policies.buy') }}" class="btn btn-sm btn-primary">Buy Policy</a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle small">
            <thead class="table-light">
                <tr>
                    <th>Policy No</th>
                    <th>Product</th>
                    <th>Status</th>
                    <th>Premium</th>
                    <th>End Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($policies as $policy)
                    <tr>
                        <td class="fw-semibold">{{ $policy->policy_number }}</td>
                        <td>{{ $policy->insurance_product_id }}</td>
                        <td><span class="badge bg-success-soft text-success">{{ ucfirst($policy->status) }}</span></td>
                        <td>TZS {{ number_format($policy->premium_amount, 2) }}</td>
                        <td>{{ $policy->end_date }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-muted">No policies found yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

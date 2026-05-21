@extends('layouts.dashboard')

@section('dashboard_title', __('sfe.policies_title'))

@section('dashboard_content')
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-4 h-100">
            <div class="text-muted small text-uppercase">{{ __('sfe.policies_count') }}</div>
            <div class="fs-3 fw-bold">{{ $policies->count() }}</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-4 h-100">
            <div class="text-muted small text-uppercase">{{ __('sfe.active_policies') }}</div>
            <div class="fs-3 fw-bold">{{ $activePolicies }}</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-4 h-100">
            <div class="text-muted small text-uppercase">{{ __('sfe.premium_total') }}</div>
            <div class="fs-3 fw-bold">TZS {{ number_format($totalPremiums, 2) }}</div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="fw-bold mb-0">{{ __('sfe.policy_sales') }}</h6>
        <a href="{{ route('sfe.policies.buy') }}" class="btn btn-sm btn-primary">{{ __('sfe.buy_policy') }}</a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle small">
            <thead class="table-light">
                <tr>
                    <th>{{ __('sfe.policy_no') }}</th>
                    <th>{{ __('sfe.product') }}</th>
                    <th>{{ __('sfe.status') }}</th>
                    <th>{{ __('sfe.premium') }}</th>
                    <th>{{ __('sfe.end_date') }}</th>
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
                        <td colspan="5" class="text-muted">{{ __('sfe.no_policies_found_yet') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

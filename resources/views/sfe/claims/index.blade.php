@extends('layouts.dashboard')

@section('dashboard_title', __('sfe.claims_title'))

@section('dashboard_content')
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-4 h-100">
            <div class="text-muted small text-uppercase">{{ __('sfe.claims_count') }}</div>
            <div class="fs-3 fw-bold">{{ $claims->count() }}</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-4 h-100">
            <div class="text-muted small text-uppercase">{{ __('sfe.submitted') }}</div>
            <div class="fs-3 fw-bold">{{ $submittedClaims }}</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-4 h-100">
            <div class="text-muted small text-uppercase">{{ __('sfe.approved_value') }}</div>
            <div class="fs-3 fw-bold">TZS {{ number_format($approvedClaimsTotal ?? 0, 2) }}</div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="fw-bold mb-0">{{ __('sfe.claims_tracking') }}</h6>
        <a href="{{ route('sfe.claims.submit') }}" class="btn btn-sm btn-primary">{{ __('sfe.submit_claim_button') }}</a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle small">
            <thead class="table-light">
                <tr>
                    <th>{{ __('sfe.claim_no') }}</th>
                    <th>{{ __('sfe.type') }}</th>
                    <th>{{ __('sfe.status') }}</th>
                    <th>{{ __('sfe.claimed') }}</th>
                    <th>{{ __('sfe.approved') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($claims as $claim)
                    <tr>
                        <td class="fw-semibold">{{ $claim->claim_number }}</td>
                        <td>{{ $claim->claim_type }}</td>
                        <td><span class="badge bg-info-soft text-info">{{ ucfirst($claim->status) }}</span></td>
                        <td>TZS {{ number_format($claim->claimed_amount, 2) }}</td>
                        <td>TZS {{ number_format($claim->approved_amount ?? 0, 2) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-muted">{{ __('sfe.no_claims_found_yet') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

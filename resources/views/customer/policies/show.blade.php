@extends('layouts.dashboard')

@section('dashboard_title', __('customer.policy_details'))

@section('content')
@php
    $policy = $policy ?? null;
@endphp
@if($policy)
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <a href="{{ route('customer.policies.index') }}" class="btn btn-link text-decoration-none mb-2">
                <i class="bi bi-arrow-left me-1"></i> {{ __('customer.back_to_policies') }}
            </a>
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="fw-bold mb-1">{{ __('customer.policy_details') }}</h4>
                    <p class="text-muted small mb-0">{{ $policy->policy_number ?? 'N/A' }}</p>
                </div>
                <div>
                    @if(($policy->status ?? '') === 'active')
                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-4 py-2 fs-6">
                            <i class="bi bi-check-circle me-1"></i> Active
                        </span>
                    @elseif(($policy->status ?? '') === 'expired')
                        <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-4 py-2 fs-6">
                            <i class="bi bi-x-circle me-1"></i> Expired
                        </span>
                    @else
                        <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-4 py-2 fs-6">
                            <i class="bi bi-exclamation-circle me-1"></i> {{ ucfirst($policy->status ?? 'Unknown') }}
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Policy Info Card -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-0 p-4">
                    <h5 class="fw-bold mb-0"><i class="bi bi-shield-check me-2"></i>{{ __('customer.policy_information') }}</h5>
                </div>
                <div class="card-body p-4">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="small text-muted fw-bold">{{ __('customer.policy_name') }}</label>
                            <div class="fs-5 fw-bold text-primary">{{ $policy->product->product_name ?? 'N/A' }}</div>
                        </div>
                        <div class="col-md-6">
                            <label class="small text-muted fw-bold">{{ __('customer.policy_number') }}</label>
                            <div class="fs-5 fw-bold">{{ $policy->policy_number ?? 'N/A' }}</div>
                        </div>
                        <div class="col-md-6">
                            <label class="small text-muted fw-bold">{{ __('customer.provider') }}</label>
                            <div class="fs-5 fw-bold">{{ $policy->insurer->insurer_name ?? 'N/A' }}</div>
                        </div>
                        <div class="col-md-6">
                            <label class="small text-muted fw-bold">{{ __('customer.payment_method') }}</label>
                            <div class="fs-5 fw-bold">
                                <i class="bi bi-wallet2 me-1"></i> {{ ucfirst($policy->payment_method ?? 'N/A') }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="small text-muted fw-bold">{{ __('customer.start_date') }}</label>
                            <div class="fs-5 fw-bold">{{ $policy->start_date ? $policy->start_date->format('d M Y') : 'N/A' }}</div>
                        </div>
                        <div class="col-md-6">
                            <label class="small text-muted fw-bold">{{ __('customer.end_date') }}</label>
                            <div class="fs-5 fw-bold text-danger">{{ $policy->end_date ? $policy->end_date->format('d M Y') : 'N/A' }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Coverage Details -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-0 p-4">
                    <h5 class="fw-bold mb-0"><i class="bi bi-cash-coin me-2"></i>{{ __('customer.coverage_details') }}</h5>
                </div>
                <div class="card-body p-4">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="small text-muted fw-bold">{{ __('customer.premium_amount') }}</label>
                            <div class="fs-4 fw-bold text-success">TZS {{ number_format($policy->premium_amount ?? 0, 0) }}</div>
                        </div>
                        <div class="col-md-6">
                            <label class="small text-muted fw-bold">{{ __('customer.premium_frequency') }}</label>
                            <div class="fs-4 fw-bold">{{ ucfirst($policy->premium_frequency ?? 'N/A') }}</div>
                        </div>
                        <div class="col-md-6">
                            <label class="small text-muted fw-bold">{{ __('customer.sum_assured') }}</label>
                            <div class="fs-4 fw-bold text-primary">TZS {{ number_format($policy->sum_assured ?? 0, 0) }}</div>
                        </div>
                        <div class="col-md-6">
                            <label class="small text-muted fw-bold">{{ __('customer.days_remaining') }}</label>
                            <div class="fs-4 fw-bold">
                                @if($policy->end_date)
                                    @php
                                        $daysRemaining = $policy->end_date->diffInDays(now(), false);
                                    @endphp
                                    @if($daysRemaining > 0)
                                        <span class="text-success">{{ $daysRemaining }} days</span>
                                    @elseif($daysRemaining == 0)
                                        <span class="text-warning">Today</span>
                                    @else
                                        <span class="text-danger">{{ abs($daysRemaining) }} days ago</span>
                                    @endif
                                @else
                                    N/A
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Policy Details JSON -->
            @if($policy->policy_details)
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-0 p-4">
                    <h5 class="fw-bold mb-0"><i class="bi bi-info-circle me-2"></i>{{ __('customer.additional_details') }}</h5>
                </div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        @foreach($policy->policy_details as $key => $value)
                        <div class="col-md-6">
                            <label class="small text-muted fw-bold">{{ ucfirst(str_replace('_', ' ', $key)) }}</label>
                            <div class="fw-bold">{{ is_array($value) ? json_encode($value) : $value }}</div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Actions Card -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm sticky-top" style="top: 20px;">
                <div class="card-header bg-primary text-white border-0 p-4">
                    <h5 class="fw-bold mb-0"><i class="bi bi-lightning me-2"></i>Quick Actions</h5>
                </div>
                <div class="card-body p-4">
                    <div class="d-grid gap-3">
                        <a href="{{ route('customer.policies.documents') }}" class="btn btn-primary btn-lg">
                            <i class="bi bi-file-earmark-text me-2"></i> {{ __('customer.view_documents') }}
                        </a>
                        <a href="{{ route('customer.claims.create', ['policy_id' => $policy->id]) }}" class="btn btn-outline-primary btn-lg">
                            <i class="bi bi-exclamation-octagon me-2"></i> {{ __('customer.file_claim') }}
                        </a>
                        <a href="{{ route('customer.policies.renewals') }}" class="btn btn-outline-secondary btn-lg">
                            <i class="bi bi-arrow-clockwise me-2"></i> {{ __('customer.renew_policy') }}
                        </a>
                        <hr>
                        <a href="{{ route('customer.support') }}" class="btn btn-outline-info">
                            <i class="bi bi-headset me-2"></i> {{ __('customer.contact_support') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="container-fluid">
    <div class="row">
        <div class="col-12 text-center py-5">
            <i class="bi bi-shield-x" style="font-size: 4rem; color: #dc3545;"></i>
            <h4 class="fw-bold mt-3">{{ __('customer.policy_not_found') }}</h4>
            <p class="text-muted">{{ __('customer.policy_not_found_desc') }}</p>
            <a href="{{ route('customer.policies.index') }}" class="btn btn-primary">
                {{ __('customer.back_to_policies') }}
            </a>
        </div>
    </div>
</div>
@endif
@endsection

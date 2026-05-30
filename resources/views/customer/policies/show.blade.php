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
            <h4 class="fw-bold mb-2">{{ __('customer.policy_details') }}</h4>
            <p class="text-muted small">{{ $policy->policy_number ?? 'N/A' }}</p>
        </div>
    </div>

    <div class="row g-4">
        <!-- Policy Info Card -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-0 p-4">
                    <h5 class="fw-bold mb-0">{{ __('customer.policy_information') }}</h5>
                </div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="small text-muted">{{ __('customer.policy_name') }}</label>
                            <div class="fw-bold">{{ $policy->product->product_name ?? 'N/A' }}</div>
                        </div>
                        <div class="col-md-6">
                            <label class="small text-muted">{{ __('customer.policy_number') }}</label>
                            <div class="fw-bold">{{ $policy->policy_number ?? 'N/A' }}</div>
                        </div>
                        <div class="col-md-6">
                            <label class="small text-muted">{{ __('customer.provider') }}</label>
                            <div class="fw-bold">{{ $policy->insurer->insurer_name ?? 'N/A' }}</div>
                        </div>
                        <div class="col-md-6">
                            <label class="small text-muted">{{ __('customer.status') }}</label>
                            <div class="fw-bold">
                                @if(($policy->status ?? '') === 'active')
                                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">Active</span>
                                @elseif(($policy->status ?? '') === 'expired')
                                    <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3">Expired</span>
                                @else
                                    <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-3">{{ ucfirst($policy->status ?? 'Unknown') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="small text-muted">{{ __('customer.start_date') }}</label>
                            <div class="fw-bold">{{ $policy->start_date ? $policy->start_date->format('d M Y') : 'N/A' }}</div>
                        </div>
                        <div class="col-md-6">
                            <label class="small text-muted">{{ __('customer.end_date') }}</label>
                            <div class="fw-bold">{{ $policy->end_date ? $policy->end_date->format('d M Y') : 'N/A' }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Coverage Details -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-0 p-4">
                    <h5 class="fw-bold mb-0">{{ __('customer.coverage_details') }}</h5>
                </div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="small text-muted">{{ __('customer.premium_amount') }}</label>
                            <div class="fw-bold fs-5">TZS {{ number_format($policy->premium_amount ?? 0, 0) }}</div>
                        </div>
                        <div class="col-md-6">
                            <label class="small text-muted">{{ __('customer.premium_frequency') }}</label>
                            <div class="fw-bold">{{ ucfirst($policy->premium_frequency ?? 'N/A') }}</div>
                        </div>
                        <div class="col-md-6">
                            <label class="small text-muted">{{ __('customer.sum_assured') }}</label>
                            <div class="fw-bold">TZS {{ number_format($policy->sum_assured ?? 0, 0) }}</div>
                        </div>
                        <div class="col-md-6">
                            <label class="small text-muted">{{ __('customer.payment_method') }}</label>
                            <div class="fw-bold">{{ ucfirst($policy->payment_method ?? 'N/A') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Policy Details JSON -->
            @if($policy->policy_details)
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-0 p-4">
                    <h5 class="fw-bold mb-0">{{ __('customer.additional_details') }}</h5>
                </div>
                <div class="card-body p-4">
                    @foreach($policy->policy_details as $key => $value)
                    <div class="mb-2">
                        <label class="small text-muted">{{ ucfirst(str_replace('_', ' ', $key)) }}</label>
                        <div class="fw-bold">{{ is_array($value) ? json_encode($value) : $value }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <!-- Actions Card -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm sticky-top" style="top: 20px;">
                <div class="card-header bg-light border-0 p-4">
                    <h5 class="fw-bold mb-0">{{ __('customer.quick_actions') }}</h5>
                </div>
                <div class="card-body p-4">
                    <div class="d-grid gap-2">
                        <a href="{{ route('customer.policies.documents') }}" class="btn btn-primary">
                            <i class="bi bi-file-earmark-text me-2"></i> {{ __('customer.view_documents') }}
                        </a>
                        <a href="{{ route('customer.claims.create') }}" class="btn btn-outline-primary">
                            <i class="bi bi-exclamation-octagon me-2"></i> {{ __('customer.file_claim') }}
                        </a>
                        <a href="{{ route('customer.policies.renewals') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-clockwise me-2"></i> {{ __('customer.renew_policy') }}
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

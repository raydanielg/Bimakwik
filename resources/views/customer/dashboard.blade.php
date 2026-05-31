@extends('layouts.dashboard')

@section('dashboard_title', __('customer.my_insurance_dashboard'))

@section('content')
<!-- Customer Welcome Banner -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm overflow-hidden" style="background: linear-gradient(135deg, #1e293b 0%, #334155 100%); border-radius: 20px;">
            <div class="card-body p-4 p-md-5 text-white">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2 class="fw-bold mb-2">{{ __('customer.welcome_back') }}, {{ explode(' ', auth()->user()->name)[0] }}! 👋</h2>
                        <p class="opacity-75 mb-4">{{ __('customer.dashboard_banner_subtitle') }}</p>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="{{ route('customer.buy') }}" class="btn btn-primary px-4 py-2" style="border-radius: 10px;">
                                <i class="bi bi-cart-plus me-2"></i> {{ __('customer.buy_new_insurance') }}
                            </a>
                            <a href="{{ route('customer.claims.create') }}" class="btn btn-outline-light px-4 py-2" style="border-radius: 10px;">
                                <i class="bi bi-exclamation-octagon me-2"></i> {{ __('customer.report_issue') }}
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 d-none d-md-block text-end">
                        <i class="bi bi-shield-check-fill" style="font-size: 8rem; opacity: 0.1;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Stats -->
<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 15px;">
            <div class="card-body p-3 p-md-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-primary bg-opacity-10 p-2 rounded-3 text-primary me-2">
                        <i class="bi bi-shield-fill fs-4"></i>
                    </div>
                </div>
                <h3 class="fw-bold mb-0 stat-count">{{ $stats['active_policies'] ?? 0 }}</h3>
                <p class="x-small text-muted mb-0 mt-1">Active Policies</p>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 15px;">
            <div class="card-body p-3 p-md-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-success bg-opacity-10 p-2 rounded-3 text-success me-2">
                        <i class="bi bi-wallet2 fs-4"></i>
                    </div>
                </div>
                <h3 class="fw-bold mb-0"><span class="stat-count" data-target="{{ $stats['wallet_balance'] ?? 0 }}">{{ number_format($stats['wallet_balance'] ?? 0, 0) }}</span></h3>
                <p class="x-small text-muted mb-0 mt-1">Wallet Balance</p>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 15px;">
            <div class="card-body p-3 p-md-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-info bg-opacity-10 p-2 rounded-3 text-info me-2">
                        <i class="bi bi-clipboard2-check fs-4"></i>
                    </div>
                </div>
                <h3 class="fw-bold mb-0 stat-count">{{ $stats['total_claims'] ?? 0 }}</h3>
                <p class="x-small text-muted mb-0 mt-1">Total Claims</p>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 15px;">
            <div class="card-body p-3 p-md-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-warning bg-opacity-10 p-2 rounded-3 text-warning me-2">
                        <i class="bi bi-hourglass-split fs-4"></i>
                    </div>
                </div>
                <h3 class="fw-bold mb-0 stat-count">{{ $stats['pending_claims'] ?? 0 }}</h3>
                <p class="x-small text-muted mb-0 mt-1">Pending Claims</p>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Active Policies List -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm mb-4" style="border-radius: 20px;">
            <div class="card-header bg-white border-0 p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0">{{ __('customer.active_policies_title') }}</h5>
                    <a href="{{ route('customer.policies.index') }}" class="small text-decoration-none">{{ __('customer.all_link') }}</a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="border-0 px-4 py-3 small text-muted text-uppercase">{{ __('customer.table_policy') }}</th>
                                <th class="border-0 py-3 small text-muted text-uppercase d-none d-md-table-cell">{{ __('customer.table_policy_number') }}</th>
                                <th class="border-0 py-3 small text-muted text-uppercase">{{ __('customer.status') }}</th>
                                <th class="border-0 py-3 small text-muted text-uppercase">{{ __('customer.table_expiry') }}</th>
                                <th class="border-0 px-4 py-3"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $recentPolicies = $recentPolicies ?? collect(); @endphp
                            @forelse($recentPolicies as $pol)
                            @php
                                $polStatus = $pol->status ?? 'active';
                                $badgeCol = $polStatus === 'active' ? 'success' : ($polStatus === 'expired' ? 'danger' : 'warning');
                                $expiry = $pol->end_date ? \Carbon\Carbon::parse($pol->end_date)->format('d M') : '-';
                            @endphp
                            <tr>
                                <td class="px-4 py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary bg-opacity-10 p-2 rounded-3 text-primary me-3">
                                            <i class="bi bi-shield-check fs-5"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold small">{{ $pol->product->product_name ?? 'Insurance Policy' }}</div>
                                            <div class="x-small text-muted">{{ $pol->insurer->insurer_name ?? 'Provider' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3 d-none d-md-table-cell">
                                    <span class="x-small">{{ $pol->policy_number }}</span>
                                </td>
                                <td class="py-3">
                                    <span class="badge bg-{{ $badgeCol }}-subtle text-{{ $badgeCol }} px-2 py-1" style="font-size: 0.65rem;">{{ ucfirst($polStatus) }}</span>
                                </td>
                                <td class="py-3 fw-bold small {{ $polStatus === 'active' ? 'text-danger' : 'text-muted' }}">{{ $expiry }}</td>
                                <td class="px-4 py-3 text-end">
                                    <a href="{{ route('customer.policies.show', $pol->id) }}" class="btn btn-sm btn-light rounded-circle"><i class="bi bi-chevron-right"></i></a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-4 py-4 text-center text-muted small">
                                    No policies yet. <a href="{{ route('customer.buy') }}">Buy your first policy</a>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Sidebar Content -->
    <div class="col-lg-4">
        <!-- AI Recommendations -->
        <div class="card border-0 shadow-sm mb-4" style="border-radius: 20px; background: #fdf2f8;">
            <div class="card-body p-4 text-center">
                <div class="bg-white rounded-circle shadow-sm mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                    <i class="bi bi-robot fs-2 text-primary"></i>
                </div>
                <h6 class="fw-bold mb-2">{{ __('customer.ai_recommendation_title') }}</h6>
                <p class="x-small text-muted mb-3">{{ __('customer.ai_recommendation_text') }}</p>
                <button class="btn btn-sm btn-primary w-100 rounded-pill py-2 small">{{ __('customer.view_offer') }}</button>
            </div>
        </div>

        <!-- Quick Links -->
        <div class="card border-0 shadow-sm mb-4" style="border-radius: 20px;">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-4">{{ __('customer.quick_help_title') }}</h6>
                <div class="d-grid gap-2">
                    <a href="{{ route('customer.support') }}" class="btn btn-light text-start border-0 py-3 px-3 d-flex align-items-center">
                        <i class="bi bi-chat-dots me-3 text-primary"></i>
                        <span class="small fw-bold">{{ __('customer.talk_to_us_live_chat') }}</span>
                    </a>
                    <a href="{{ route('customer.policies.documents') }}" class="btn btn-light text-start border-0 py-3 px-3 d-flex align-items-center">
                        <i class="bi bi-download me-3 text-success"></i>
                        <span class="small fw-bold">{{ __('customer.download_certificates') }}</span>
                    </a>
                    <a href="#" class="btn btn-light text-start border-0 py-3 px-3 d-flex align-items-center">
                        <i class="bi bi-geo-alt me-3 text-danger"></i>
                        <span class="small fw-bold">{{ __('customer.nearby_hospitals') }}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .x-small { font-size: 0.7rem; }
    .bg-gradient-primary { background: linear-gradient(45deg, #0d6efd, #0dcaf0); }
</style>
@endsection

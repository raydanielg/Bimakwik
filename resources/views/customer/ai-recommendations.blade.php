@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="fw-bold">{{ __('customer.ai_recommendations_title') }}</h4>
            <p class="text-muted small">{{ __('customer.ai_recommendations_subtitle') }}</p>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-primary text-white">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 bg-white bg-opacity-20 rounded-circle p-3 me-3">
                        <i class="bi bi-robot fs-1"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1">{{ __('customer.ai_says') }}</h5>
                        <p class="mb-0 opacity-75">{{ __('customer.ai_suggestion') }}</p>
                    </div>
                </div>
            </div>

            <h6 class="fw-bold mb-3">{{ __('customer.recommended_products') }}</h6>
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm rounded-4 h-100 hover-lift">
                        <div class="card-body p-4">
                            <span class="badge bg-success bg-opacity-10 text-success rounded-pill mb-3">{{ __('customer.best_value') }}</span>
                            <h5 class="fw-bold mb-2">{{ __('customer.health_pro_plan') }}</h5>
                            <p class="small text-muted mb-4">{{ __('customer.health_pro_plan_desc') }}</p>
                            <a href="{{ route('customer.buy') }}" class="btn btn-primary btn-sm rounded-pill px-4">{{ __('customer.buy_now') }}</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm rounded-4 h-100 hover-lift">
                        <div class="card-body p-4">
                            <span class="badge bg-info bg-opacity-10 text-info rounded-pill mb-3">{{ __('customer.popular') }}</span>
                            <h5 class="fw-bold mb-2">{{ __('customer.smart_life_cover') }}</h5>
                            <p class="small text-muted mb-4">{{ __('customer.smart_life_cover_desc') }}</p>
                            <a href="{{ route('customer.buy') }}" class="btn btn-primary btn-sm rounded-pill px-4">{{ __('customer.buy_now') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                <h5 class="fw-bold mb-3">{{ __('customer.about_ai') }}</h5>
                <p class="small text-muted">
                    {{ __('customer.about_ai_text') }}
                </p>
                <hr>
                <h6 class="fw-bold small mb-2">{{ __('customer.insight_score') }}</h6>
                <div class="progress rounded-pill mb-2" style="height: 10px;">
                    <div class="progress-bar bg-success" style="width: 85%;"></div>
                </div>
                <p class="extra-small text-muted">{{ __('customer.profile_completeness') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection

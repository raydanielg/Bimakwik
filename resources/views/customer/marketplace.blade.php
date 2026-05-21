@extends('layouts.dashboard')

@section('dashboard_content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                <h4 class="fw-bold">{{ __('customer.marketplace_title') }}</h4>
                <p class="text-muted small">{{ __('customer.marketplace_subtitle') }}</p>
            </div>
            <div class="input-group w-auto">
                <input type="text" class="form-control rounded-start-pill border-0 shadow-sm" placeholder="{{ __('customer.search_products') }}">
                <button class="btn btn-primary rounded-end-pill px-4 shadow-sm"><i class="bi bi-search"></i></button>
            </div>
        </div>
    </div>

    <div class="row g-4">
        @php
            $categories = [
                ['name' => __('customer.health_category'), 'icon' => 'bi-heart-pulse', 'color' => 'danger', 'count' => 12],
                ['name' => __('customer.life_category'), 'icon' => 'bi-person-vcard', 'color' => 'primary', 'count' => 8],
                ['name' => __('customer.motor_category'), 'icon' => 'bi-car-front', 'color' => 'success', 'count' => 15],
                ['name' => __('customer.travel_category'), 'icon' => 'bi-airplane', 'color' => 'info', 'count' => 5],
            ];
        @endphp

        @foreach($categories as $cat)
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-4 text-center hover-lift h-100">
                <div class="bg-{{ $cat['color'] }} bg-opacity-10 rounded-circle p-3 d-inline-block mb-3">
                    <i class="bi {{ $cat['icon'] }} text-{{ $cat['color'] }} fs-2"></i>
                </div>
                <h6 class="fw-bold mb-1">{{ $cat['name'] }}</h6>
                <p class="small text-muted mb-0">{{ $cat['count'] }} {{ __('customer.products') }}</p>
            </div>
        </div>
        @endforeach

        <div class="col-12 mt-5">
            <h5 class="fw-bold mb-4">{{ __('customer.trending_products') }}</h5>
            <div class="row g-4">
                @for($i = 1; $i <= 3; $i++)
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 hover-lift">
                        <div class="bg-primary bg-opacity-10 p-4 text-center">
                            <i class="bi bi-shield-check display-4 text-primary"></i>
                        </div>
                        <div class="card-body p-4">
                            <h6 class="fw-bold mb-2">{{ __('customer.secure_plan_name') }} {{ $i }}</h6>
                            <p class="small text-muted mb-4">{{ __('customer.secure_plan_desc') }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold text-primary">TZS 50,000/{{ __('customer.per_year') }}</span>
                                <a href="{{ route('customer.buy') }}" class="btn btn-sm btn-primary rounded-pill px-3">{{ __('customer.buy_now') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endfor
            </div>
        </div>
    </div>
</div>
@endsection

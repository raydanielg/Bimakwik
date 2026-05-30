@extends('layouts.dashboard')

@section('dashboard_title', __('customer.buy_new_insurance'))

@section('content')
@php
    $quoteProduct = request('product');
    $quoteCoverage = request('coverage');
    $quotePeriod = request('period');
    $quotePrice = request('price');
@endphp
<!-- Page Header -->
<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold mb-2">
            <i class="bi bi-cart-plus me-2"></i>
            {{ __('customer.buy_new_insurance') }}
        </h2>
        <p class="text-muted">{{ __('customer.buy_subtitle') }}</p>
    </div>
</div>

@if($quoteProduct && $quotePrice)
<!-- Quote Summary Card -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm bg-primary text-white">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h5 class="fw-bold mb-2">Your Selected Quote</h5>
                        <div class="row g-2">
                            <div class="col-6">
                                <small class="opacity-75">Product:</small>
                                <div class="fw-bold">{{ ucfirst($quoteProduct) }} Insurance</div>
                            </div>
                            <div class="col-6">
                                <small class="opacity-75">Coverage:</small>
                                <div class="fw-bold">{{ ucfirst($quoteCoverage) }}</div>
                            </div>
                            <div class="col-6">
                                <small class="opacity-75">Period:</small>
                                <div class="fw-bold">{{ ucfirst(str_replace('_', ' ', $quotePeriod)) }}</div>
                            </div>
                            <div class="col-6">
                                <small class="opacity-75">Total Price:</small>
                                <div class="fw-bold fs-5">TZS {{ number_format($quotePrice, 0) }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-end">
                        <form action="{{ route('customer.buy.submit') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product" value="{{ $quoteProduct }}">
                            <input type="hidden" name="coverage" value="{{ $quoteCoverage }}">
                            <input type="hidden" name="period" value="{{ $quotePeriod }}">
                            <input type="hidden" name="price" value="{{ $quotePrice }}">
                            <button type="submit" class="btn btn-light btn-lg fw-bold">
                                <i class="bi bi-cart-check me-2"></i> Buy Now
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Available Insurance Products -->
<div class="row g-4">
    <!-- Motor Insurance -->
    <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100 hover-shadow" style="transition: all 0.3s ease; cursor: pointer;">
            <div class="card-body p-4">
                <div class="mb-3">
                    <i class="bi bi-car-front-fill" style="font-size: 3rem; color: #0066cc;"></i>
                </div>
                <h5 class="card-title fw-bold mb-2">{{ __('customer.motor_insurance') }}</h5>
                <p class="card-text text-muted small mb-3">
                    {{ __('customer.motor_desc') }}
                </p>
                <div class="mb-3">
                    <small class="text-success fw-bold">
                        <i class="bi bi-check-circle me-1"></i>
                        {{ __('customer.motor_plan_note') }}
                    </small>
                </div>
                <button class="btn btn-primary btn-sm w-100" onclick="selectProduct('motor')">
                    {{ __('customer.learn_more') }} <i class="bi bi-arrow-right ms-1"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Health Insurance -->
    <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100 hover-shadow" style="transition: all 0.3s ease; cursor: pointer;">
            <div class="card-body p-4">
                <div class="mb-3">
                    <i class="bi bi-heart-pulse-fill" style="font-size: 3rem; color: #dc3545;"></i>
                </div>
                <h5 class="card-title fw-bold mb-2">{{ __('customer.health_insurance') }}</h5>
                <p class="card-text text-muted small mb-3">
                    {{ __('customer.health_desc') }}
                </p>
                <div class="mb-3">
                    <small class="text-success fw-bold">
                        <i class="bi bi-check-circle me-1"></i>
                        {{ __('customer.health_plan_note') }}
                    </small>
                </div>
                <button class="btn btn-primary btn-sm w-100" onclick="selectProduct('health')">
                    {{ __('customer.learn_more') }} <i class="bi bi-arrow-right ms-1"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Property Insurance -->
    <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100 hover-shadow" style="transition: all 0.3s ease; cursor: pointer;">
            <div class="card-body p-4">
                <div class="mb-3">
                    <i class="bi bi-house-fill" style="font-size: 3rem; color: #ffc107;"></i>
                </div>
                <h5 class="card-title fw-bold mb-2">{{ __('customer.property_insurance') }}</h5>
                <p class="card-text text-muted small mb-3">
                    {{ __('customer.property_desc') }}
                </p>
                <div class="mb-3">
                    <small class="text-success fw-bold">
                        <i class="bi bi-check-circle me-1"></i>
                        {{ __('customer.property_plan_note') }}
                    </small>
                </div>
                <button class="btn btn-primary btn-sm w-100" onclick="selectProduct('property')">
                    {{ __('customer.learn_more') }} <i class="bi bi-arrow-right ms-1"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Travel Insurance -->
    <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100 hover-shadow" style="transition: all 0.3s ease; cursor: pointer;">
            <div class="card-body p-4">
                <div class="mb-3">
                    <i class="bi bi-airplane-fill" style="font-size: 3rem; color: #17a2b8;"></i>
                </div>
                <h5 class="card-title fw-bold mb-2">{{ __('customer.travel_insurance') }}</h5>
                <p class="card-text text-muted small mb-3">
                    {{ __('customer.travel_desc') }}
                </p>
                <div class="mb-3">
                    <small class="text-success fw-bold">
                        <i class="bi bi-check-circle me-1"></i>
                        {{ __('customer.travel_plan_note') }}
                    </small>
                </div>
                <button class="btn btn-primary btn-sm w-100" onclick="selectProduct('travel')">
                    {{ __('customer.learn_more') }} <i class="bi bi-arrow-right ms-1"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Business Insurance -->
    <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100 hover-shadow" style="transition: all 0.3s ease; cursor: pointer;">
            <div class="card-body p-4">
                <div class="mb-3">
                    <i class="bi bi-briefcase-fill" style="font-size: 3rem; color: #28a745;"></i>
                </div>
                <h5 class="card-title fw-bold mb-2">{{ __('customer.business_insurance') }}</h5>
                <p class="card-text text-muted small mb-3">
                    {{ __('customer.business_desc') }}
                </p>
                <div class="mb-3">
                    <small class="text-success fw-bold">
                        <i class="bi bi-check-circle me-1"></i>
                        {{ __('customer.business_plan_note') }}
                    </small>
                </div>
                <button class="btn btn-primary btn-sm w-100" onclick="selectProduct('business')">
                    {{ __('customer.learn_more') }} <i class="bi bi-arrow-right ms-1"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Life Insurance -->
    <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100 hover-shadow" style="transition: all 0.3s ease; cursor: pointer;">
            <div class="card-body p-4">
                <div class="mb-3">
                    <i class="bi bi-shield-heart-fill" style="font-size: 3rem; color: #6f42c1;"></i>
                </div>
                <h5 class="card-title fw-bold mb-2">{{ __('customer.life_insurance') }}</h5>
                <p class="card-text text-muted small mb-3">
                    {{ __('customer.life_desc') }}
                </p>
                <div class="mb-3">
                    <small class="text-success fw-bold">
                        <i class="bi bi-check-circle me-1"></i>
                        {{ __('customer.life_plan_note') }}
                    </small>
                </div>
                <button class="btn btn-primary btn-sm w-100" onclick="selectProduct('life')">
                    {{ __('customer.learn_more') }} <i class="bi bi-arrow-right ms-1"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Why Choose Bima Kwik -->
<div class="row mt-5">
    <div class="col-12">
        <div class="card border-0 shadow-sm p-4" style="background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);">
            <h4 class="fw-bold mb-4">{{ __('customer.why_choose_bimakwik') }}</h4>
            <div class="row g-3">
                <div class="col-md-3">
                    <div class="d-flex gap-3">
                        <div>
                            <i class="bi bi-lightning-fill" style="font-size: 1.5rem; color: #ffc107;"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold">{{ __('customer.fast_and_easy') }}</h6>
                            <small class="text-muted">{{ __('customer.about_5_minutes') }}</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="d-flex gap-3">
                        <div>
                            <i class="bi bi-percent" style="font-size: 1.5rem; color: #28a745;"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold">{{ __('customer.affordable_price') }}</h6>
                            <small class="text-muted">{{ __('customer.competitive_rates') }}</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="d-flex gap-3">
                        <div>
                            <i class="bi bi-shield-check" style="font-size: 1.5rem; color: #0066cc;"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold">{{ __('customer.safe') }}</h6>
                            <small class="text-muted">{{ __('customer.regulated_by_tira') }}</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="d-flex gap-3">
                        <div>
                            <i class="bi bi-24-hours" style="font-size: 1.5rem; color: #dc3545;"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold">{{ __('customer.support_24_7') }}</h6>
                            <small class="text-muted">{{ __('customer.always_here_for_you') }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- FAQ Section -->
<div class="row mt-5">
    <div class="col-12">
        <h4 class="fw-bold mb-4">{{ __('customer.faq_title') }}</h4>
        <div class="accordion" id="faqAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqOne">
                        {{ __('customer.faq_q1') }}
                    </button>
                </h2>
                <div id="faqOne" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        {{ __('customer.faq_a1') }}
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqTwo">
                        {{ __('customer.faq_q2') }}
                    </button>
                </h2>
                <div id="faqTwo" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        {{ __('customer.faq_a2') }}
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqThree">
                        {{ __('customer.faq_q3') }}
                    </button>
                </h2>
                <div id="faqThree" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        {{ __('customer.faq_a3') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .hover-shadow {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.08) !important;
    }

    .hover-shadow:hover {
        box-shadow: 0 1.5rem 3rem rgba(0, 0, 0, 0.15) !important;
        transform: translateY(-4px);
    }
</style>

<script>
    function selectProduct(product) {
        // Store selected product and redirect to quote page
        localStorage.setItem('selectedProduct', product);
        window.location.href = '{{ route("customer.quote") }}?product=' + product;
    }
</script>
@endsection

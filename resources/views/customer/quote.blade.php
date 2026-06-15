@extends('layouts.dashboard')

@section('dashboard_title', __('customer.quote_title'))

@section('content')
<!-- Page Header -->
<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold mb-2">
            <i class="bi bi-receipt me-2"></i>
            {{ __('customer.quote_header') }}
        </h2>
        <p class="text-muted">{{ __('customer.quote_subtitle') }}</p>
    </div>
</div>

<!-- Quote Form -->
<div class="row">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <form id="quoteForm" method="POST" action="{{ route('customer.quote') }}">
                    @csrf
                    
                    <!-- Product Selection -->
                    <div class="mb-4">
                        <label class="form-label fw-bold mb-3">{{ __('customer.insurance_type') }}</label>
                        <div id="productSelection">
                            <div class="btn-group-vertical w-100" role="group">
                                <input type="radio" class="btn-check" name="product" id="product_motor" value="motor" {{ request('product') == 'motor' ? 'checked' : '' }}>
                                <label class="btn btn-outline-primary text-start" for="product_motor">
                                    <i class="bi bi-car-front-fill me-2"></i>
                                    <strong>{{ __('customer.motor_insurance') }}</strong>
                                    <br>
                                    <small class="text-muted">{{ __('customer.protect_your_car') }}</small>
                                </label>

                                <input type="radio" class="btn-check" name="product" id="product_health" value="health" {{ request('product') == 'health' ? 'checked' : '' }}>
                                <label class="btn btn-outline-primary text-start" for="product_health">
                                    <i class="bi bi-heart-pulse-fill me-2"></i>
                                    <strong>{{ __('customer.health_insurance') }}</strong>
                                    <br>
                                    <small class="text-muted">{{ __('customer.inpatient_services') }}</small>
                                </label>

                                <input type="radio" class="btn-check" name="product" id="product_property" value="property" {{ request('product') == 'property' ? 'checked' : '' }}>
                                <label class="btn btn-outline-primary text-start" for="product_property">
                                    <i class="bi bi-house-fill me-2"></i>
                                    <strong>{{ __('customer.property_insurance') }}</strong>
                                    <br>
                                    <small class="text-muted">{{ __('customer.protect_your_home') }}</small>
                                </label>

                                <input type="radio" class="btn-check" name="product" id="product_travel" value="travel" {{ request('product') == 'travel' ? 'checked' : '' }}>
                                <label class="btn btn-outline-primary text-start" for="product_travel">
                                    <i class="bi bi-airplane-fill me-2"></i>
                                    <strong>{{ __('customer.travel_insurance') }}</strong>
                                    <br>
                                    <small class="text-muted">{{ __('customer.for_travel') }}</small>
                                </label>

                                <input type="radio" class="btn-check" name="product" id="product_business" value="business" {{ request('product') == 'business' ? 'checked' : '' }}>
                                <label class="btn btn-outline-primary text-start" for="product_business">
                                    <i class="bi bi-briefcase-fill me-2"></i>
                                    <strong>{{ __('customer.business_insurance') }}</strong>
                                    <br>
                                    <small class="text-muted">{{ __('customer.business_desc') }}</small>
                                </label>

                                <input type="radio" class="btn-check" name="product" id="product_life" value="life" {{ request('product') == 'life' ? 'checked' : '' }}>
                                <label class="btn btn-outline-primary text-start" for="product_life">
                                    <i class="bi bi-shield-heart-fill me-2"></i>
                                    <strong>{{ __('customer.life_insurance') }}</strong>
                                    <br>
                                    <small class="text-muted">{{ __('customer.life_desc') }}</small>
                                </label>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- Personal Information -->
                    <h5 class="fw-bold mb-3">{{ __('customer.personal_information') }}</h5>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label">{{ __('customer.full_name') }}</label>
                            <input type="text" class="form-control" value="{{ auth()->user()->name }}" disabled>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">{{ __('customer.email_address') }}</label>
                            <input type="email" class="form-control" value="{{ auth()->user()->email }}" disabled>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label">{{ __('customer.phone') }}</label>
                            <input type="tel" class="form-control" name="phone" placeholder="+255 7XX XXX XXX" value="{{ auth()->user()->phone_number ?? '' }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">{{ __('customer.date_of_birth') }}</label>
                            <input type="date" class="form-control" name="date_of_birth" required>
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- Coverage Details -->
                    <h5 class="fw-bold mb-3">{{ __('customer.coverage_details') }}</h5>

                    <div class="mb-3">
                        <label class="form-label">{{ __('customer.coverage_level') }}</label>
                        <select class="form-select" name="coverage_level" required>
                            <option value="">{{ __('customer.choose_level') }}</option>
                            <option value="basic">{{ __('customer.plan_basic') }} - TZS 50,000</option>
                            <option value="standard">{{ __('customer.plan_standard') }} - TZS 100,000</option>
                            <option value="premium">{{ __('customer.plan_premium') }} - TZS 200,000</option>
                            <option value="elite">{{ __('customer.plan_elite') }} - TZS 500,000</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">{{ __('customer.coverage_period') }}</label>
                        <select class="form-select" name="coverage_period" required>
                            <option value="">{{ __('customer.choose_period') }}</option>
                            <option value="monthly">{{ __('customer.monthly') }}</option>
                            <option value="quarterly">{{ __('customer.quarterly') }}</option>
                            <option value="semi_annual">{{ __('customer.semi_annual') }}</option>
                            <option value="annual">{{ __('customer.annual') }}</option>
                        </select>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="d-flex gap-2 pt-4">
                        <a href="{{ route('customer.buy') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-2"></i> {{ __('customer.back') }}
                        </a>
                        <button type="button" id="getPriceBtn" class="btn btn-primary ms-auto">
                            <i class="bi bi-check-circle me-2"></i> {{ __('customer.get_price') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Quote Summary -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm sticky-top" style="top: 20px;">
            <div class="card-header bg-light border-0 p-4">
                <h5 class="fw-bold mb-0">{{ __('customer.quote_summary') }}</h5>
            </div>
            <div class="card-body p-4">
                <div class="mb-3">
                    <small class="text-muted">{{ __('customer.insurance_type') }}</small>
                    <div class="fw-bold" id="summaryProduct">-</div>
                </div>

                <div class="mb-3">
                    <small class="text-muted">{{ __('customer.coverage_level') }}</small>
                    <div class="fw-bold" id="summaryCoverage">-</div>
                </div>

                <div class="mb-4">
                    <small class="text-muted">{{ __('customer.coverage_period') }}</small>
                    <div class="fw-bold" id="summaryPeriod">-</div>
                </div>

                <hr>

                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>{{ __('customer.monthly_cost') }}:</span>
                        <h5 class="fw-bold mb-0" id="summaryPrice">TZS 0</h5>
                    </div>
                </div>

                <div class="alert alert-info small">
                    <i class="bi bi-info-circle me-2"></i>
                    <strong>{{ __('customer.remember') }}:</strong> {{ __('customer.quote_estimate_notice') }}
                </div>

                <button id="continueBtn" class="btn btn-primary w-100" disabled>
                    <i class="bi bi-lock me-2"></i> {{ __('customer.fill_form_to_continue') }}
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // Update summary based on form input
    document.querySelectorAll('input[name="product"], select[name="coverage_level"], select[name="coverage_period"]').forEach(el => {
        el.addEventListener('change', updateSummary);
    });

    function updateSummary() {
        const product = document.querySelector('input[name="product"]:checked')?.value || '-';
        const coverage = document.querySelector('select[name="coverage_level"]')?.value || '-';
        const period = document.querySelector('select[name="coverage_period"]')?.value || '-';
        
        // Update display
        const productNames = {
            'motor': '{{ __('customer.motor_insurance') }}',
            'health': '{{ __('customer.health_insurance') }}',
            'property': '{{ __('customer.property_insurance') }}',
            'travel': '{{ __('customer.travel_insurance') }}',
            'business': '{{ __('customer.business_insurance') }}',
            'life': '{{ __('customer.life_insurance') }}'
        };
        
        const coverageNames = {
            'basic': '{{ __('customer.plan_basic') }}',
            'standard': '{{ __('customer.plan_standard') }}',
            'premium': '{{ __('customer.plan_premium') }}',
            'elite': '{{ __('customer.plan_elite') }}'
        };
        
        const periodNames = {
            'monthly': '{{ __('customer.monthly') }}',
            'quarterly': '{{ __('customer.quarterly') }}',
            'semi_annual': '{{ __('customer.semi_annual') }}',
            'annual': '{{ __('customer.annual') }}'
        };
        
        document.getElementById('summaryProduct').textContent = productNames[product] || '-';
        document.getElementById('summaryCoverage').textContent = coverageNames[coverage] || '-';
        document.getElementById('summaryPeriod').textContent = periodNames[period] || '-';
    }

    // Get Price button AJAX
    document.getElementById('getPriceBtn').addEventListener('click', function() {
        const product = document.querySelector('input[name="product"]:checked')?.value;
        const coverage = document.querySelector('select[name="coverage_level"]')?.value;
        const period = document.querySelector('select[name="coverage_period"]')?.value;
        const phone = document.querySelector('input[name="phone"]')?.value;
        const dob = document.querySelector('input[name="date_of_birth"]')?.value;

        if (!product || !coverage || !period || !phone || !dob) {
            alert('Please fill in all required fields');
            return;
        }

        const btn = this;
        btn.disabled = true;
        btn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i> Calculating...';

        // Calculate price based on coverage level
        const coveragePrices = {
            'basic': 50000,
            'standard': 100000,
            'premium': 200000,
            'elite': 500000
        };

        const periodMultipliers = {
            'monthly': 1,
            'quarterly': 3,
            'semi_annual': 6,
            'annual': 12
        };

        const basePrice = coveragePrices[coverage] || 0;
        const multiplier = periodMultipliers[period] || 1;
        const totalPrice = basePrice * multiplier;

        // Simulate API call delay
        setTimeout(() => {
            document.getElementById('summaryPrice').textContent = 'TZS ' + totalPrice.toLocaleString();
            
            // Enable continue button
            const continueBtn = document.getElementById('continueBtn');
            continueBtn.disabled = false;
            continueBtn.innerHTML = '<i class="bi bi-arrow-right me-2"></i> Continue to Purchase';
            continueBtn.onclick = function() {
                window.location.href = '{{ route('customer.buy') }}?product=' + product + '&coverage=' + coverage + '&period=' + period + '&price=' + totalPrice;
            };

            btn.disabled = false;
            btn.innerHTML = '<i class="bi bi-check-circle me-2"></i> {{ __('customer.get_price') }}';
        }, 500);
    });

    // Initialize summary
    updateSummary();
</script>
@endsection

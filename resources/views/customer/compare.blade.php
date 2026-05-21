@extends('layouts.dashboard')

@section('dashboard_title', __('customer.compare_title'))

@section('dashboard_content')
<!-- Page Header -->
<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold mb-2">
            <i class="bi bi-columns-gap me-2"></i>
            {{ __('customer.compare_header') }}
        </h2>
        <p class="text-muted">{{ __('customer.compare_subtitle') }}</p>
    </div>
</div>

<!-- Product Type Selector -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <label class="fw-bold mb-3">{{ __('customer.choose_insurance_type') }}</label>
                <div class="btn-group w-100" role="group">
                    <input type="radio" class="btn-check" name="product_type" id="motor" value="motor" checked>
                    <label class="btn btn-outline-primary" for="motor">{{ __('customer.motor_insurance') }}</label>

                    <input type="radio" class="btn-check" name="product_type" id="health" value="health">
                    <label class="btn btn-outline-primary" for="health">{{ __('customer.health_insurance') }}</label>

                    <input type="radio" class="btn-check" name="product_type" id="property" value="property">
                    <label class="btn btn-outline-primary" for="property">{{ __('customer.property_insurance') }}</label>

                    <input type="radio" class="btn-check" name="product_type" id="travel" value="travel">
                    <label class="btn btn-outline-primary" for="travel">{{ __('customer.travel_insurance') }}</label>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Comparison Table -->
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr class="border-bottom-2">
                                <th class="fw-bold py-3" width="25%">{{ __('customer.feature') }}</th>
                                <th class="fw-bold text-center py-3" width="25%">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="bi bi-file-earmark-text" style="font-size: 1.5rem;"></i>
                                        <span class="mt-2">{{ __('customer.plan_basic') }}</span>
                                        <small class="text-muted">TZS 50,000</small>
                                    </div>
                                </th>
                                <th class="fw-bold text-center py-3" width="25%">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="bi bi-star-fill" style="font-size: 1.5rem; color: #ffc107;"></i>
                                        <span class="mt-2">{{ __('customer.plan_standard') }}</span>
                                        <small class="text-muted">TZS 100,000</small>
                                    </div>
                                </th>
                                <th class="fw-bold text-center py-3" width="25%">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="bi bi-gem" style="font-size: 1.5rem; color: #dc3545;"></i>
                                        <span class="mt-2">{{ __('customer.plan_premium') }}</span>
                                        <small class="text-muted">TZS 200,000</small>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Coverage -->
                            <tr class="table-light">
                                <td colspan="4" class="fw-bold py-3">
                                    <i class="bi bi-shield-check me-2"></i> {{ __('customer.coverage_section') }}
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">{{ __('customer.core_coverage') }}</td>
                                <td class="text-center">
                                    <span class="badge bg-success">✓ {{ __('customer.yes') }}</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-success">✓ {{ __('customer.yes') }}</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-success">✓ {{ __('customer.yes') }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">{{ __('customer.additional_coverage') }}</td>
                                <td class="text-center">
                                    <span class="badge bg-danger">✗ {{ __('customer.no') }}</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-success">✓ {{ __('customer.yes') }}</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-success">✓ {{ __('customer.yes') }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">{{ __('customer.total_coverage') }}</td>
                                <td class="text-center">
                                    <strong>TZS 50,000</strong>
                                </td>
                                <td class="text-center">
                                    <strong>TZS 100,000</strong>
                                </td>
                                <td class="text-center">
                                    <strong>TZS 200,000</strong>
                                </td>
                            </tr>

                            <!-- Deductibles -->
                            <tr class="table-light">
                                <td colspan="4" class="fw-bold py-3">
                                    <i class="bi bi-cash me-2"></i> {{ __('customer.deductibles_services') }}
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">{{ __('customer.standard_deductible') }}</td>
                                <td class="text-center">
                                    <strong>TZS 10,000</strong>
                                </td>
                                <td class="text-center">
                                    <strong>TZS 5,000</strong>
                                </td>
                                <td class="text-center">
                                    <strong>{{ __('customer.no_deductible') }}</strong>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">{{ __('customer.round_the_clock_support') }}</td>
                                <td class="text-center">
                                    <span class="badge bg-danger">✗ {{ __('customer.no') }}</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-success">✓ {{ __('customer.yes') }}</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-success">✓ {{ __('customer.yes') }}</span>
                                </td>
                            </tr>

                            <!-- Support -->
                            <tr class="table-light">
                                <td colspan="4" class="fw-bold py-3">
                                    <i class="bi bi-headset me-2"></i> {{ __('customer.support_services') }}
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">{{ __('customer.file_and_phone') }}</td>
                                <td class="text-center">
                                    <span class="badge bg-success">✓ {{ __('customer.yes') }}</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-success">✓ {{ __('customer.yes') }}</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-success">✓ {{ __('customer.yes') }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">{{ __('customer.whatsapp_support') }}</td>
                                <td class="text-center">
                                    <span class="badge bg-danger">✗ {{ __('customer.no') }}</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-success">✓ {{ __('customer.yes') }}</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-success">✓ {{ __('customer.yes') }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">{{ __('customer.personal_advisor') }}</td>
                                <td class="text-center">
                                    <span class="badge bg-danger">✗ {{ __('customer.no') }}</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-danger">✗ {{ __('customer.no') }}</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-success">✓ {{ __('customer.yes') }}</span>
                                </td>
                            </tr>

                            <!-- Additional Features -->
                            <tr class="table-light">
                                <td colspan="4" class="fw-bold py-3">
                                    <i class="bi bi-star me-2"></i> {{ __('customer.extra_features') }}
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">{{ __('customer.roadside_assistance') }}</td>
                                <td class="text-center">
                                    <span class="badge bg-danger">✗ {{ __('customer.no') }}</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-danger">✗ {{ __('customer.no') }}</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-success">✓ {{ __('customer.yes') }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">{{ __('customer.payment_flexibility') }}</td>
                                <td class="text-center">
                                    <span class="badge bg-success">✓ {{ __('customer.yes') }}</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-success">✓ {{ __('customer.yes') }}</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-success">✓ {{ __('customer.yes') }}</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Action Buttons -->
<div class="row mt-4">
    <div class="col-12">
        <div class="d-flex gap-2 justify-content-center">
            <a href="{{ route('customer.buy') }}" class="btn btn-primary btn-lg">
                <i class="bi bi-cart-plus me-2"></i> {{ __('customer.buy_now') }}
            </a>
            <a href="{{ route('customer.marketplace') }}" class="btn btn-outline-secondary btn-lg">
                <i class="bi bi-arrow-left me-2"></i> {{ __('customer.back_to_marketplace') }}
            </a>
        </div>
    </div>
</div>

<!-- Comparison Tips -->
<div class="row mt-5">
    <div class="col-lg-8 mx-auto">
        <div class="card border-0 shadow-sm bg-light">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-3">
                    <i class="bi bi-lightbulb me-2"></i> {{ __('customer.comparison_tips') }}
                </h5>
                <ul class="mb-0">
                    <li class="mb-2"><strong>Basic Plan:</strong> {{ __('customer.basic_plan_tip') }}</li>
                    <li class="mb-2"><strong>Standard Plan:</strong> {{ __('customer.standard_plan_tip') }}</li>
                    <li class="mb-2"><strong>Premium Plan:</strong> {{ __('customer.premium_plan_tip') }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<style>
    .border-bottom-2 {
        border-bottom: 2px solid #dee2e6 !important;
    }

    .table-hover tbody tr {
        transition: background-color 0.2s ease;
    }

    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }

    .badge {
        font-size: 0.85rem;
        padding: 0.5rem 0.75rem;
    }
</style>

<script>
    // Handle product type selection
    document.querySelectorAll('input[name="product_type"]').forEach(radio => {
        radio.addEventListener('change', function() {
            console.log('Selected product type:', this.value);
            // In a real implementation, this would load comparison data for the selected product
        });
    });
</script>
@endsection

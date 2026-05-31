@extends('layouts.dashboard')

@section('dashboard_title', __('customer.add_funds_title'))

@section('content')
<!-- Page Header -->
<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold mb-2">
            <i class="bi bi-wallet-plus me-2"></i>
            {{ __('customer.add_funds_header') }}
        </h2>
        <p class="text-muted">{{ __('customer.add_funds_subtitle') }}</p>
    </div>
</div>

<!-- Add Funds Form -->
<div class="row">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <form id="addFundsForm" method="POST" action="{{ route('customer.wallet.add-funds.post') }}" novalidate>
                    @csrf

                    <!-- Amount Selection -->
                    <h5 class="fw-bold mb-3">{{ __('customer.choose_amount') }}</h5>

                    <div class="mb-4">
                        <!-- Quick Amount Buttons -->
                        <div class="mb-3">
                            <label class="fw-bold mb-2">{{ __('customer.quick_amount') }}</label>
                            <div class="btn-group w-100" role="group">
                                <input type="radio" class="btn-check" name="quick-amount" id="amount-50k" value="50000">
                                <label class="btn btn-outline-primary" for="amount-50k">
                                    TZS 50,000
                                </label>

                                <input type="radio" class="btn-check" name="quick-amount" id="amount-100k" value="100000">
                                <label class="btn btn-outline-primary" for="amount-100k">
                                    TZS 100,000
                                </label>

                                <input type="radio" class="btn-check" name="quick-amount" id="amount-250k" value="250000">
                                <label class="btn btn-outline-primary" for="amount-250k">
                                    TZS 250,000
                                </label>

                                <input type="radio" class="btn-check" name="quick-amount" id="amount-500k" value="500000">
                                <label class="btn btn-outline-primary" for="amount-500k">
                                    TZS 500,000
                                </label>
                            </div>
                        </div>

                        <!-- Custom Amount -->
                        <div class="mt-4 pt-3 border-top">
                            <label class="form-label fw-bold">{{ __('customer.or_enter_custom_amount') }}</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text">TZS</span>
                                <input type="number" class="form-control" id="customAmount" name="custom_amount" placeholder="0.00" step="1000" min="10000">
                                <span class="input-group-text">.00</span>
                            </div>
                            <small class="text-muted d-block mt-2">{{ __('customer.min_max_amount') }}</small>
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- Payment Method -->
                    <h5 class="fw-bold mb-3">{{ __('customer.choose_payment_method') }}</h5>

                    <div class="mb-4">
                        <div class="list-group">
                            <!-- M-Pesa -->
                            <label class="list-group-item d-flex gap-3 p-3 cursor-pointer">
                                <input class="form-check-input flex-shrink-0" type="radio" name="payment_method" id="method-mpesa" value="mpesa" checked>
                                <div class="w-100">
                                    <div class="d-flex gap-2 align-items-center">
                                        <h6 class="mb-1 fw-bold">
                                            <i class="bi bi-phone me-2" style="color: #28a745;"></i> M-Pesa
                                        </h6>
                                        <span class="badge bg-success">{{ __('customer.fast') }}</span>
                                    </div>
                                    <p class="text-muted small mb-0">Kulipa kupitia M-Pesa - Haraka na salama</p>
                                </div>
                            </label>

                            <!-- Bank Transfer -->
                            <label class="list-group-item d-flex gap-3 p-3 cursor-pointer">
                                <input class="form-check-input flex-shrink-0" type="radio" name="payment_method" id="method-bank" value="bank">
                                <div class="w-100">
                                    <div class="d-flex gap-2 align-items-center">
                                        <h6 class="mb-1 fw-bold">
                                            <i class="bi bi-bank me-2" style="color: #0066cc;"></i> {{ __('customer.bank_transfer') }}
                                        </h6>
                                        <span class="badge bg-info">{{ __('customer.hours_2_5') }}</span>
                                    </div>
                                    <p class="text-muted small mb-0">{{ __('customer.bank_service_large') }}</p>
                                </div>
                            </label>

                            <!-- Airtel Money -->
                            <label class="list-group-item d-flex gap-3 p-3 cursor-pointer">
                                <input class="form-check-input flex-shrink-0" type="radio" name="payment_method" id="method-airtel" value="airtel">
                                <div class="w-100">
                                    <div class="d-flex gap-2 align-items-center">
                                        <h6 class="mb-1 fw-bold">
                                            <i class="bi bi-phone me-2" style="color: #ff6600;"></i> Airtel Money
                                        </h6>
                                        <span class="badge bg-warning text-dark">{{ __('customer.fast') }}</span>
                                    </div>
                                    <p class="text-muted small mb-0">Kulipa kupitia Airtel Money</p>
                                </div>
                            </label>

                            <!-- TigoPesa -->
                            <label class="list-group-item d-flex gap-3 p-3 cursor-pointer">
                                <input class="form-check-input flex-shrink-0" type="radio" name="payment_method" id="method-tigo" value="tigo">
                                <div class="w-100">
                                    <div class="d-flex gap-2 align-items-center">
                                        <h6 class="mb-1 fw-bold">
                                            <i class="bi bi-phone me-2" style="color: #662d91;"></i> Tigo Pesa
                                        </h6>
                                        <span class="badge bg-secondary">{{ __('customer.fast') }}</span>
                                    </div>
                                    <p class="text-muted small mb-0">Kulipa kupitia Tigo Pesa</p>
                                </div>
                            </label>
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- Terms -->
                    <div class="alert alert-info small mb-4">
                        <i class="bi bi-info-circle me-2"></i>
                        <strong>{{ __('customer.notice') }}:</strong> {{ __('customer.funds_notice') }}
                    </div>

                    <!-- Submit Button -->
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="bi bi-wallet-plus me-2"></i> {{ __('customer.continue_to_pay') }}
                        </button>
                        <a href="{{ route('customer.wallet.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-2"></i> {{ __('customer.back') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Summary Sidebar -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm sticky-top" style="top: 20px;">
            <div class="card-header bg-light border-0 p-4">
                <h5 class="fw-bold mb-0">
                    <i class="bi bi-calculator me-2"></i> {{ __('customer.summary') }}
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="mb-3">
                    <small class="text-muted">Kiasi</small>
                    <div class="fs-4 fw-bold" id="summaryAmount">TZS 0.00</div>
                </div>

                <div class="mb-3">
                    <small class="text-muted">{{ __('customer.payment_method') }}</small>
                    <div class="fw-bold" id="summaryMethod">M-Pesa</div>
                </div>

                <div class="mb-4 p-3 bg-light rounded">
                    <small class="text-muted">{{ __('customer.fees') }}</small>
                    <div class="fw-bold" id="summaryFee">TZS 0.00</div>
                </div>

                <hr>

                <div class="mb-4">
                    <div class="d-flex justify-content-between">
                        <strong>{{ __('customer.total_to_pay') }}</strong>
                        <strong class="fs-5 text-success" id="summaryTotal">TZS 0.00</strong>
                    </div>
                </div>

                <div class="alert alert-success small">
                    <i class="bi bi-check-circle me-1"></i>
                    <strong>{{ __('customer.secure') }}:</strong> {{ __('customer.ssl_encrypted') }}
                </div>

                <div class="alert alert-warning small">
                    <i class="bi bi-exclamation-triangle me-1"></i>
                    {{ __('customer.payment_warning') }}
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .cursor-pointer {
        cursor: pointer;
    }

    .list-group-item {
        border: 1px solid #dee2e6;
        transition: all 0.2s ease;
    }

    .list-group-item:hover {
        background-color: #f8f9fa;
        border-color: #0066cc;
    }

    .list-group-item input[type="radio"]:checked ~ div {
        font-weight: 500;
    }
</style>

<script>
    const customAmountInput = document.getElementById('customAmount');
    const quickAmountButtons = document.querySelectorAll('input[name="quick-amount"]');
    const paymentMethods = document.querySelectorAll('input[name="payment_method"]');
    const form = document.getElementById('addFundsForm');

    function getAmount() {
        const quick = document.querySelector('input[name="quick-amount"]:checked');
        return quick ? parseFloat(quick.value) : (parseFloat(customAmountInput.value) || 0);
    }

    function updateSummary() {
        const amount = getAmount();
        const selectedMethod = document.querySelector('input[name="payment_method"]:checked')?.value || 'mpesa';
        const methodLabels = { mpesa:'M-Pesa', bank:'Bank Transfer', airtel:'Airtel Money', tigo:'Tigo Pesa' };
        const feeRates  = { mpesa:0.02, bank:0, airtel:0.015, tigo:0.02 };
        const fixedFees = { bank:5000 };
        const fee = amount > 0 ? (fixedFees[selectedMethod] ?? (amount * (feeRates[selectedMethod] ?? 0))) : 0;

        document.getElementById('summaryAmount').textContent = `TZS ${amount.toLocaleString('en-US', {minimumFractionDigits:2})}`;
        document.getElementById('summaryMethod').textContent  = methodLabels[selectedMethod] || selectedMethod;
        document.getElementById('summaryFee').textContent     = `TZS ${fee.toLocaleString('en-US', {minimumFractionDigits:2})}`;
        document.getElementById('summaryTotal').textContent   = `TZS ${(amount+fee).toLocaleString('en-US', {minimumFractionDigits:2})}`;
    }

    /* Quick-amount → fill hidden custom_amount field */
    quickAmountButtons.forEach(btn => {
        btn.addEventListener('change', function() {
            customAmountInput.value = '';
            updateSummary();
        });
    });

    customAmountInput.addEventListener('input', function() {
        quickAmountButtons.forEach(b => b.checked = false);
        updateSummary();
    });

    paymentMethods.forEach(m => m.addEventListener('change', updateSummary));

    /* Override form submit — populate custom_amount before submitting */
    form.addEventListener('submit', function(e) {
        const amount = getAmount();
        if (!amount || amount < 1000) {
            e.preventDefault();
            bkToast('Please enter a valid amount (minimum TZS 1,000)', 'error');
            return;
        }
        /* Put resolved amount into custom_amount so controller picks it up */
        customAmountInput.value = amount;
    });

    updateSummary();
</script>
@endsection

@extends('layouts.dashboard')

@section('dashboard_title', 'Get Quote')

@section('dashboard_content')
<!-- Page Header -->
<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold mb-2">
            <i class="bi bi-receipt me-2"></i>
            Pata Quoted ya Bei
        </h2>
        <p class="text-muted">Pata quoted maalum kwa bima inayokubidii</p>
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
                        <label class="form-label fw-bold mb-3">Aina ya Bima</label>
                        <div id="productSelection">
                            <div class="btn-group-vertical w-100" role="group">
                                <input type="radio" class="btn-check" name="product" id="product_motor" value="motor" {{ request('product') == 'motor' ? 'checked' : '' }}>
                                <label class="btn btn-outline-primary text-start" for="product_motor">
                                    <i class="bi bi-car-front-fill me-2"></i>
                                    <strong>Bima ya Motor</strong>
                                    <br>
                                    <small class="text-muted">Protekta gari lako</small>
                                </label>

                                <input type="radio" class="btn-check" name="product" id="product_health" value="health" {{ request('product') == 'health' ? 'checked' : '' }}>
                                <label class="btn btn-outline-primary text-start" for="product_health">
                                    <i class="bi bi-heart-pulse-fill me-2"></i>
                                    <strong>Bima ya Afya</strong>
                                    <br>
                                    <small class="text-muted">Huduma za uzamili</small>
                                </label>

                                <input type="radio" class="btn-check" name="product" id="product_property" value="property" {{ request('product') == 'property' ? 'checked' : '' }}>
                                <label class="btn btn-outline-primary text-start" for="product_property">
                                    <i class="bi bi-house-fill me-2"></i>
                                    <strong>Bima ya Mali</strong>
                                    <br>
                                    <small class="text-muted">Protekta nyumba yako</small>
                                </label>

                                <input type="radio" class="btn-check" name="product" id="product_travel" value="travel" {{ request('product') == 'travel' ? 'checked' : '' }}>
                                <label class="btn btn-outline-primary text-start" for="product_travel">
                                    <i class="bi bi-airplane-fill me-2"></i>
                                    <strong>Bima ya Safari</strong>
                                    <br>
                                    <small class="text-muted">Kwa ajili ya safari</small>
                                </label>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- Personal Information -->
                    <h5 class="fw-bold mb-3">Taarifa za Binafsi</h5>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Jina Kamili</label>
                            <input type="text" class="form-control" value="{{ auth()->user()->name }}" disabled>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Barua Pepe</label>
                            <input type="email" class="form-control" value="{{ auth()->user()->email }}" disabled>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Simu</label>
                            <input type="tel" class="form-control" name="phone" placeholder="+255 7XX XXX XXX" value="{{ auth()->user()->phone_number ?? '' }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tarehe ya Kuzaliwa</label>
                            <input type="date" class="form-control" name="date_of_birth" required>
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- Coverage Details -->
                    <h5 class="fw-bold mb-3">Maelezo ya Ushindi</h5>

                    <div class="mb-3">
                        <label class="form-label">Kiwango cha Ushindi</label>
                        <select class="form-select" name="coverage_level" required>
                            <option value="">Chagua kiwango...</option>
                            <option value="basic">Basic - TZS 50,000</option>
                            <option value="standard">Standard - TZS 100,000</option>
                            <option value="premium">Premium - TZS 200,000</option>
                            <option value="elite">Elite - TZS 500,000</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Kipindi cha Ushindi</label>
                        <select class="form-select" name="coverage_period" required>
                            <option value="">Chagua kipindi...</option>
                            <option value="monthly">Kila Mwezi</option>
                            <option value="quarterly">Kila Miezi Mitatu</option>
                            <option value="semi_annual">Nusu Mwaka</option>
                            <option value="annual">Kila Mwaka</option>
                        </select>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="d-flex gap-2 pt-4">
                        <a href="{{ route('customer.buy') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-2"></i> Rudi Nyuma
                        </a>
                        <button type="submit" class="btn btn-primary ms-auto">
                            <i class="bi bi-check-circle me-2"></i> Pata Bei
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
                <h5 class="fw-bold mb-0">Muhtasari wa Quoted</h5>
            </div>
            <div class="card-body p-4">
                <div class="mb-3">
                    <small class="text-muted">Aina ya Bima</small>
                    <div class="fw-bold" id="summaryProduct">-</div>
                </div>

                <div class="mb-3">
                    <small class="text-muted">Kiwango cha Ushindi</small>
                    <div class="fw-bold" id="summaryCoverage">-</div>
                </div>

                <div class="mb-4">
                    <small class="text-muted">Kipindi</small>
                    <div class="fw-bold" id="summaryPeriod">-</div>
                </div>

                <hr>

                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Gharama ya Kila Mwezi:</span>
                        <h5 class="fw-bold mb-0" id="summaryPrice">TZS 0</h5>
                    </div>
                </div>

                <div class="alert alert-info small">
                    <i class="bi bi-info-circle me-2"></i>
                    <strong>Ukumbuke:</strong> Hii ni quoted tu. Bei halisi itabadilika kulingana na maelezo yako.
                </div>

                <button class="btn btn-primary w-100" disabled>
                    <i class="bi bi-lock me-2"></i> Ili kuendelea, jaza fomu
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // Update summary based on form input
    document.querySelectorAll('input[name="product"], select[name="coverage_level"]').forEach(el => {
        el.addEventListener('change', updateSummary);
    });

    function updateSummary() {
        const product = document.querySelector('input[name="product"]:checked')?.value || '-';
        const coverage = document.querySelector('select[name="coverage_level"]')?.value || '-';
        
        // Update display
        const productNames = {
            'motor': 'Bima ya Motor',
            'health': 'Bima ya Afya',
            'property': 'Bima ya Mali',
            'travel': 'Bima ya Safari'
        };
        
        const coveragePrices = {
            'basic': 'TZS 50,000',
            'standard': 'TZS 100,000',
            'premium': 'TZS 200,000',
            'elite': 'TZS 500,000'
        };
        
        document.getElementById('summaryProduct').textContent = productNames[product] || '-';
        document.getElementById('summaryCoverage').textContent = coverage || '-';
        document.getElementById('summaryPrice').textContent = coveragePrices[coverage] || 'TZS 0';
    }

    // Initialize summary
    updateSummary();
</script>
@endsection

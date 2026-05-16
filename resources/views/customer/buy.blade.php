@extends('layouts.dashboard')

@section('dashboard_title', 'Buy Insurance')

@section('dashboard_content')
<!-- Page Header -->
<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold mb-2">
            <i class="bi bi-cart-plus me-2"></i>
            Nunua Bima Mpya
        </h2>
        <p class="text-muted">Chagua moja ya bidhaa zetu za bima na uanze ulinzi wako leo</p>
    </div>
</div>

<!-- Available Insurance Products -->
<div class="row g-4">
    <!-- Motor Insurance -->
    <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100 hover-shadow" style="transition: all 0.3s ease; cursor: pointer;">
            <div class="card-body p-4">
                <div class="mb-3">
                    <i class="bi bi-car-front-fill" style="font-size: 3rem; color: #0066cc;"></i>
                </div>
                <h5 class="card-title fw-bold mb-2">Motor Insurance</h5>
                <p class="card-text text-muted small mb-3">
                    Protekta gari lako kutokana na ajali, fujo, na madhimuni mengine
                </p>
                <div class="mb-3">
                    <small class="text-success fw-bold">
                        <i class="bi bi-check-circle me-1"></i>
                        Mipango mbalimbali inayopatikana
                    </small>
                </div>
                <button class="btn btn-primary btn-sm w-100" onclick="selectProduct('motor')">
                    Jua Zaidi <i class="bi bi-arrow-right ms-1"></i>
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
                <h5 class="card-title fw-bold mb-2">Health Insurance</h5>
                <p class="card-text text-muted small mb-3">
                    Mkakati wa afya na huduma za uzamili za hospitali
                </p>
                <div class="mb-3">
                    <small class="text-success fw-bold">
                        <i class="bi bi-check-circle me-1"></i>
                        Mtaala wa malipo mabaya
                    </small>
                </div>
                <button class="btn btn-primary btn-sm w-100" onclick="selectProduct('health')">
                    Jua Zaidi <i class="bi bi-arrow-right ms-1"></i>
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
                <h5 class="card-title fw-bold mb-2">Property Insurance</h5>
                <p class="card-text text-muted small mb-3">
                    Protekta nyumba na mali yako kutokana na woga na uharibifu
                </p>
                <div class="mb-3">
                    <small class="text-success fw-bold">
                        <i class="bi bi-check-circle me-1"></i>
                        Ushindi kamili
                    </small>
                </div>
                <button class="btn btn-primary btn-sm w-100" onclick="selectProduct('property')">
                    Jua Zaidi <i class="bi bi-arrow-right ms-1"></i>
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
                <h5 class="card-title fw-bold mb-2">Travel Insurance</h5>
                <p class="card-text text-muted small mb-3">
                    Sisi karibu kukamatia hazard ambapo rafiki unasafiri
                </p>
                <div class="mb-3">
                    <small class="text-success fw-bold">
                        <i class="bi bi-check-circle me-1"></i>
                        Ushindi wa dunia
                    </small>
                </div>
                <button class="btn btn-primary btn-sm w-100" onclick="selectProduct('travel')">
                    Jua Zaidi <i class="bi bi-arrow-right ms-1"></i>
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
                <h5 class="card-title fw-bold mb-2">Business Insurance</h5>
                <p class="card-text text-muted small mb-3">
                    Protekta kazi yako kutokana na mambo yasiyotarajiwa
                </p>
                <div class="mb-3">
                    <small class="text-success fw-bold">
                        <i class="bi bi-check-circle me-1"></i>
                        Mipango ya kituo
                    </small>
                </div>
                <button class="btn btn-primary btn-sm w-100" onclick="selectProduct('business')">
                    Jua Zaidi <i class="bi bi-arrow-right ms-1"></i>
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
                <h5 class="card-title fw-bold mb-2">Life Insurance</h5>
                <p class="card-text text-muted small mb-3">
                    Hakikisha kwa familia yako inashangilia kwa sababu ya kifo chako
                </p>
                <div class="mb-3">
                    <small class="text-success fw-bold">
                        <i class="bi bi-check-circle me-1"></i>
                        Gharama za mazishi
                    </small>
                </div>
                <button class="btn btn-primary btn-sm w-100" onclick="selectProduct('life')">
                    Jua Zaidi <i class="bi bi-arrow-right ms-1"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Why Choose Bima Kwik -->
<div class="row mt-5">
    <div class="col-12">
        <div class="card border-0 shadow-sm p-4" style="background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);">
            <h4 class="fw-bold mb-4">Kwa Nini Chagua Bima Kwik?</h4>
            <div class="row g-3">
                <div class="col-md-3">
                    <div class="d-flex gap-3">
                        <div>
                            <i class="bi bi-lightning-fill" style="font-size: 1.5rem; color: #ffc107;"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold">Haraka na Rahisi</h6>
                            <small class="text-muted">Karibu na dakika 5 tu</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="d-flex gap-3">
                        <div>
                            <i class="bi bi-percent" style="font-size: 1.5rem; color: #28a745;"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold">Bei Nafuu</h6>
                            <small class="text-muted">Gharama najiibu na waloweza</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="d-flex gap-3">
                        <div>
                            <i class="bi bi-shield-check" style="font-size: 1.5rem; color: #0066cc;"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold">Salama</h6>
                            <small class="text-muted">Imefungwa na TIRA</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="d-flex gap-3">
                        <div>
                            <i class="bi bi-24-hours" style="font-size: 1.5rem; color: #dc3545;"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold">Msaada wa 24/7</h6>
                            <small class="text-muted">Daima tupo kwa ajili yako</small>
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
        <h4 class="fw-bold mb-4">Maswali Yanayoulizwa Mara Kwa Mara</h4>
        <div class="accordion" id="faqAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqOne">
                        Ni kiasi gani cha gharama ya bima?
                    </button>
                </h2>
                <div id="faqOne" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Gharama ya bima inategemea aina ya bima na kiwango cha ushindi ulioochaguliwa. Unaweza kuona makadirio ya bei kwenye kila bidhaa.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqTwo">
                        Je, ni haraka ngapi kupata bima?
                    </button>
                </h2>
                <div id="faqTwo" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Unaweza kupata bima karibu na dakika 5 tu kwa kumjaza fomu na kulipa. Hati yako itakuja kwenye barua pepe yako mara moja.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqThree">
                        Kwa nini bima inastahili ushindi?
                    </button>
                </h2>
                <div id="faqThree" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Bima inakusaidia kupanga mahitaji ya baadaye. Inakufanya uwe tayari kwa matatizo yasiyotarajiwa na kulinganisha kila kitu.
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

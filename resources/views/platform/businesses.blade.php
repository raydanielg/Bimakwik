@extends('layouts.landing')

@section('content')
<section class="py-5 bg-white" style="margin-top: 80px;">
    <div class="container py-5">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-8">
                <h6 class="text-primary fw-bold text-uppercase letter-spacing-1 mb-3">Global Expansion</h6>
                <h1 class="display-4 fw-bold mb-4">Scaling Across Borders</h1>
                <p class="lead text-secondary">Born in Tanzania, Bima Kwik is built to scale. Our TIRAMIS architecture is designed for multi-country deployment.</p>
            </div>
        </div>

        <div class="row align-items-center g-5 py-4">
            <div class="col-lg-6">
                <h2 class="fw-bold mb-4">Multi-Country Instances</h2>
                <p class="text-muted mb-4">Our platform supports multiple currencies, languages, and regulatory frameworks, allowing for localized instances in every African market.</p>
                <div class="d-flex align-items-center mb-4">
                    <div class="bg-primary text-white rounded-circle p-2 me-3"><i class="bi bi-check"></i></div>
                    <span class="fw-bold">Localized Compliance</span>
                </div>
                <div class="d-flex align-items-center mb-4">
                    <div class="bg-primary text-white rounded-circle p-2 me-3"><i class="bi bi-check"></i></div>
                    <span class="fw-bold">Multi-Currency Engine</span>
                </div>
                <div class="d-flex align-items-center">
                    <div class="bg-primary text-white rounded-circle p-2 me-3"><i class="bi bi-check"></i></div>
                    <span class="fw-bold">Regional Data Centers</span>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="bg-primary bg-opacity-10 p-5 rounded-5 border-start border-5 border-primary">
                    <h3 class="fw-bold mb-4">TIRAMIS Replicable</h3>
                    <p class="text-dark mb-4">The core of our success is the <strong>TIRAMIS</strong> architecture—a plug-and-play insurance management system that can be replicated in new countries in record time.</p>
                    <div class="alert alert-primary bg-white border-0 shadow-sm rounded-4 mb-0">
                        <h6 class="fw-bold text-primary"><i class="bi bi-gear-wide-connected me-2"></i> How it works:</h6>
                        <p class="small text-muted mb-0">We take our proven Tanzanian model and adapt the legal, tax, and regulatory parameters for the target country, ensuring a fast and compliant market entry.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container text-center py-5">
        <h2 class="fw-bold mb-5">The Bima Kwik Roadmap</h2>
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="p-4 bg-white rounded-4 shadow-sm mb-4">
                    <h5 class="fw-bold text-primary">Stage 1</h5>
                    <p class="small text-muted">Tanzania Foundation (TIRA Integration)</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-4 bg-white rounded-4 shadow-sm mb-4">
                    <h5 class="fw-bold">Stage 2</h5>
                    <p class="small text-muted">East Africa Expansion (Kenya, Uganda, Rwanda)</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-4 bg-white rounded-4 shadow-sm mb-4">
                    <h5 class="fw-bold">Stage 3</h5>
                    <p class="small text-muted">Pan-African Scaling (West & Central Africa)</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@extends('layouts.landing')

@section('content')
<section class="py-5 bg-light position-relative overflow-hidden" style="margin-top: 80px;">
    <div class="position-absolute top-0 start-0 translate-middle bg-primary opacity-5 rounded-circle" style="width: 400px; height: 400px;"></div>
    
    <div class="container py-5 position-relative">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-8">
                <h6 class="text-primary fw-bold text-uppercase letter-spacing-1 mb-3">Platform Overview</h6>
                <h1 class="display-4 fw-bold mb-4">What is Bima Kwik?</h1>
                <p class="lead text-secondary">Bima Kwik is Africa's premier digital insurance infrastructure, connecting everyone in the insurance ecosystem through a single, powerful platform.</p>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm p-4 rounded-4 hover-lift">
                    <div class="icon-box mb-3 bg-primary bg-opacity-10 rounded-3 p-3 d-inline-block text-primary">
                        <i class="bi bi-shield-check fs-2"></i>
                    </div>
                    <h4 class="fw-bold">Regulated & Secure</h4>
                    <p class="text-muted">Fully licensed by TIRA and built on enterprise-grade security standards to protect all stakeholders.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm p-4 rounded-4 hover-lift">
                    <div class="icon-box mb-3 bg-success bg-opacity-10 rounded-3 p-3 d-inline-block text-success">
                        <i class="bi bi-cpu fs-2"></i>
                    </div>
                    <h4 class="fw-bold">Digital First</h4>
                    <p class="text-muted">A 100% digital journey from product discovery to policy issuance and claims settlement.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm p-4 rounded-4 hover-lift">
                    <div class="icon-box mb-3 bg-warning bg-opacity-10 rounded-3 p-3 d-inline-block text-warning">
                        <i class="bi bi-people fs-2"></i>
                    </div>
                    <h4 class="fw-bold">Inclusion Driven</h4>
                    <p class="text-muted">Changing the narrative of insurance from an expense to a vital financial protection tool for all Africans.</p>
                </div>
            </div>
        </div>

        <div class="row align-items-center py-5">
            <div class="col-lg-6">
                <img src="{{ asset('hero/black-man-shaking-hands_780608-4320.jpg') }}" class="img-fluid rounded-5 shadow-lg" alt="Bima Kwik Ecosystem">
            </div>
            <div class="col-lg-6 ps-lg-5">
                <h2 class="fw-bold mb-4">Our Ecosystem</h2>
                <p class="text-muted mb-4">We bring together Insurers, Brokers, Agents, Service Providers, and Customers into one unified digital space. This connectivity ensures transparency, speed, and efficiency for everyone involved.</p>
                <ul class="list-unstyled">
                    <li class="mb-3 d-flex align-items-center"><i class="bi bi-check-circle-fill text-primary me-3"></i> Unified API Gateway</li>
                    <li class="mb-3 d-flex align-items-center"><i class="bi bi-check-circle-fill text-primary me-3"></i> Multi-Channel Distribution</li>
                    <li class="mb-3 d-flex align-items-center"><i class="bi bi-check-circle-fill text-primary me-3"></i> Real-time Data Analytics</li>
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection

@extends('layouts.landing')

@section('content')
<section class="py-5 bg-light" style="margin-top: 80px;">
    <div class="container py-5">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-8">
                <h6 class="text-primary fw-bold text-uppercase letter-spacing-1 mb-3">Technology</h6>
                <h1 class="display-4 fw-bold mb-4">The Future is Digital</h1>
                <p class="lead text-secondary">Bima Kwik is powered by advanced AI and a robust API-first architecture designed for scale and security.</p>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-lg-6">
                <div class="card h-100 border-0 shadow-sm p-5 rounded-5 animate__animated animate__fadeInLeft">
                    <div class="bg-primary bg-opacity-10 rounded-circle p-3 d-inline-block mb-4">
                        <i class="bi bi-robot text-primary fs-2"></i>
                    </div>
                    <h3 class="fw-bold mb-3">AI-Powered Platform</h3>
                    <p class="text-muted mb-4">Our AI engines provide smart recommendations, detect fraud patterns, and automate routine claim assessments to save you time and money.</p>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="bi bi-check2 text-primary me-2"></i> Smart Product Matching</li>
                        <li class="mb-2"><i class="bi bi-check2 text-primary me-2"></i> Automated Risk Assessment</li>
                        <li class="mb-2"><i class="bi bi-check2 text-primary me-2"></i> Fraud Detection Algorithms</li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card h-100 border-0 shadow-sm p-5 rounded-5 animate__animated animate__fadeInRight">
                    <div class="bg-info bg-opacity-10 rounded-circle p-3 d-inline-block mb-4">
                        <i class="bi bi-plug-fill text-info fs-2"></i>
                    </div>
                    <h3 class="fw-bold mb-3">API Integration</h3>
                    <p class="text-muted mb-4">Our "BimaConnect" API allows insurers, brokers, and partners to integrate our capabilities into their own systems seamlessly.</p>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="bi bi-check2 text-info me-2"></i> RESTful API Standards</li>
                        <li class="mb-2"><i class="bi bi-check2 text-info me-2"></i> Secure Webhooks</li>
                        <li class="mb-2"><i class="bi bi-check2 text-info me-2"></i> Sandbox for Developers</li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card h-100 border-0 shadow-sm p-5 rounded-5 animate__animated animate__fadeInLeft">
                    <div class="bg-success bg-opacity-10 rounded-circle p-3 d-inline-block mb-4">
                        <i class="bi bi-code-square text-success fs-2"></i>
                    </div>
                    <h3 class="fw-bold mb-3">Low-Code Builder</h3>
                    <p class="text-muted mb-4">Insurers can launch new products in days instead of months using our visual product builder and rules engine.</p>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card h-100 border-0 shadow-sm p-5 rounded-5 animate__animated animate__fadeInRight">
                    <div class="bg-danger bg-opacity-10 rounded-circle p-3 d-inline-block mb-4">
                        <i class="bi bi-shield-lock text-danger fs-2"></i>
                    </div>
                    <h3 class="fw-bold mb-3">Security & Compliance</h3>
                    <p class="text-muted mb-4">We adhere to the highest data protection standards (ISO 27001) and are fully compliant with TIRA and GDPR regulations.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

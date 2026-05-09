@extends('layouts.landing')

@section('content')
<section class="py-5 bg-light">
    <div class="container py-5 mt-5">
        <div class="text-center mb-5 animate__animated animate__fadeIn">
            <span class="badge rounded-pill bg-primary bg-opacity-10 text-primary px-3 py-2 mb-3">RESOURCE CENTER</span>
            <h1 class="display-4 fw-bold">Guidelines & Materials</h1>
            <p class="text-secondary mx-auto" style="max-width: 600px;">Explore our comprehensive guides and download essential materials to help you navigate our services with ease.</p>
        </div>

        <!-- Guidelines Section -->
        <div class="row g-4 mb-5">
            <div class="col-12">
                <h3 class="fw-bold mb-4 d-flex align-items-center">
                    <span class="bg-primary p-2 rounded-3 me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                        <i class="bi bi-book text-white small"></i>
                    </span>
                    Step-by-Step Guidelines
                </h3>
            </div>
            
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 h-100 hover-lift">
                    <div class="bg-primary bg-opacity-10 rounded-circle p-3 d-inline-flex mb-4">
                        <i class="bi bi-file-earmark-text text-primary fs-4"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Claim Process Guide</h5>
                    <p class="text-secondary small mb-4">A complete walk-through on how to file, document, and track your insurance claims efficiently.</p>
                    <a href="#" class="text-primary fw-bold text-decoration-none small mt-auto">Learn More <i class="bi bi-arrow-right ms-1"></i></a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 h-100 hover-lift">
                    <div class="bg-primary bg-opacity-10 rounded-circle p-3 d-inline-flex mb-4">
                        <i class="bi bi-shield-check text-primary fs-4"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Policy Management</h5>
                    <p class="text-secondary small mb-4">Instructions on how to manage your dashboard, update your profile, and renew your policies online.</p>
                    <a href="#" class="text-primary fw-bold text-decoration-none small mt-auto">Learn More <i class="bi bi-arrow-right ms-1"></i></a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 h-100 hover-lift">
                    <div class="bg-primary bg-opacity-10 rounded-circle p-3 d-inline-flex mb-4">
                        <i class="bi bi-person-lock text-primary fs-4"></i>
                    </div>
                    <h5 class="fw-bold mb-3">KYC & Verification</h5>
                    <p class="text-secondary small mb-4">Guidelines on required documents and how to complete your KYC verification process quickly.</p>
                    <a href="#" class="text-primary fw-bold text-decoration-none small mt-auto">Learn More <i class="bi bi-arrow-right ms-1"></i></a>
                </div>
            </div>
        </div>

        <!-- Materials Section -->
        <div class="row g-4">
            <div class="col-12">
                <h3 class="fw-bold mb-4 d-flex align-items-center">
                    <span class="bg-success p-2 rounded-3 me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                        <i class="bi bi-download text-white small"></i>
                    </span>
                    Downloadable Materials
                </h3>
            </div>

            <div class="col-md-6">
                <div class="card border-0 shadow-sm rounded-4 p-4 hover-lift">
                    <div class="d-flex align-items-center">
                        <div class="bg-success bg-opacity-10 rounded-4 p-3 me-4">
                            <i class="bi bi-file-pdf fs-2 text-success"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="fw-bold mb-1">Company Brochure 2026</h5>
                            <p class="text-secondary small mb-0">Overview of all our products and services in one PDF.</p>
                        </div>
                        <a href="#" class="btn btn-light rounded-circle shadow-sm"><i class="bi bi-download"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card border-0 shadow-sm rounded-4 p-4 hover-lift">
                    <div class="d-flex align-items-center">
                        <div class="bg-success bg-opacity-10 rounded-4 p-3 me-4">
                            <i class="bi bi-file-earmark-medical fs-2 text-success"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="fw-bold mb-1">Claim Application Form</h5>
                            <p class="text-secondary small mb-0">Standard form for filing any insurance claim.</p>
                        </div>
                        <a href="#" class="btn btn-light rounded-circle shadow-sm"><i class="bi bi-download"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .hover-lift {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .hover-lift:hover {
        transform: translateY(-10px);
        box-shadow: 0 1rem 3rem rgba(0,0,0,.08) !important;
    }
</style>
@endsection
@endsection

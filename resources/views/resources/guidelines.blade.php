@extends('layouts.landing')

@section('content')
<!-- Hero Section with Breadcrumbs -->
<section class="py-5 bg-light position-relative overflow-hidden">
    <!-- Decorative Shapes -->
    <div class="position-absolute top-0 start-0 translate-middle bg-primary opacity-5 rounded-circle" style="width: 400px; height: 400px;"></div>
    <div class="position-absolute bottom-0 end-0 translate-middle bg-success opacity-5 rounded-circle" style="width: 300px; height: 300px;"></div>

    <div class="container py-5 mt-5 position-relative">
        <nav aria-label="breadcrumb" class="mb-4 animate__animated animate__fadeInDown">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none text-primary">Home</a></li>
                <li class="breadcrumb-item"><a href="#" class="text-decoration-none text-secondary">Resources</a></li>
                <li class="breadcrumb-item active fw-bold" aria-current="page">Guidelines & Materials</li>
            </ol>
        </nav>

        <div class="text-center mb-5 animate__animated animate__fadeIn">
            <span class="badge rounded-pill bg-primary bg-opacity-10 text-primary px-3 py-2 mb-3">RESOURCE CENTER</span>
            <h1 class="display-4 fw-bold">Guidelines & Materials</h1>
            <p class="text-secondary mx-auto" style="max-width: 600px;">Explore our comprehensive guides and download essential materials to help you navigate our services with ease.</p>
        </div>

        <!-- Guidelines Section -->
        <div class="row g-4 mb-5">
            <div class="col-12">
                <h3 class="fw-bold mb-4 d-flex align-items-center animate__animated animate__fadeInLeft">
                    <span class="bg-primary p-2 rounded-3 me-3 d-flex align-items-center justify-content-center pulse-primary" style="width: 45px; height: 45px;">
                        <i class="bi bi-book text-white"></i>
                    </span>
                    Step-by-Step Guidelines
                </h3>
            </div>
            
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 h-100 hover-lift animate__animated animate__fadeInUp" style="animation-delay: 0.1s;">
                    <div class="icon-box bg-primary bg-opacity-10 rounded-circle p-3 d-inline-flex mb-4">
                        <i class="bi bi-file-earmark-text text-primary fs-3"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Claim Process Guide</h5>
                    <p class="text-secondary small mb-4">A complete walk-through on how to file, document, and track your insurance claims efficiently.</p>
                    <a href="{{ route('guidelines.claim-process') }}" class="btn btn-outline-primary btn-sm rounded-pill px-4 mt-auto">Learn More <i class="bi bi-arrow-right ms-1"></i></a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 h-100 hover-lift animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
                    <div class="icon-box bg-primary bg-opacity-10 rounded-circle p-3 d-inline-flex mb-4">
                        <i class="bi bi-shield-check text-primary fs-3"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Policy Management</h5>
                    <p class="text-secondary small mb-4">Instructions on how to manage your dashboard, update your profile, and renew your policies online.</p>
                    <a href="{{ route('guidelines.policy-management') }}" class="btn btn-outline-primary btn-sm rounded-pill px-4 mt-auto">Learn More <i class="bi bi-arrow-right ms-1"></i></a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 h-100 hover-lift animate__animated animate__fadeInUp" style="animation-delay: 0.3s;">
                    <div class="icon-box bg-primary bg-opacity-10 rounded-circle p-3 d-inline-flex mb-4">
                        <i class="bi bi-person-lock text-primary fs-3"></i>
                    </div>
                    <h5 class="fw-bold mb-3">KYC & Verification</h5>
                    <p class="text-secondary small mb-4">Guidelines on required documents and how to complete your KYC verification process quickly.</p>
                    <a href="{{ route('guidelines.kyc-verification') }}" class="btn btn-outline-primary btn-sm rounded-pill px-4 mt-auto">Learn More <i class="bi bi-arrow-right ms-1"></i></a>
                </div>
            </div>
        </div>

        <!-- Materials Section -->
        <div class="row g-4">
            <div class="col-12">
                <h3 class="fw-bold mb-4 d-flex align-items-center animate__animated animate__fadeInLeft">
                    <span class="bg-success p-2 rounded-3 me-3 d-flex align-items-center justify-content-center pulse-success" style="width: 45px; height: 45px;">
                        <i class="bi bi-download text-white"></i>
                    </span>
                    Downloadable Materials
                </h3>
            </div>

            <div class="col-md-6">
                <div class="card border-0 shadow-sm rounded-4 p-4 hover-lift animate__animated animate__fadeInLeft">
                    <div class="d-flex align-items-center">
                        <div class="icon-box bg-success bg-opacity-10 rounded-4 p-3 me-4">
                            <i class="bi bi-file-pdf fs-1 text-success"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="fw-bold mb-1">Company Brochure 2026</h5>
                            <p class="text-secondary small mb-0">Overview of all our products and services in one PDF.</p>
                        </div>
                        <a href="#" class="btn btn-light rounded-circle shadow-sm p-3 hover-rotate"><i class="bi bi-download"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card border-0 shadow-sm rounded-4 p-4 hover-lift animate__animated animate__fadeInRight">
                    <div class="d-flex align-items-center">
                        <div class="icon-box bg-success bg-opacity-10 rounded-4 p-3 me-4">
                            <i class="bi bi-file-earmark-medical fs-1 text-success"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="fw-bold mb-1">Claim Application Form</h5>
                            <p class="text-secondary small mb-0">Standard form for filing any insurance claim.</p>
                        </div>
                        <a href="#" class="btn btn-light rounded-circle shadow-sm p-3 hover-rotate"><i class="bi bi-download"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .breadcrumb-item + .breadcrumb-item::before {
        content: "\F138";
        font-family: "bootstrap-icons";
        font-size: 0.75rem;
        color: #6c757d;
    }
    .hover-lift {
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    }
    .hover-lift:hover {
        transform: translateY(-12px);
        box-shadow: 0 1.5rem 4rem rgba(0,0,0,.1) !important;
    }
    .icon-box {
        transition: all 0.3s ease;
    }
    .hover-lift:hover .icon-box {
        transform: scale(1.1) rotate(5deg);
    }
    .hover-rotate:hover i {
        display: inline-block;
        animation: rotate 0.5s ease-in-out;
    }
    @keyframes rotate {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    .pulse-primary {
        box-shadow: 0 0 0 0 rgba(13, 110, 253, 0.4);
        animation: pulse-primary 2s infinite;
    }
    @keyframes pulse-primary {
        0% { box-shadow: 0 0 0 0 rgba(13, 110, 253, 0.4); }
        70% { box-shadow: 0 0 0 10px rgba(13, 110, 253, 0); }
        100% { box-shadow: 0 0 0 0 rgba(13, 110, 253, 0); }
    }
    .pulse-success {
        box-shadow: 0 0 0 0 rgba(25, 135, 84, 0.4);
        animation: pulse-success 2s infinite;
    }
    @keyframes pulse-success {
        0% { box-shadow: 0 0 0 0 rgba(25, 135, 84, 0.4); }
        70% { box-shadow: 0 0 0 10px rgba(25, 135, 84, 0); }
        100% { box-shadow: 0 0 0 0 rgba(25, 135, 84, 0); }
    }
</style>
@endsection

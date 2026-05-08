@extends('layouts.landing')

@section('content')
<section class="py-5 bg-white overflow-hidden">
    <div class="container py-5 mt-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 animate__animated animate__fadeInLeft">
                <span class="badge rounded-pill bg-primary-soft text-primary px-3 py-2 mb-3">ABOUT BIMAKWIK</span>
                <h1 class="display-4 fw-bold mb-4">Securing Tanzania's Future, One Policy at a Time.</h1>
                <p class="lead text-secondary mb-4">BimaKwik is a leading digital insurance aggregator in Tanzania, dedicated to making insurance accessible, understandable, and affordable for everyone.</p>
                <div class="row g-4 mb-5">
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center gap-3">
                            <div class="feature-icon-sm bg-primary text-white">
                                <i class="bi bi-shield-check"></i>
                            </div>
                            <h6 class="fw-bold mb-0">Trusted Partner</h6>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center gap-3">
                            <div class="feature-icon-sm bg-success text-white">
                                <i class="bi bi-phone"></i>
                            </div>
                            <h6 class="fw-bold mb-0">100% Digital</h6>
                        </div>
                    </div>
                </div>
                <a href="{{ route('quote.request') }}" class="btn-quote-custom">
                    <span>Our Journey</span>
                    <div class="icon-circle">
                        <i class="bi bi-chevron-right"></i>
                    </div>
                </a>
            </div>
            <div class="col-lg-6 animate__animated animate__fadeInRight">
                <div class="position-relative">
                    <img src="https://www.bimakwik.com/wp-content/uploads/2024/07/family.webp" class="img-fluid rounded-4 shadow-lg" alt="About BimaKwik">
                    <div class="position-absolute bottom-0 start-0 bg-white p-4 rounded-4 shadow-sm m-4 d-none d-md-block">
                        <h2 class="fw-bold text-primary mb-0">10k+</h2>
                        <p class="text-secondary small mb-0">Active Users Across Tanzania</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container py-5">
        <div class="row g-4 text-center">
            <div class="col-md-4">
                <div class="p-4 bg-white rounded-4 shadow-sm h-100">
                    <h3 class="fw-bold text-primary mb-3">Our Mission</h3>
                    <p class="text-secondary">To revolutionize the insurance industry in Tanzania through digital innovation and exceptional customer service.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 bg-white rounded-4 shadow-sm h-100">
                    <h3 class="fw-bold text-primary mb-3">Our Vision</h3>
                    <p class="text-secondary">To be the most trusted and preferred digital gateway for all insurance needs in East Africa.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 bg-white rounded-4 shadow-sm h-100">
                    <h3 class="fw-bold text-primary mb-3">Our Values</h3>
                    <p class="text-secondary">Transparency, Innovation, Customer-Centricity, and Integrity in everything we do.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .bg-primary-soft { background-color: rgba(0, 86, 179, 0.1); }
    .feature-icon-sm {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
@endsection

@extends('layouts.landing')

@section('content')
<!-- Help Center Hero -->
<section class="py-5 bg-primary text-white text-center" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%); margin-top: 80px;">
    <div class="container py-5">
        <h1 class="display-4 fw-bold mb-3 animate__animated animate__fadeInDown">Help Center</h1>
        <p class="lead mb-4 animate__animated animate__fadeInUp">We're here to help you get the most out of Bima Kwik.</p>
        <div class="row justify-content-center animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
            <div class="col-lg-6">
                <div class="input-group input-group-lg shadow-sm">
                    <span class="input-group-text bg-white border-0"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" class="form-control border-0 px-4" placeholder="Search for help (e.g. how to file a claim)...">
                    <button class="btn btn-warning px-4 fw-bold" type="button">Search</button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Support Channels -->
<section class="py-5 bg-light">
    <div class="container py-5">
        <div class="row g-4 justify-content-center">
            <!-- Live Chat -->
            <div class="col-lg-4 col-md-6 animate__animated animate__fadeInUp" style="animation-delay: 0.1s;">
                <div class="card border-0 shadow-sm h-100 p-4 text-center hover-lift">
                    <div class="icon-box mb-4 mx-auto bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                        <i class="bi bi-chat-dots-fill text-primary fs-1"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Live Chat</h4>
                    <p class="text-muted mb-4">Chat with our support team in real-time for instant assistance with any issue.</p>
                    <button class="btn btn-outline-primary w-100 rounded-pill py-2 fw-bold">Start Chat</button>
                </div>
            </div>

            <!-- Email Support -->
            <div class="col-lg-4 col-md-6 animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
                <div class="card border-0 shadow-sm h-100 p-4 text-center hover-lift">
                    <div class="icon-box mb-4 mx-auto bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                        <i class="bi bi-envelope-paper-fill text-success fs-1"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Email Support</h4>
                    <p class="text-muted mb-4">Send us an email anytime. We typically respond within 24 hours.</p>
                    <a href="mailto:info@bimakwik.com" class="btn btn-outline-success w-100 rounded-pill py-2 fw-bold">Send Email</a>
                </div>
            </div>

            <!-- Phone Support -->
            <div class="col-lg-4 col-md-6 animate__animated animate__fadeInUp" style="animation-delay: 0.3s;">
                <div class="card border-0 shadow-sm h-100 p-4 text-center hover-lift">
                    <div class="icon-box mb-4 mx-auto bg-warning bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                        <i class="bi bi-telephone-fill text-warning fs-1"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Phone Support</h4>
                    <p class="text-muted mb-4">Prefer to talk? Give us a call. Available Mon-Fri, 8 AM to 5 PM.</p>
                    <a href="tel:+255762883065" class="btn btn-outline-warning w-100 rounded-pill py-2 fw-bold">Call Now</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Quick Help Topics -->
<section class="py-5">
    <div class="container py-4">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Popular Help Topics</h2>
            <div class="bg-primary mx-auto" style="width: 60px; height: 3px;"></div>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <a href="{{ route('support.faqs') }}" class="card h-100 border-0 shadow-sm p-4 text-decoration-none hover-light">
                    <h6 class="fw-bold text-dark mb-2"><i class="bi bi-person-plus me-2 text-primary"></i> Account Setup</h6>
                    <p class="small text-muted mb-0">How to create and manage your profile.</p>
                </a>
            </div>
            <div class="col-md-6 col-lg-3">
                <a href="{{ route('pages.claims') }}" class="card h-100 border-0 shadow-sm p-4 text-decoration-none hover-light">
                    <h6 class="fw-bold text-dark mb-2"><i class="bi bi-shield-check me-2 text-primary"></i> Claims Process</h6>
                    <p class="small text-muted mb-0">Step-by-step guide to filing a claim.</p>
                </a>
            </div>
            <div class="col-md-6 col-lg-3">
                <a href="{{ route('pages.products') }}" class="card h-100 border-0 shadow-sm p-4 text-decoration-none hover-light">
                    <h6 class="fw-bold text-dark mb-2"><i class="bi bi-credit-card me-2 text-primary"></i> Payments</h6>
                    <p class="small text-muted mb-0">Accepted payment methods and security.</p>
                </a>
            </div>
            <div class="col-md-6 col-lg-3">
                <a href="{{ route('resources.news') }}" class="card h-100 border-0 shadow-sm p-4 text-decoration-none hover-light">
                    <h6 class="fw-bold text-dark mb-2"><i class="bi bi-journal-text me-2 text-primary"></i> Guidelines</h6>
                    <p class="small text-muted mb-0">Policy terms and conditions explained.</p>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Support Hours -->
<section class="py-5 bg-dark text-white text-center">
    <div class="container py-4">
        <div class="row align-items-center">
            <div class="col-lg-8 text-lg-start mb-4 mb-lg-0">
                <h3 class="fw-bold mb-2">Our support team is available for you</h3>
                <p class="text-white-50 mb-0">Monday - Friday: 8:00 AM - 5:00 PM | Saturday: 9:00 AM - 1:00 PM (EAT)</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="{{ route('pages.contact') }}" class="btn btn-primary btn-lg px-5 rounded-pill">Contact Us</a>
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
        box-shadow: 0 1rem 3rem rgba(0,0,0,.1) !important;
    }
    .hover-light:hover {
        background-color: #f8f9fa;
    }
    .input-group-text {
        border-top-left-radius: 50px !important;
        border-bottom-left-radius: 50px !important;
    }
    .form-control {
        border-radius: 0 !important;
    }
    .btn-warning {
        border-top-right-radius: 50px !important;
        border-bottom-right-radius: 50px !important;
    }
</style>
@endsection

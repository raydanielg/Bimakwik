@extends('layouts.landing')

@section('content')
<section class="py-5 bg-white" style="margin-top: 80px;">
    <div class="container py-5">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-8">
                <h6 class="text-primary fw-bold text-uppercase letter-spacing-1 mb-3">For Customers</h6>
                <h1 class="display-4 fw-bold mb-4">Insurance Simplified for You</h1>
                <p class="lead text-secondary">Experience a seamless journey from buying your first policy to filing a claim, all from your smartphone.</p>
            </div>
        </div>

        <div class="row g-5">
            <div class="col-lg-4">
                <div class="p-4 rounded-5 border-0 shadow-sm bg-light h-100 transition-all hover-lift">
                    <div class="text-center mb-4">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-4 d-inline-block">
                            <i class="bi bi-cart-check text-primary fs-1"></i>
                        </div>
                    </div>
                    <h4 class="fw-bold text-center mb-3">Buy Insurance</h4>
                    <p class="text-muted text-center mb-4">Compare plans from top insurers and secure your coverage in minutes. No paperwork required.</p>
                    <a href="{{ route('pages.products') }}" class="btn btn-primary w-100 rounded-pill py-2">Compare & Buy</a>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="p-4 rounded-5 border-0 shadow-sm bg-light h-100 transition-all hover-lift">
                    <div class="text-center mb-4">
                        <div class="bg-danger bg-opacity-10 rounded-circle p-4 d-inline-block">
                            <i class="bi bi-lightning-charge text-danger fs-1"></i>
                        </div>
                    </div>
                    <h4 class="fw-bold text-center mb-3">File a Claim</h4>
                    <p class="text-muted text-center mb-4">Report incidents instantly through your dashboard. Upload photos and documents directly.</p>
                    <a href="{{ route('pages.claims') }}" class="btn btn-outline-danger w-100 rounded-pill py-2">Report Now</a>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="p-4 rounded-5 border-0 shadow-sm bg-light h-100 transition-all hover-lift">
                    <div class="text-center mb-4">
                        <div class="bg-success bg-opacity-10 rounded-circle p-4 d-inline-block">
                            <i class="bi bi-arrow-repeat text-success fs-1"></i>
                        </div>
                    </div>
                    <h4 class="fw-bold text-center mb-3">Renew Policy</h4>
                    <p class="text-muted text-center mb-4">Get smart alerts before your policy expires and renew with a single click. Stay protected always.</p>
                    <a href="{{ route('login') }}" class="btn btn-outline-success w-100 rounded-pill py-2">Quick Renew</a>
                </div>
            </div>
        </div>

        <div class="mt-5 p-5 bg-dark text-white rounded-5 shadow-lg position-relative overflow-hidden">
            <div class="row align-items-center position-relative z-index-1">
                <div class="col-lg-8">
                    <h3 class="fw-bold mb-3">Track Your Claim Status</h3>
                    <p class="mb-0 opacity-75">Curious about your claim progress? Log in to your personal dashboard for real-time tracking and updates.</p>
                </div>
                <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                    <a href="{{ route('login') }}" class="btn btn-warning btn-lg px-5 rounded-pill fw-bold">Track Status</a>
                </div>
            </div>
            <div class="position-absolute top-0 end-0 p-5 opacity-10">
                <i class="bi bi-search display-1"></i>
            </div>
        </div>
    </div>
</section>
@endsection

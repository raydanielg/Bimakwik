@extends('layouts.landing')

@section('content')
<section class="py-5 bg-dark text-white position-relative overflow-hidden" style="margin-top: 80px; background: linear-gradient(rgba(0,74,153,0.9), rgba(0,74,153,0.8)), url('/hero/smiling-man-purchasing-clothes-internet-with-credit-card_482257-92484.jpg'); background-size: cover; background-position: center;">
    <div class="container py-5 text-center position-relative z-index-1">
        <h6 class="text-warning fw-bold text-uppercase letter-spacing-1 mb-3 animate__animated animate__fadeInDown">Affiliate Program | Mpango wa Ushiriki</h6>
        <h1 class="display-3 fw-bold mb-4 animate__animated animate__fadeInUp">Promote & Earn Commission | Pata kwa Kutangaza Bima</h1>
        <p class="lead opacity-90 mx-auto mb-5 animate__animated animate__fadeInUp" style="max-width: 800px; animation-delay: 0.2s;">
            Do you have a blog, YouTube channel, or social media following? Join the Bima Kwik Affiliate Program and earn cash commissions by referring customers to Africa's smartest insurance ecosystem.
        </p>
        <div class="animate__animated animate__zoomIn" style="animation-delay: 0.4s;">
            <a href="{{ route('register.customer') }}" class="btn btn-warning btn-lg px-5 rounded-pill fw-bold shadow-lg hover-lift-sm">Join Program for Free</a>
        </div>
    </div>
</section>

<section class="py-5 bg-white">
    <div class="container py-5">
        <div class="row g-4 mb-5 text-center">
            <div class="col-md-4">
                <div class="p-4 bg-light rounded-5 h-100 hover-lift">
                    <div class="bg-primary bg-opacity-10 rounded-circle p-4 d-inline-block mb-3">
                        <i class="bi bi-person-plus text-primary fs-1"></i>
                    </div>
                    <h4 class="fw-bold">1. Join</h4>
                    <p class="text-muted small">Sign up for free and get your unique referral link instantly.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 bg-light rounded-5 h-100 hover-lift">
                    <div class="bg-primary bg-opacity-10 rounded-circle p-4 d-inline-block mb-3">
                        <i class="bi bi-share text-primary fs-1"></i>
                    </div>
                    <h4 class="fw-bold">2. Share</h4>
                    <p class="text-muted small">Promote Bima Kwik on your social media, blog, or email lists.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 bg-light rounded-5 h-100 hover-lift">
                    <div class="bg-primary bg-opacity-10 rounded-circle p-4 d-inline-block mb-3">
                        <i class="bi bi-currency-dollar text-primary fs-1"></i>
                    </div>
                    <h4 class="fw-bold">3. Earn</h4>
                    <p class="text-muted small">Receive commissions for every successful policy purchase.</p>
                </div>
            </div>
        </div>

        <!-- Commissions & Payments -->
        <div class="row g-5 py-5 border-top">
            <div class="col-lg-6">
                <h3 class="fw-bold mb-4">Commission Structure | Tume</h3>
                <div class="table-responsive">
                    <table class="table table-borderless bg-light rounded-4 shadow-sm mb-4">
                        <thead class="bg-dark text-white">
                            <tr><th class="p-3">Product Type</th><th class="p-3 text-center">Commission</th></tr>
                        </thead>
                        <tbody>
                            <tr class="border-bottom"><td class="p-3">Health Insurance</td><td class="p-3 text-center fw-bold">Up to 8%</td></tr>
                            <tr class="border-bottom"><td class="p-3">Life Insurance</td><td class="p-3 text-center fw-bold">Up to 10%</td></tr>
                            <tr class="border-bottom"><td class="p-3">Motor Insurance</td><td class="p-3 text-center fw-bold">Up to 5%</td></tr>
                            <tr><td class="p-3">Home & Travel</td><td class="p-3 text-center fw-bold">Up to 6%</td></tr>
                        </tbody>
                    </table>
                </div>
                <div class="p-4 bg-success bg-opacity-10 rounded-4 border-start border-5 border-success">
                    <h6 class="fw-bold text-success mb-1">Top Affiliates Bonus!</h6>
                    <p class="small mb-0">Sell over 250 policies a month and get an extra <strong>TZS 500,000</strong> bonus.</p>
                </div>
            </div>
            <div class="col-lg-6">
                <h3 class="fw-bold mb-4">Payment Methods | Njia za Malipo</h3>
                <p class="text-muted mb-4">We ensure you get your hard-earned commissions through your preferred channel every month.</p>
                <div class="row g-3">
                    <div class="col-6">
                        <div class="d-flex align-items-center p-3 border rounded-3">
                            <i class="bi bi-phone text-primary me-3 fs-3"></i>
                            <span class="fw-bold">Mobile Money</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-center p-3 border rounded-3">
                            <i class="bi bi-bank text-primary me-3 fs-3"></i>
                            <span class="fw-bold">Bank Transfer</span>
                        </div>
                    </div>
                </div>
                <div class="mt-5 p-4 border rounded-5 bg-light">
                    <h6 class="fw-bold mb-3">Questions?</h6>
                    <p class="small text-muted">Contact Affiliate Team: <strong>affiliates@bimakwik.com</strong></p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

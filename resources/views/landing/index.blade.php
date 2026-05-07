@extends('layouts.landing')

@section('content')
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 animate__animated animate__fadeInLeft">
                <h1 class="display-3 fw-bold mb-4">Insurance Protection for Every <span class="text-primary">Moment</span></h1>
                <p class="lead text-secondary mb-5">Get health, motor, and life insurance quickly and easily through BimaKwik. Your safety is our priority.</p>
                <div class="d-flex gap-3">
                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg px-5 rounded-pill text-white shadow">Get Started</a>
                    <a href="#" class="btn btn-outline-dark btn-lg px-5 rounded-pill">Learn More</a>
                </div>
            </div>
            <div class="col-lg-6 animate__animated animate__fadeInRight d-none d-lg-block">
                <img src="{{ asset('logo.png') }}" alt="BimaKwik Hero" class="img-fluid floating-img" style="max-height: 400px; filter: drop-shadow(0 20px 30px rgba(0,0,0,0.1));">
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-white">
    <div class="container py-5">
        <div class="text-center mb-5 animate__animated animate__fadeIn">
            <h2 class="fw-bold">Our Services</h2>
            <p class="text-secondary">Choose the type of insurance that suits you today.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4 animate__animated animate__fadeInUp" style="animation-delay: 0.1s">
                <div class="card h-100 border-0 shadow-sm p-4 hover-lift rounded-4">
                    <div class="feature-icon bg-primary text-white">
                        <i class="bi bi-car-front"></i>
                    </div>
                    <h4 class="fw-bold">Motor Insurance</h4>
                    <p class="text-secondary">Protect your vehicle against accidents, theft and other road hazards.</p>
                </div>
            </div>
            <div class="col-md-4 animate__animated animate__fadeInUp" style="animation-delay: 0.2s">
                <div class="card h-100 border-0 shadow-sm p-4 hover-lift rounded-4">
                    <div class="feature-icon bg-success text-white">
                        <i class="bi bi-heart-pulse"></i>
                    </div>
                    <h4 class="fw-bold">Health Insurance</h4>
                    <p class="text-secondary">We ensure you get the best medical care without fear of high costs.</p>
                </div>
            </div>
            <div class="col-md-4 animate__animated animate__fadeInUp" style="animation-delay: 0.3s">
                <div class="card h-100 border-0 shadow-sm p-4 hover-lift rounded-4">
                    <div class="feature-icon bg-warning text-white text-dark">
                        <i class="bi bi-house-heart"></i>
                    </div>
                    <h4 class="fw-bold">Life Insurance</h4>
                    <p class="text-secondary">Keep your family's future in safe hands with our insurance.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    @keyframes floating {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
        100% { transform: translateY(0px); }
    }
    .floating-img {
        animation: floating 3s ease-in-out infinite;
    }
</style>
@endsection

@extends('layouts.landing')

@section('content')
<section class="py-5 bg-white" style="margin-top: 80px;">
    <div class="container py-5">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-8">
                <h6 class="text-warning fw-bold text-uppercase letter-spacing-1 mb-3">Provider Network | Watoa Huduma</h6>
                <h1 class="display-4 fw-bold mb-4">Join Our Claims Service Network</h1>
                <p class="lead text-secondary">Hospitals, Garages, and Pharmacies—partner with us to provide seamless, cashless, and verified services to thousands of insured customers.</p>
            </div>
        </div>

        <div class="row g-4 py-4">
            <div class="col-lg-4">
                <div class="card h-100 border-0 bg-light p-4 rounded-5 text-center transition-all hover-lift">
                    <div class="bg-warning bg-opacity-10 rounded-circle p-4 d-inline-block mb-3">
                        <i class="bi bi-hospital text-warning fs-1"></i>
                    </div>
                    <h4 class="fw-bold">Medical Providers</h4>
                    <p class="text-muted small">Instant verification of patient cover and electronic bill submission for Hospitals and Clinics.</p>
                    <a href="{{ route('register.provider') }}" class="btn btn-warning w-100 rounded-pill mt-auto">Join Network</a>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card h-100 border-0 bg-light p-4 rounded-5 text-center transition-all hover-lift">
                    <div class="bg-primary bg-opacity-10 rounded-circle p-4 d-inline-block mb-3">
                        <i class="bi bi-tools text-primary fs-1"></i>
                    </div>
                    <h4 class="fw-bold">Automotive Garages</h4>
                    <p class="text-muted small">Receive claim job cards digitally, submit repair estimates, and get fast approvals.</p>
                    <a href="{{ route('register.provider') }}" class="btn btn-primary w-100 rounded-pill mt-auto">Join Network</a>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card h-100 border-0 bg-light p-4 rounded-5 text-center transition-all hover-lift">
                    <div class="bg-success bg-opacity-10 rounded-circle p-4 d-inline-block mb-3">
                        <i class="bi bi-capsule text-success fs-1"></i>
                    </div>
                    <h4 class="fw-bold">Pharmacies</h4>
                    <p class="text-muted small">Efficiently process prescriptions and receive direct payments for insured patients.</p>
                    <a href="{{ route('register.provider') }}" class="btn btn-success w-100 rounded-pill mt-auto">Join Network</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

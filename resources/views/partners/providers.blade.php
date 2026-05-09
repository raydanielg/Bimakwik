@extends('layouts.landing')

@section('content')
<section class="py-5 bg-white" style="margin-top: 80px;">
    <div class="container py-5">
        <!-- Hero Section -->
        <div class="row justify-content-center text-center mb-5 animate__animated animate__fadeIn">
            <div class="col-lg-10">
                <h6 class="text-warning fw-bold text-uppercase letter-spacing-1 mb-3">Service Provider Network | Watoa Huduma</h6>
                <h1 class="display-4 fw-bold mb-4 text-dark">Join Our Claims Service Network | Lipwa Haraka, Hudumu Vyema</h1>
                <p class="lead text-secondary mb-0">Are you a hospital, pharmacy, or garage? Partner with Bima Kwik to verify insurance coverage instantly and submit bills electronically. No more waiting months for claim payments.</p>
                <p class="lead text-secondary">Je, wewe ni hospitali au gereji? Shirikiana na Bima Kwik kuthibitisha bima ya wateja papo hapo na kulipwa haraka bila kusubiri miezi mingi.</p>
            </div>
        </div>

        <!-- Provider Types -->
        <div class="row g-4 mb-5 text-center">
            <div class="col-md-4">
                <div class="p-4 bg-light rounded-5 h-100 transition-all hover-lift border-bottom border-5 border-warning">
                    <div class="bg-warning bg-opacity-10 rounded-circle p-4 d-inline-block mb-3">
                        <i class="bi bi-hospital text-warning fs-1"></i>
                    </div>
                    <h4 class="fw-bold">Medical Providers</h4>
                    <p class="text-muted small">Hospitals, Clinics & Labs. Instant patient verification.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 bg-light rounded-5 h-100 transition-all hover-lift border-bottom border-5 border-primary">
                    <div class="bg-primary bg-opacity-10 rounded-circle p-4 d-inline-block mb-3">
                        <i class="bi bi-tools text-primary fs-1"></i>
                    </div>
                    <h4 class="fw-bold">Automotive Garages</h4>
                    <p class="text-muted small">Repair shops & Towing. Digital job cards & approvals.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 bg-light rounded-5 h-100 transition-all hover-lift border-bottom border-5 border-success">
                    <div class="bg-success bg-opacity-10 rounded-circle p-4 d-inline-block mb-3">
                        <i class="bi bi-capsule text-success fs-1"></i>
                    </div>
                    <h4 class="fw-bold">Pharmacies</h4>
                    <p class="text-muted small">Drug stores. Efficient prescription processing.</p>
                </div>
            </div>
        </div>

        <!-- Why Join & How it Works -->
        <div class="row g-5 align-items-center py-5">
            <div class="col-lg-6 animate__animated animate__fadeInLeft">
                <h2 class="fw-bold mb-4">Why Join Bima Kwik?</h2>
                <div class="row g-4">
                    <div class="col-12 d-flex align-items-start">
                        <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3"><i class="bi bi-lightning-charge text-success"></i></div>
                        <div><strong>Instant Verification:</strong> Check active coverage in seconds.</div>
                    </div>
                    <div class="col-12 d-flex align-items-start">
                        <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3"><i class="bi bi-cash-stack text-success"></i></div>
                        <div><strong>Faster Payments:</strong> Get paid within days, not months.</div>
                    </div>
                    <div class="col-12 d-flex align-items-start">
                        <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3"><i class="bi bi-graph-up text-success"></i></div>
                        <div><strong>Status Tracking:</strong> Real-time tracking from submission to payment.</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 animate__animated animate__fadeInRight">
                <div class="bg-dark text-white p-5 rounded-5 shadow-lg">
                    <h3 class="fw-bold mb-4 text-warning">How It Works</h3>
                    <div class="small opacity-75">
                        <p class="mb-3"><span class="badge bg-warning text-dark me-2">1</span> Search customer by policy number or ID.</p>
                        <p class="mb-3"><span class="badge bg-warning text-dark me-2">2</span> Provide service after instant verification.</p>
                        <p class="mb-3"><span class="badge bg-warning text-dark me-2">3</span> Submit bill electronically via portal.</p>
                        <p class="mb-0"><span class="badge bg-warning text-dark me-2">4</span> Get paid directly to your bank account.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Testimonial & CTA -->
        <div class="bg-light p-5 rounded-5 text-center mt-5">
            <p class="fst-italic text-muted mb-4">"Before Bima Kwik, we waited 3–6 months for insurance payments. Now we get paid in 2 weeks. It changed our cash flow completely."</p>
            <h6 class="fw-bold">Dr. Sarah, Hospital Administrator</h6>
            <div class="mt-5">
                <a href="{{ route('register.provider') }}" class="btn btn-warning btn-lg px-5 rounded-pill fw-bold shadow-sm">Join as a Service Provider</a>
            </div>
            <p class="mt-4 small text-muted">Questions? Contact Provider Relations: <strong>providers@bimakwik.com</strong></p>
        </div>
    </div>
</section>
@endsection

@extends('layouts.landing')

@section('content')
<section class="py-5 bg-white" style="margin-top: 80px;">
    <div class="container py-5">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-8">
                <h6 class="text-primary fw-bold text-uppercase letter-spacing-1 mb-3">Partnership | Ushirikiano</h6>
                <h1 class="display-4 fw-bold mb-4">Become a Licensed Broker or Agent</h1>
                <p class="lead text-secondary">Join Africa's fastest-growing digital insurance network. Empower your agency with tools that simplify sales and boost commissions.</p>
            </div>
        </div>

        <div class="row g-5 align-items-center mb-5">
            <div class="col-lg-6">
                <img src="{{ asset('hero/passionate-about-what-he-does-manager-sitting-having-discussion-with-employee_590464-14320.jpg') }}" class="img-fluid rounded-5 shadow-lg" alt="Become a Broker">
            </div>
            <div class="col-lg-6 ps-lg-5">
                <h2 class="fw-bold mb-4">Why Partner with Bima Kwik?</h2>
                <div class="d-flex mb-4">
                    <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3 flex-shrink-0">
                        <i class="bi bi-graph-up-arrow text-primary fs-4"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold">Increase Your Revenue</h5>
                        <p class="text-muted mb-0">Access a wider range of products and process more policies in less time with our automated system.</p>
                    </div>
                </div>
                <div class="d-flex mb-4">
                    <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3 flex-shrink-0">
                        <i class="bi bi-laptop text-primary fs-4"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold">Digital Sales Tools</h5>
                        <p class="text-muted mb-0">Get a dedicated dashboard to manage clients, track renewals, and view your commission statements in real-time.</p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3 flex-shrink-0">
                        <i class="bi bi-shield-check text-primary fs-4"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold">Regulatory Compliance</h5>
                        <p class="text-muted mb-0">Our platform is fully integrated with TIRA, ensuring all your digital transactions are secure and compliant.</p>
                    </div>
                </div>
                <div class="mt-5">
                    <a href="{{ route('register.broker') }}" class="btn btn-primary btn-lg px-5 rounded-pill fw-bold shadow-sm">Start Your Application</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

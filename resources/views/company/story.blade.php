@extends('layouts.landing')

@section('content')
<section class="py-5 bg-white" style="margin-top: 80px;">
    <div class="container py-5">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-8">
                <h6 class="text-primary fw-bold text-uppercase letter-spacing-1 mb-3">Our Journey</h6>
                <h1 class="display-4 fw-bold mb-4">The Bima Kwik Story</h1>
                <p class="lead text-secondary">From a bold idea to Africa's leading digital insurance infrastructure. Discover how we are transforming financial protection for millions.</p>
            </div>
        </div>

        <div class="row align-items-center g-5 mb-5">
            <div class="col-lg-6">
                <img src="{{ asset('hero/passionate-about-what-he-does-manager-sitting-having-discussion-with-employee_590464-14320.jpg') }}" class="img-fluid rounded-5 shadow-lg" alt="Our Story">
            </div>
            <div class="col-lg-6 ps-lg-5">
                <div class="timeline">
                    <div class="timeline-item mb-4 pb-4 border-bottom">
                        <h4 class="fw-bold text-primary">2021: The Genesis</h4>
                        <p class="text-muted">Bima Kwik was born out of a simple observation: insurance penetration in Tanzania and across Africa was critically low. We saw the gap between traditional insurance models and the rapidly growing digital population.</p>
                    </div>
                    <div class="timeline-item mb-4 pb-4 border-bottom">
                        <h4 class="fw-bold text-primary">2022: TIRA Integration</h4>
                        <p class="text-muted">A major milestone was achieved when we fully integrated with TIRA (Tanzania Insurance Regulatory Authority), ensuring our platform operates with the highest level of regulatory compliance and trust.</p>
                    </div>
                    <div class="timeline-item">
                        <h4 class="fw-bold text-primary">Today: Digital Leader</h4>
                        <p class="text-muted">Now, Bima Kwik serves as a robust OMNICHANNEL platform connecting insurers, brokers, and service providers, making insurance accessible to everyone, everywhere.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-primary text-white p-5 rounded-5 shadow-lg">
            <div class="row text-center">
                <div class="col-md-4 mb-4 mb-md-0">
                    <h2 class="display-4 fw-bold">1.4B</h2>
                    <p class="mb-0">Potential Market Reach</p>
                </div>
                <div class="col-md-4 mb-4 mb-md-0">
                    <h2 class="display-4 fw-bold">100%</h2>
                    <p class="mb-0">Digital Automation</p>
                </div>
                <div class="col-md-4">
                    <h2 class="display-4 fw-bold">24/7</h2>
                    <p class="mb-0">Platform Availability</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

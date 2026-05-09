@extends('layouts.landing')

@section('content')
<section class="py-5 bg-light" style="margin-top: 80px;">
    <div class="container py-5">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-8">
                <h6 class="text-info fw-bold text-uppercase letter-spacing-1 mb-3">Aggregation | Mtandao wa Usambazaji</h6>
                <h1 class="display-4 fw-bold mb-4">Become a Bima Kwik Aggregator</h1>
                <p class="lead text-secondary">Scale your network by integrating our insurance products into your existing digital ecosystem, mobile apps, or retail outlets.</p>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm p-4 rounded-4 text-center hover-lift">
                    <div class="bg-info bg-opacity-10 rounded-circle p-4 d-inline-block mb-3">
                        <i class="bi bi-plug-fill text-info fs-1"></i>
                    </div>
                    <h4 class="fw-bold">Seamless API</h4>
                    <p class="text-muted small">Our BimaConnect API allows for deep integration into your platform with minimal technical effort.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm p-4 rounded-4 text-center hover-lift">
                    <div class="bg-success bg-opacity-10 rounded-circle p-4 d-inline-block mb-3">
                        <i class="bi bi-wallet2 text-success fs-1"></i>
                    </div>
                    <h4 class="fw-bold">Revenue Sharing</h4>
                    <p class="text-muted small">Enjoy competitive referral fees and revenue-sharing models for every policy sold through your channel.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm p-4 rounded-4 text-center hover-lift">
                    <div class="bg-primary bg-opacity-10 rounded-circle p-4 d-inline-block mb-3">
                        <i class="bi bi-bar-chart-fill text-primary fs-1"></i>
                    </div>
                    <h4 class="fw-bold">Real-time Analytics</h4>
                    <p class="text-muted small">Monitor performance, track conversions, and optimize your distribution strategy through your aggregator dashboard.</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-5 rounded-5 shadow-sm border text-center">
            <h3 class="fw-bold mb-4">Ready to Amplify Your Distribution?</h3>
            <p class="text-muted mb-4 mx-auto" style="max-width: 600px;">Join banks, mobile network operators, and large retail chains that trust Bima Kwik for their insurance aggregation needs.</p>
            <a href="{{ route('pages.contact') }}" class="btn btn-info text-white btn-lg px-5 rounded-pill fw-bold">Contact Partnership Team</a>
        </div>
    </div>
</section>
@endsection

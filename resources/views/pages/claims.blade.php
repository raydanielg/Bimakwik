@extends('layouts.landing')

@section('content')
<section class="py-5 bg-white">
    <div class="container py-5 mt-5 text-center">
        <div class="animate__animated animate__fadeIn">
            <h1 class="display-4 fw-bold mb-4">Insurance Claims</h1>
            <p class="lead text-secondary mx-auto mb-5" style="max-width: 700px;">We understand that making a claim can be a stressful time. BimaKwik is here to make the process as smooth and transparent as possible.</p>
        </div>

        <div class="row g-4 justify-content-center mb-5">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 h-100 hover-lift">
                    <div class="feature-icon bg-danger text-white mb-4 mx-auto">
                        <i class="bi bi-lightning-charge"></i>
                    </div>
                    <h4 class="fw-bold">Fast Initiation</h4>
                    <p class="text-secondary small">Start your claim process digitally in just a few minutes through our platform.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 h-100 hover-lift">
                    <div class="feature-icon bg-info text-white mb-4 mx-auto">
                        <i class="bi bi-eye"></i>
                    </div>
                    <h4 class="fw-bold">Transparency</h4>
                    <p class="text-secondary small">Track the status of your claim in real-time from your digital dashboard.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 h-100 hover-lift">
                    <div class="feature-icon bg-success text-white mb-4 mx-auto">
                        <i class="bi bi-headset"></i>
                    </div>
                    <h4 class="fw-bold">Expert Support</h4>
                    <p class="text-secondary small">Our dedicated claims specialists are ready to guide you every step of the way.</p>
                </div>
            </div>
        </div>

        <div class="bg-light p-5 rounded-4 shadow-sm animate__animated animate__pulse">
            <h2 class="fw-bold mb-4">How to Initiate a Claim?</h2>
            <p class="text-secondary mb-5">To start a claim, please log in to your account and go to the "Claims" section, or contact our support team immediately.</p>
            <div class="d-flex flex-wrap justify-content-center gap-3">
                <a href="{{ route('login') }}" class="btn btn-primary rounded-pill px-5 py-3 fw-bold">Login to Start Claim</a>
                <a href="{{ route('support.help') }}" class="btn btn-outline-dark rounded-pill px-5 py-3 fw-bold">Talk to a Specialist</a>
            </div>
        </div>
    </div>
</section>
@endsection

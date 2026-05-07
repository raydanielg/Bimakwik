@extends('layouts.landing')

@section('content')
<section class="py-5 bg-light">
    <div class="container py-5 mt-5">
        <div class="text-center mb-5 animate__animated animate__fadeIn">
            <h6 class="text-primary fw-bold text-uppercase mb-3">Support</h6>
            <h2 class="display-5 fw-bold">Help Center</h2>
            <p class="text-secondary mx-auto" style="max-width: 600px;">How can we help you today? Our support team is here for you.</p>
        </div>

        <div class="row g-4 justify-content-center">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 text-center h-100 hover-lift">
                    <div class="feature-icon bg-primary text-white mx-auto mb-4">
                        <i class="bi bi-chat-dots"></i>
                    </div>
                    <h4 class="fw-bold">Live Chat</h4>
                    <p class="text-secondary">Talk to our experts via WhatsApp for quick assistance.</p>
                    <a href="https://wa.me/255746179849" class="btn btn-outline-primary rounded-pill px-4 mt-3">Start Chat</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 text-center h-100 hover-lift">
                    <div class="feature-icon bg-success text-white mx-auto mb-4">
                        <i class="bi bi-envelope"></i>
                    </div>
                    <h4 class="fw-bold">Email Support</h4>
                    <p class="text-secondary">Send us an email and we'll respond within 24 hours.</p>
                    <a href="mailto:info@bimacoinsurance.co.tz" class="btn btn-outline-success rounded-pill px-4 mt-3">Send Email</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 text-center h-100 hover-lift">
                    <div class="feature-icon bg-warning text-dark mx-auto mb-4">
                        <i class="bi bi-telephone"></i>
                    </div>
                    <h4 class="fw-bold">Phone Support</h4>
                    <p class="text-secondary">Call our customer care desk for immediate help.</p>
                    <a href="tel:+255746179849" class="btn btn-outline-dark rounded-pill px-4 mt-3">Call Now</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

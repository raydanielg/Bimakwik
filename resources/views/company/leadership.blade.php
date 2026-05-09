@extends('layouts.landing')

@section('content')
<section class="py-5 bg-light" style="margin-top: 80px;">
    <div class="container py-5">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-8">
                <h6 class="text-primary fw-bold text-uppercase letter-spacing-1 mb-3">Our Leadership</h6>
                <h1 class="display-4 fw-bold mb-4">The Minds Behind Bima Kwik</h1>
                <p class="lead text-secondary">A diverse team of visionaries, technology experts, and insurance veterans dedicated to revolutionizing the industry.</p>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 text-center p-4 hover-lift">
                    <div class="bg-primary bg-opacity-10 rounded-circle p-4 d-inline-block mx-auto mb-4" style="width: 120px; height: 120px;">
                        <i class="bi bi-person-workspace text-primary display-4"></i>
                    </div>
                    <h4 class="fw-bold mb-1">Board of Directors</h4>
                    <p class="text-primary small fw-bold text-uppercase mb-3">Strategic Oversight</p>
                    <p class="text-muted small">Our board provides the strategic direction and governance necessary to scale across Africa responsibly.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 text-center p-4 hover-lift">
                    <div class="bg-info bg-opacity-10 rounded-circle p-4 d-inline-block mx-auto mb-4" style="width: 120px; height: 120px;">
                        <i class="bi bi-cpu text-info display-4"></i>
                    </div>
                    <h4 class="fw-bold mb-1">Technology Team</h4>
                    <p class="text-info small fw-bold text-uppercase mb-3">Innovation & Development</p>
                    <p class="text-muted small">The engineers and AI specialists building the robust TIRAMIS infrastructure and BimaConnect APIs.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 text-center p-4 hover-lift">
                    <div class="bg-success bg-opacity-10 rounded-circle p-4 d-inline-block mx-auto mb-4" style="width: 120px; height: 120px;">
                        <i class="bi bi-shield-check text-success display-4"></i>
                    </div>
                    <h4 class="fw-bold mb-1">Operations & Legal</h4>
                    <p class="text-success small fw-bold text-uppercase mb-3">Compliance & Trust</p>
                    <p class="text-muted small">Ensuring every transaction and partnership adheres to TIRA regulations and international standards.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

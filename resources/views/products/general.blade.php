@extends('layouts.landing')

@section('content')
<section class="py-5 bg-white" style="margin-top: 80px;">
    <div class="container py-5">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-8">
                <h6 class="text-success fw-bold text-uppercase letter-spacing-1 mb-3">General Insurance | Bima Nyinginezo</h6>
                <h1 class="display-4 fw-bold mb-4">Protection for Everything Else</h1>
                <p class="lead text-secondary">From your home and property to your travels abroad, Bima Kwik covers the risks you face in daily life.</p>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm p-4 rounded-4 hover-lift text-center">
                    <div class="bg-danger bg-opacity-10 rounded-circle p-4 d-inline-block mb-3">
                        <i class="bi bi-fire text-danger fs-1"></i>
                    </div>
                    <h4 class="fw-bold">Fire & Property</h4>
                    <p class="text-muted small">Protect your assets against fire, theft, and natural disasters. Coverage for buildings and contents.</p>
                    <a href="{{ route('quote.request') }}" class="btn btn-outline-danger btn-sm rounded-pill px-4">Get Quote</a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm p-4 rounded-4 hover-lift text-center">
                    <div class="bg-primary bg-opacity-10 rounded-circle p-4 d-inline-block mb-3">
                        <i class="bi bi-airplane-engines text-primary fs-1"></i>
                    </div>
                    <h4 class="fw-bold">Travel Insurance</h4>
                    <p class="text-muted small">Worry-free travel with medical emergency, trip cancellation, and lost luggage coverage worldwide.</p>
                    <a href="{{ route('quote.request') }}" class="btn btn-outline-primary btn-sm rounded-pill px-4">Get Quote</a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm p-4 rounded-4 hover-lift text-center">
                    <div class="bg-success bg-opacity-10 rounded-circle p-4 d-inline-block mb-3">
                        <i class="bi bi-house-heart text-success fs-1"></i>
                    </div>
                    <h4 class="fw-bold">Home Insurance</h4>
                    <p class="text-muted small">Comprehensive protection for your residence and domestic employees. Safe home, peaceful mind.</p>
                    <a href="{{ route('quote.request') }}" class="btn btn-outline-success btn-sm rounded-pill px-4">Get Quote</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

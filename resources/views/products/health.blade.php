@extends('layouts.landing')

@section('content')
<section class="py-5 bg-white" style="margin-top: 80px;">
    <div class="container py-5">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-8">
                <h6 class="text-primary fw-bold text-uppercase letter-spacing-1 mb-3">Health Insurance | Bima ya Afya</h6>
                <h1 class="display-4 fw-bold mb-4">Comprehensive Health Coverage for You and Your Business</h1>
                <p class="lead text-secondary">Bima Kwik provides flexible health insurance plans designed to ensure that quality medical care is accessible to everyone, from individuals to large corporations.</p>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-lg-6">
                <div class="card h-100 border-0 shadow-sm p-5 rounded-5 animate__animated animate__fadeInLeft">
                    <div class="bg-danger bg-opacity-10 rounded-circle p-3 d-inline-block mb-4">
                        <i class="bi bi-people-fill text-danger fs-2"></i>
                    </div>
                    <h3 class="fw-bold mb-3">Family Floater Plans</h3>
                    <p class="text-muted mb-4">Protect your loved ones with a single policy that covers your entire family. Affordable, comprehensive, and hassle-free.</p>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="bi bi-check2 text-danger me-2"></i> Inpatient & Outpatient care</li>
                        <li class="mb-2"><i class="bi bi-check2 text-danger me-2"></i> Maternity & Newborn coverage</li>
                        <li class="mb-2"><i class="bi bi-check2 text-danger me-2"></i> Dental & Optical benefits</li>
                    </ul>
                    <a href="{{ route('quote.request') }}" class="btn btn-danger rounded-pill px-4 mt-3">Get Family Quote</a>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card h-100 border-0 shadow-sm p-5 rounded-5 animate__animated animate__fadeInRight">
                    <div class="bg-primary bg-opacity-10 rounded-circle p-3 d-inline-block mb-4">
                        <i class="bi bi-building-fill text-primary fs-2"></i>
                    </div>
                    <h3 class="fw-bold mb-3">Corporate Health Solutions</h3>
                    <p class="text-muted mb-4">Empower your employees with world-class health benefits. Tailored packages for SMEs and large enterprises.</p>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="bi bi-check2 text-primary me-2"></i> Custom benefit limits</li>
                        <li class="mb-2"><i class="bi bi-check2 text-primary me-2"></i> Wellness & Preventive care</li>
                        <li class="mb-2"><i class="bi bi-check2 text-primary me-2"></i> 24/7 dedicated support</li>
                    </ul>
                    <a href="{{ route('quote.request') }}" class="btn btn-primary rounded-pill px-4 mt-3">Get Corporate Quote</a>
                </div>
            </div>
        </div>

        <div class="alert alert-warning border-0 rounded-4 p-4 text-center">
            <h5 class="fw-bold"><i class="bi bi-info-circle-fill me-2"></i> Why Choose Our Health Insurance?</h5>
            <p class="mb-0">Instant digital cards, wide hospital network coverage, and zero paperwork claims processing.</p>
        </div>
    </div>
</section>
@endsection

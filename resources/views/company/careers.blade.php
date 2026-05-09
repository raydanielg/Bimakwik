@extends('layouts.landing')

@section('content')
<section class="py-5 bg-white" style="margin-top: 80px;">
    <div class="container py-5">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-8">
                <h6 class="text-primary fw-bold text-uppercase letter-spacing-1 mb-3">Join Our Mission</h6>
                <h1 class="display-4 fw-bold mb-4">Build the Future of Insurance</h1>
                <p class="lead text-secondary">We are always looking for passionate innovators, thinkers, and builders to join our rapidly growing team.</p>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-6 col-lg-4">
                <div class="p-4 border rounded-4 hover-lift h-100">
                    <span class="badge bg-primary bg-opacity-10 text-primary mb-3">Engineering</span>
                    <h5 class="fw-bold">Senior Backend Developer</h5>
                    <p class="text-muted small mb-4">Remote / Dar es Salaam, Tanzania</p>
                    <a href="#" class="btn btn-outline-primary btn-sm rounded-pill px-4">View Details</a>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="p-4 border rounded-4 hover-lift h-100">
                    <span class="badge bg-success bg-opacity-10 text-success mb-3">Sales</span>
                    <h5 class="fw-bold">Corporate Partnership Manager</h5>
                    <p class="text-muted small mb-4">Dar es Salaam, Tanzania</p>
                    <a href="#" class="btn btn-outline-primary btn-sm rounded-pill px-4">View Details</a>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="p-4 border rounded-4 hover-lift h-100">
                    <span class="badge bg-info bg-opacity-10 text-info mb-3">Product</span>
                    <h5 class="fw-bold">UX/UI Product Designer</h5>
                    <p class="text-muted small mb-4">Remote (Africa Timezone)</p>
                    <a href="#" class="btn btn-outline-primary btn-sm rounded-pill px-4">View Details</a>
                </div>
            </div>
        </div>

        <div class="bg-light p-5 rounded-5 border-0 shadow-sm text-center">
            <h3 class="fw-bold mb-3">Don't see a matching role?</h3>
            <p class="text-muted mb-4">We are always looking for talent. Send your CV to careers@bimakwik.com and we'll keep you in mind for future openings.</p>
            <a href="mailto:careers@bimakwik.com" class="btn btn-primary btn-lg px-5 rounded-pill fw-bold">Send Your CV</a>
        </div>
    </div>
</section>
@endsection

@extends('layouts.landing')

@section('content')
<section class="py-5 bg-white" style="margin-top: 80px;">
    <div class="container py-5">
        <div class="row justify-content-center text-center mb-5 animate__animated animate__fadeIn">
            <div class="col-lg-10">
                <h6 class="text-primary fw-bold text-uppercase letter-spacing-1 mb-3">Learning Center | Kituo cha Mafunzo</h6>
                <h1 class="display-4 fw-bold mb-4 text-dark">Insurance Made Easy for Everyone</h1>
                <p class="lead text-secondary mb-0">Welcome to the Bima Kwik Learning Center. We believe that insurance should be easy to understand. Access our free educational resources in English and Kiswahili.</p>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-6 col-lg-4">
                <div class="p-4 border rounded-5 h-100 hover-lift bg-light">
                    <div class="bg-primary bg-opacity-10 rounded-circle p-3 d-inline-block mb-3">
                        <i class="bi bi-book text-primary fs-3"></i>
                    </div>
                    <h5 class="fw-bold">Insurance Basics</h5>
                    <p class="small text-muted">What is insurance, how it works, and why you need it. Misingi ya bima kwa kila mmoja.</p>
                    <ul class="list-unstyled small mb-0">
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>Types of Insurance</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>Understanding Premiums</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="p-4 border rounded-5 h-100 hover-lift bg-light">
                    <div class="bg-success bg-opacity-10 rounded-circle p-3 d-inline-block mb-3">
                        <i class="bi bi-cart-check text-success fs-3"></i>
                    </div>
                    <h5 class="fw-bold">Buying on Bima Kwik</h5>
                    <p class="small text-muted">Step-by-step guide to buying policies and making payments. Kununua bima kwa urahisi.</p>
                    <ul class="list-unstyled small mb-0">
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>How to Register</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>Payment Methods</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="p-4 border rounded-5 h-100 hover-lift bg-light">
                    <div class="bg-danger bg-opacity-10 rounded-circle p-3 d-inline-block mb-3">
                        <i class="bi bi-shield-exclamation text-danger fs-3"></i>
                    </div>
                    <h5 class="fw-bold">Claims Management</h5>
                    <p class="small text-muted">How to file claims and track status in real-time. Usimamizi wa madai yako.</p>
                    <ul class="list-unstyled small mb-0">
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>How to File a Claim</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>Required Documents</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="bg-dark text-white p-5 rounded-5 shadow-lg mb-5">
            <h3 class="fw-bold mb-4">Video Tutorials | Mafunzo ya Video</h3>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="ratio ratio-16x9 bg-secondary rounded-4 mb-2 overflow-hidden">
                        <div class="d-flex align-items-center justify-content-center h-100">
                            <i class="bi bi-play-circle display-4 text-white"></i>
                        </div>
                    </div>
                    <p class="small fw-bold text-center">How to buy motor insurance</p>
                </div>
                <div class="col-md-4">
                    <div class="ratio ratio-16x9 bg-secondary rounded-4 mb-2 overflow-hidden">
                        <div class="d-flex align-items-center justify-content-center h-100">
                            <i class="bi bi-play-circle display-4 text-white"></i>
                        </div>
                    </div>
                    <p class="small fw-bold text-center">How to file a claim</p>
                </div>
                <div class="col-md-4">
                    <div class="ratio ratio-16x9 bg-secondary rounded-4 mb-2 overflow-hidden">
                        <div class="d-flex align-items-center justify-content-center h-100">
                            <i class="bi bi-play-circle display-4 text-white"></i>
                        </div>
                    </div>
                    <p class="small fw-bold text-center">Broker Portal Training</p>
                </div>
            </div>
        </div>

        <div class="text-center">
            <h4 class="fw-bold mb-4">Monthly Webinars | Toamıza za Kila Mwezi</h4>
            <div class="table-responsive">
                <table class="table table-hover border rounded-4 overflow-hidden">
                    <thead class="bg-primary text-white">
                        <tr><th>Webinar</th><th>Target Audience</th><th>Schedule</th></tr>
                    </thead>
                    <tbody>
                        <tr><td>Insurance 101</td><td>Customers</td><td>1st Tuesday / Month</td></tr>
                        <tr><td>Claims Made Easy</td><td>Customers</td><td>2nd Wednesday / Month</td></tr>
                        <tr><td>Broker Success</td><td>Brokers/Agents</td><td>3rd Thursday / Month</td></tr>
                    </tbody>
                </table>
            </div>
            <a href="#" class="btn btn-primary btn-lg px-5 rounded-pill fw-bold mt-4 shadow">Register for Next Webinar</a>
        </div>
    </div>
</section>
@endsection

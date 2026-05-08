@extends('layouts.landing')

@section('content')
<!-- Claims Hero -->
<section class="py-5 bg-primary text-white text-center" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%); margin-top: 80px;">
    <div class="container py-5">
        <h1 class="display-4 fw-bold mb-3 animate__animated animate__fadeInDown">Fast & Easy Claims</h1>
        <p class="lead mb-0 animate__animated animate__fadeInUp">Submit your claim notifications digitally and track the progress in real-time.</p>
    </div>
</section>

<!-- Claims Process Section -->
<section class="py-5 bg-light">
    <div class="container py-5">
        <div class="text-center mb-5 animate__animated animate__fadeIn">
            <h6 class="text-primary fw-bold text-uppercase mb-2">Our Process</h6>
            <h2 class="fw-bold">How to File a Claim</h2>
            <div class="bg-primary mx-auto" style="width: 60px; height: 3px;"></div>
        </div>

        <div class="row g-4 justify-content-center">
            <!-- Step 1 -->
            <div class="col-lg-3 col-md-6 animate__animated animate__fadeInUp" style="animation-delay: 0.1s;">
                <div class="card border-0 shadow-sm h-100 text-center p-4 hover-lift">
                    <div class="step-number mb-3 mx-auto bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold fs-4" style="width: 60px; height: 60px;">1</div>
                    <div class="icon-box mb-3 text-primary">
                        <i class="bi bi-file-earmark-plus fs-1"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Notify Us</h5>
                    <p class="text-muted small">Submit your claim notification immediately via the Bima Kwik mobile app or web portal.</p>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="col-lg-3 col-md-6 animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
                <div class="card border-0 shadow-sm h-100 text-center p-4 hover-lift">
                    <div class="step-number mb-3 mx-auto bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold fs-4" style="width: 60px; height: 60px;">2</div>
                    <div class="icon-box mb-3 text-primary">
                        <i class="bi bi-cloud-upload fs-1"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Upload Docs</h5>
                    <p class="text-muted small">Snap and upload required documents like police reports, medical bills, or photos of the damage.</p>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="col-lg-3 col-md-6 animate__animated animate__fadeInUp" style="animation-delay: 0.3s;">
                <div class="card border-0 shadow-sm h-100 text-center p-4 hover-lift">
                    <div class="step-number mb-3 mx-auto bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold fs-4" style="width: 60px; height: 60px;">3</div>
                    <div class="icon-box mb-3 text-primary">
                        <i class="bi bi-search fs-1"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Verification</h5>
                    <p class="text-muted small">Our system and insurance partners verify the details and documents submitted for accuracy.</p>
                </div>
            </div>

            <!-- Step 4 -->
            <div class="col-lg-3 col-md-6 animate__animated animate__fadeInUp" style="animation-delay: 0.4s;">
                <div class="card border-0 shadow-sm h-100 text-center p-4 hover-lift">
                    <div class="step-number mb-3 mx-auto bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold fs-4" style="width: 60px; height: 60px;">4</div>
                    <div class="icon-box mb-3 text-primary">
                        <i class="bi bi-cash-coin fs-1"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Settlement</h5>
                    <p class="text-muted small">Once approved, the claim is settled directly through the insurance company's core system.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Claims Support Section -->
<section class="py-5">
    <div class="container py-4">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0 animate__animated animate__fadeInLeft">
                <img src="https://images.unsplash.com/photo-1450101499163-c8848c66ca85?auto=format&fit=crop&q=80&w=800" alt="Claims Support" class="img-fluid rounded-4 shadow-lg">
            </div>
            <div class="col-lg-6 ps-lg-5 animate__animated animate__fadeInRight">
                <h6 class="text-primary fw-bold text-uppercase mb-3">Why Bima Kwik Claims?</h6>
                <h2 class="fw-bold mb-4">Transparent & Fast Claim Processing</h2>
                <div class="d-flex mb-4">
                    <div class="flex-shrink-0">
                        <div class="bg-success bg-opacity-10 p-2 rounded-circle me-3">
                            <i class="bi bi-lightning-fill text-success"></i>
                        </div>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1">Instant Notifications</h6>
                        <p class="text-muted small mb-0">No more paperwork delays. Send notifications directly to insurers in seconds.</p>
                    </div>
                </div>
                <div class="d-flex mb-4">
                    <div class="flex-shrink-0">
                        <div class="bg-success bg-opacity-10 p-2 rounded-circle me-3">
                            <i class="bi bi-eye-fill text-success"></i>
                        </div>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1">Full Transparency</h6>
                        <p class="text-muted small mb-0">Track every stage of your claim from submission to final settlement.</p>
                    </div>
                </div>
                <div class="d-flex mb-4">
                    <div class="flex-shrink-0">
                        <div class="bg-success bg-opacity-10 p-2 rounded-circle me-3">
                            <i class="bi bi-shield-check-fill text-success"></i>
                        </div>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1">Regulatory Compliant</h6>
                        <p class="text-muted small mb-0">Our claims process follows all TIRA guidelines and regulatory requirements.</p>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="{{ route('pages.contact') }}" class="btn btn-primary btn-lg px-4 rounded-pill">Talk to Claims Expert</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Claims Statistics -->
<section class="py-5 bg-dark text-white text-center">
    <div class="container py-4">
        <div class="row g-4">
            <div class="col-md-4">
                <h2 class="fw-bold mb-1 animate__animated animate__pulse animate__infinite">24h</h2>
                <p class="text-white-50 mb-0">Avg. Notification Response</p>
            </div>
            <div class="col-md-4">
                <h2 class="fw-bold mb-1 animate__animated animate__pulse animate__infinite">98%</h2>
                <p class="text-white-50 mb-0">Digital Submission Rate</p>
            </div>
            <div class="col-md-4">
                <h2 class="fw-bold mb-1 animate__animated animate__pulse animate__infinite">100%</h2>
                <p class="text-white-50 mb-0">Transparency Promise</p>
            </div>
        </div>
    </div>
</section>

<style>
    .hover-lift {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .hover-lift:hover {
        transform: translateY(-10px);
        box-shadow: 0 1rem 3rem rgba(0,0,0,.1) !important;
    }
    .step-number {
        border: 4px solid #fff;
        box-shadow: 0 0 0 4px #0d6efd;
    }
</style>
@endsection

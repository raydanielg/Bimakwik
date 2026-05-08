@extends('layouts.landing')

@section('content')
<!-- About Hero -->
<section class="py-5 bg-primary text-white text-center" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%); margin-top: 80px;">
    <div class="container py-5">
        <h1 class="display-4 fw-bold mb-3 animate__animated animate__fadeInDown">Empowering Africa Through Digital Insurance</h1>
        <p class="lead mb-0 animate__animated animate__fadeInUp">Bima Kwik is revolutionizing insurance penetration with innovative digital solutions.</p>
    </div>
</section>

<!-- Main About Content -->
<section class="py-5">
    <div class="container py-4">
        <div class="row align-items-center mb-5">
            <div class="col-lg-6 mb-4 mb-lg-0 animate__animated animate__fadeInLeft">
                <h2 class="fw-bold mb-4 text-primary border-start border-4 border-primary ps-3">Who We Are</h2>
                <p class="lead text-dark mb-4">I Link Limited, trading as <strong>Bima Kwik</strong>, is a licensed insurance digital platform in Tanzania.</p>
                <p class="text-muted lh-lg mb-4">
                    We serve as an intermediary platform for insurance sales and claims notifications, connecting insurance companies, regulators, sales channels, partner networks, and insurance customers. Our platform integrates various general, health, and life insurance products, including health, personal accident, motor, and funeral covers.
                </p>
                <div class="row g-3">
                    <div class="col-6">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-check-circle-fill text-primary me-2"></i>
                            <span class="fw-semibold">TIRA Licensed</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-check-circle-fill text-primary me-2"></i>
                            <span class="fw-semibold">OMNI CHANNEL</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-check-circle-fill text-primary me-2"></i>
                            <span class="fw-semibold">API Integrated</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-check-circle-fill text-primary me-2"></i>
                            <span class="fw-semibold">Regulatory Compliant</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 animate__animated animate__fadeInRight">
                <div class="position-relative">
                    <img src="https://images.unsplash.com/photo-1557804506-669a67965ba0?auto=format&fit=crop&q=80&w=800" alt="About Bima Kwik" class="img-fluid rounded-4 shadow-lg">
                    <div class="position-absolute bottom-0 start-0 bg-white p-4 m-4 rounded-3 shadow-sm d-none d-md-block" style="width: 200px;">
                        <h3 class="fw-bold text-primary mb-0">100%</h3>
                        <p class="small text-muted mb-0">Digital Solution</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- The Africa Situation -->
        <div class="row mb-5 py-5 bg-light rounded-4">
            <div class="col-lg-12 text-center mb-5">
                <h2 class="fw-bold">The Africa Situation</h2>
                <div class="bg-primary mx-auto" style="width: 60px; height: 3px;"></div>
            </div>
            <div class="col-lg-8 mx-auto text-center">
                <p class="lead text-muted mb-5">
                    Insurance penetration in Africa is currently less than 3%, despite a potential market of 1.4 billion people. Bima Kwik addresses this by changing the perception of insurance from an "expense" to an "investment" or "business opportunity."
                </p>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="p-4 bg-white rounded-3 shadow-sm h-100">
                            <h4 class="fw-bold text-primary">3%</h4>
                            <p class="small mb-0">Current Penetration</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-4 bg-white rounded-3 shadow-sm h-100">
                            <h4 class="fw-bold text-primary">1.4B</h4>
                            <p class="small mb-0">Potential Market</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-4 bg-white rounded-3 shadow-sm h-100">
                            <h4 class="fw-bold text-primary">Core</h4>
                            <p class="small mb-0">Intermediary System</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Financial Inclusion Section -->
        <div class="row align-items-center mb-5">
            <div class="col-lg-6 order-lg-2 mb-4 mb-lg-0">
                <h2 class="fw-bold mb-4 text-primary border-start border-4 border-primary ps-3">Financial Inclusion</h2>
                <p class="text-muted lh-lg mb-4">
                    Our solution contributes to financial inclusion by providing increased social protection through customized insurance products for community groups, individuals, and businesses.
                </p>
                <div class="card border-0 bg-primary text-white p-4 rounded-4 shadow">
                    <h5 class="fw-bold mb-3">Empowering Communities</h5>
                    <p class="mb-0">
                        We implement a revenue sharing model with engaged channels and partners, empowering disabled individuals, women, youth, and SMEs to become part of the insurance ecosystem.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

        <!-- Mission, Vision, Values -->
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm p-4 hover-lift">
                    <div class="icon-box mb-3 bg-primary bg-opacity-10 rounded-3 p-3 d-inline-block text-primary">
                        <i class="bi bi-eye-fill fs-3"></i>
                    </div>
                    <h4 class="fw-bold">Our Vision</h4>
                    <p class="text-muted">To revolutionize insurance penetration in Africa and help all stakeholders achieve their social and financial targets.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm p-4 hover-lift">
                    <div class="icon-box mb-3 bg-success bg-opacity-10 rounded-3 p-3 d-inline-block text-success">
                        <i class="bi bi-bullseye fs-3"></i>
                    </div>
                    <h4 class="fw-bold">Our Mission</h4>
                    <p class="text-muted">To provide user-friendly access to customized insurance products through a robust, regulatory-compliant OMNICHANNEL platform.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm p-4 hover-lift">
                    <div class="icon-box mb-3 bg-warning bg-opacity-10 rounded-3 p-3 d-inline-block text-warning">
                        <i class="bi bi-heart-fill fs-3"></i>
                    </div>
                    <h4 class="fw-bold">Our Values</h4>
                    <ul class="list-unstyled text-muted mb-0">
                        <li><i class="bi bi-check2 text-warning me-2"></i> Transparency</li>
                        <li><i class="bi bi-check2 text-warning me-2"></i> Innovation</li>
                        <li><i class="bi bi-check2 text-warning me-2"></i> Financial Inclusion</li>
                        <li><i class="bi bi-check2 text-warning me-2"></i> Customer Centricity</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-5 bg-dark text-white">
    <div class="container text-center py-4">
        <h2 class="fw-bold mb-4">Ready to experience the future of insurance?</h2>
        <p class="lead mb-5 opacity-75">Request a demo today and see how Bima Kwik can transform your business.</p>
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ route('pages.contact') }}" class="btn btn-primary btn-lg px-5">Request a Demo</a>
            <a href="tel:+255762883065" class="btn btn-outline-light btn-lg px-5">Call Us</a>
        </div>
    </div>
</section>

<style>
    .hover-lift {
        transition: transform 0.3s ease;
    }
    .hover-lift:hover {
        transform: translateY(-10px);
    }
</style>
@endsection
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
@endsection

@extends('layouts.landing')

@section('content')
<!-- About Hero -->
<section class="py-5 bg-primary text-white position-relative overflow-hidden" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%); margin-top: 80px;">
    <!-- Decorative Shapes -->
    <div class="position-absolute top-0 start-0 bg-white opacity-5 rounded-circle" style="width: 400px; height: 400px; transform: translate(-50%, -50%); z-index: 0;"></div>
    <div class="position-absolute bottom-0 end-0 bg-white opacity-5 rounded-circle" style="width: 300px; height: 300px; transform: translate(50%, 50%); z-index: 0;"></div>

    <div class="container py-5 position-relative" style="z-index: 1;">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <span class="badge rounded-pill bg-white text-primary px-3 py-2 mb-3 animate__animated animate__fadeInDown">ABOUT BIMAKWIK</span>
                <h1 class="display-3 fw-bold mb-3 animate__animated animate__fadeInUp">Empowering Africa Through Digital Insurance</h1>
                <p class="lead mb-0 animate__animated animate__fadeInUp" style="animation-delay: 0.2s">Bima Kwik is revolutionizing insurance penetration with innovative digital solutions and strategic partnerships.</p>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Bima Kwik -->
<section class="py-5">
    <div class="container py-4">
        <div class="row align-items-center mb-5">
            <div class="col-lg-6 mb-4 mb-lg-0 animate__animated animate__fadeInLeft">
                <div class="pe-lg-5">
                    <h6 class="text-primary fw-bold text-uppercase mb-3 letter-spacing-1">Who We Are</h6>
                    <h2 class="display-5 fw-bold mb-4 text-dark">Your Trusted Digital Insurance Partner</h2>
                    <p class="lead text-dark mb-4">I Link Limited, trading as <strong>Bima Kwik</strong>, is a licensed insurance digital platform in Tanzania.</p>
                    <p class="text-muted lh-lg mb-4">
                        We serve as an intermediary platform for insurance sales and claims notifications, connecting insurance companies, regulators, sales channels, partner networks, and insurance customers. Our platform integrates various general, health, and life insurance products into one seamless experience.
                    </p>
                    
                    <div class="row g-4 mb-4">
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                    <i class="bi bi-patch-check-fill text-primary"></i>
                                </div>
                                <span class="fw-bold">TIRA Licensed</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                    <i class="bi bi-cpu-fill text-primary"></i>
                                </div>
                                <span class="fw-bold">API Integrated</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                    <i class="bi bi-layers-fill text-primary"></i>
                                </div>
                                <span class="fw-bold">OMNI CHANNEL</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                    <i class="bi bi-shield-lock-fill text-primary"></i>
                                </div>
                                <span class="fw-bold">Regulated & Secure</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 animate__animated animate__fadeInRight">
                <div class="position-relative">
                    <img src="{{ asset('hero/passionate-about-what-he-does-manager-sitting-having-discussion-with-employee_590464-14320.jpg') }}" alt="About Bima Kwik" class="img-fluid rounded-4 shadow-lg">
                    <div class="position-absolute -bottom-4 -end-4 bg-white p-4 m-4 rounded-4 shadow-lg d-none d-md-block animate__animated animate__bounceIn" style="width: 240px; border-left: 8px solid #0d6efd; animation-delay: 0.8s;">
                        <div class="d-flex align-items-center mb-2">
                            <h2 class="fw-bold text-primary mb-0 me-2">100%</h2>
                            <i class="bi bi-graph-up-arrow text-success fs-4"></i>
                        </div>
                        <p class="small text-dark fw-bold mb-0">Digital Transformation</p>
                        <p class="small text-muted mb-0">Reliable & Transparent</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- The Solution & Africa Situation -->
        <div class="row mb-5 py-5 px-4 bg-dark text-white rounded-5 overflow-hidden position-relative">
            <div class="position-absolute top-0 end-0 p-5 opacity-10">
                <i class="bi bi-globe-africa display-1"></i>
            </div>
            <div class="col-lg-7 position-relative">
                <h6 class="text-warning fw-bold text-uppercase mb-3">The Africa Situation</h6>
                <h2 class="display-6 fw-bold mb-4">Bridging the Insurance Gap</h2>
                <p class="lead text-light opacity-75 mb-4">
                    Insurance penetration in Africa is less than 3%, yet there's a potential market of 1.4 billion people. Bima Kwik addresses this by changing perceptions—turning insurance from an "expense" into a vital "investment" or "business opportunity."
                </p>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="h-100 p-4 rounded-4" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1);">
                            <h3 class="fw-bold text-warning mb-1">< 3%</h3>
                            <p class="small mb-0 opacity-75">Current Penetration</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="h-100 p-4 rounded-4" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1);">
                            <h3 class="fw-bold text-warning mb-1">1.4B</h3>
                            <p class="small mb-0 opacity-75">Potential Market</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="h-100 p-4 rounded-4" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1);">
                            <h3 class="fw-bold text-warning mb-1">24/7</h3>
                            <p class="small mb-0 opacity-75">Cloud Access</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-block">
                 <img src="{{ asset('hero/explain-black-man-laptop-office-meeting-ideas-project-with-teamwork-collaboration-employee-discussion-boardroom-with-research-partnership-strategy-as-lawyers_590464-394339.jpg') }}" alt="Africa Strategy" class="img-fluid rounded-4 shadow-lg h-100 object-fit-cover">
            </div>
        </div>

        <!-- Core Values & Mission -->
        <div class="row py-5">
            <div class="col-12 text-center mb-5">
                <h6 class="text-primary fw-bold text-uppercase mb-3">Foundations of Success</h6>
                <h2 class="display-5 fw-bold text-dark">Our Mission & Values</h2>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-sm p-4 hover-lift text-center">
                    <div class="icon-box mx-auto mb-4 bg-primary bg-opacity-10 rounded-circle p-4 d-inline-flex text-primary">
                        <i class="bi bi-eye-fill fs-1"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Our Vision</h4>
                    <p class="text-muted">To revolutionize insurance penetration in Africa and help all stakeholders achieve their social and financial targets.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-sm p-4 hover-lift text-center">
                    <div class="icon-box mx-auto mb-4 bg-success bg-opacity-10 rounded-circle p-4 d-inline-flex text-success">
                        <i class="bi bi-bullseye fs-1"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Our Mission</h4>
                    <p class="text-muted">To provide user-friendly access to customized insurance products through a robust, regulatory-compliant OMNICHANNEL platform.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-sm p-4 hover-lift text-center">
                    <div class="icon-box mx-auto mb-4 bg-warning bg-opacity-10 rounded-circle p-4 d-inline-flex text-warning">
                        <i class="bi bi-heart-fill fs-1"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Our Values</h4>
                    <div class="d-flex flex-wrap justify-content-center gap-2 mt-3">
                        <span class="badge bg-light text-dark border p-2">Transparency</span>
                        <span class="badge bg-light text-dark border p-2">Innovation</span>
                        <span class="badge bg-light text-dark border p-2">Financial Inclusion</span>
                        <span class="badge bg-light text-dark border p-2">Customer First</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-5 bg-primary text-white">
    <div class="container text-center py-5 position-relative">
        <div class="position-absolute top-50 start-50 translate-middle opacity-10">
            <i class="bi bi-shield-check display-1" style="font-size: 15rem;"></i>
        </div>
        <div class="position-relative">
            <h2 class="display-4 fw-bold mb-4">Ready to Join the Revolution?</h2>
            <p class="lead mb-5 opacity-75 mx-auto" style="max-width: 700px;">Whether you're an insurer, broker, or customer, Bima Kwik has a tailored digital solution for you. Let's grow together.</p>
            <div class="d-flex justify-content-center gap-3">
                <a href="{{ route('pages.contact') }}" class="btn btn-white btn-lg px-5 rounded-pill fw-bold text-primary bg-white shadow">Request a Demo</a>
                <a href="tel:+255762883065" class="btn btn-outline-light btn-lg px-5 rounded-pill fw-bold border-2">Call Us Now</a>
            </div>
        </div>
    </div>
</section>

<style>
    .letter-spacing-1 { letter-spacing: 1.5px; }
    .hover-lift {
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    }
    .hover-lift:hover {
        transform: translateY(-12px);
        box-shadow: 0 1.5rem 4rem rgba(0,0,0,.1) !important;
    }
    .-bottom-4 { bottom: -1.5rem; }
    .-end-4 { right: -1.5rem; }
</style>
@endsection

@extends('layouts.landing')

@section('content')
<!-- Products Hero -->
<section class="py-5 bg-primary text-white text-center" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%); margin-top: 80px;">
    <div class="container py-5">
        <h1 class="display-4 fw-bold mb-3 animate__animated animate__fadeInDown">Our Digital Ecosystem</h1>
        <p class="lead mb-0 animate__animated animate__fadeInUp">Comprehensive insurance solutions for companies, referrers, and customers.</p>
    </div>
</section>

<!-- Core Platform Section -->
<section class="py-5">
    <div class="container py-4">
        <div class="row align-items-center mb-5">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h6 class="text-primary fw-bold text-uppercase mb-3">The Core System</h6>
                <h2 class="fw-bold mb-4">BIMA KWIK Core Platform</h2>
                <p class="text-muted lh-lg mb-4">
                    Our end-to-end Insurance Sales and Claims notification platform serves as a core intermediary system with OMNI CHANNEL access. It bridges the gap between insurance companies, regulators, and the final customer through multiple digital touchpoints.
                </p>
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="d-flex align-items-start">
                            <div class="bg-primary bg-opacity-10 p-2 rounded-3 me-3">
                                <i class="bi bi-phone text-primary fs-4"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Mobile App</h6>
                                <p class="small text-muted mb-0">For salesforce, SMEs, and customers.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-start">
                            <div class="bg-primary bg-opacity-10 p-2 rounded-3 me-3">
                                <i class="bi bi-window-sidebar text-primary fs-4"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Web Portals</h6>
                                <p class="small text-muted mb-0">For admins and insurance companies.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-start">
                            <div class="bg-primary bg-opacity-10 p-2 rounded-3 me-3">
                                <i class="bi bi-code-slash text-primary fs-4"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Robust APIs</h6>
                                <p class="small text-muted mb-0">Integration with core systems and regulators.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-start">
                            <div class="bg-primary bg-opacity-10 p-2 rounded-3 me-3">
                                <i class="bi bi-shield-check text-primary fs-4"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">TIRAMISS Ready</h6>
                                <p class="small text-muted mb-0">Direct connection to regulatory systems.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&q=80&w=800" alt="Core Platform" class="img-fluid rounded-4 shadow-lg">
            </div>
        </div>

        <!-- Sales Options -->
        <div class="row g-4 mb-5 py-5">
            <div class="col-12 text-center mb-4">
                <h2 class="fw-bold">Flexible Sales Options</h2>
                <p class="text-muted">Choose the model that best fits your business strategy.</p>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm p-4 text-center hover-lift">
                    <div class="mb-3 text-primary"><i class="bi bi-cart-check fs-1"></i></div>
                    <h4 class="fw-bold">Outright Purchase</h4>
                    <p class="text-muted">Acquire the full Bima Kwik core system for your organization with complete control.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm p-4 text-center hover-lift">
                    <div class="mb-3 text-success"><i class="bi bi-tags fs-1"></i></div>
                    <h4 class="fw-bold">White Labeling</h4>
                    <p class="text-muted">Use our platform with your own branding, paying a commission on successful sales.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm p-4 text-center hover-lift">
                    <div class="mb-3 text-warning"><i class="bi bi-lightning-charge fs-1"></i></div>
                    <h4 class="fw-bold">Bima Kwik Brand</h4>
                    <p class="text-muted">Join our existing ecosystem and use the platform under the trusted Bima Kwik brand.</p>
                </div>
            </div>
        </div>

        <!-- Insurance Products We Integrate -->
        <div class="row bg-light rounded-4 p-5 mb-5">
            <div class="col-lg-5 mb-4 mb-lg-0">
                <h2 class="fw-bold mb-4">Integrated Insurance Products</h2>
                <p class="text-muted mb-4">We create and market special insurance packages for targeted markets, ensuring social protection for all.</p>
                <ul class="list-unstyled">
                    <li class="mb-3 d-flex align-items-center"><i class="bi bi-plus-circle-fill text-primary me-3"></i> Health Insurance</li>
                    <li class="mb-3 d-flex align-items-center"><i class="bi bi-plus-circle-fill text-primary me-3"></i> Personal Accident Covers</li>
                    <li class="mb-3 d-flex align-items-center"><i class="bi bi-plus-circle-fill text-primary me-3"></i> Motor Insurance</li>
                    <li class="mb-3 d-flex align-items-center"><i class="bi bi-plus-circle-fill text-primary me-3"></i> Funeral Covers</li>
                    <li class="mb-3 d-flex align-items-center"><i class="bi bi-plus-circle-fill text-primary me-3"></i> Customized SME Packages</li>
                </ul>
            </div>
            <div class="col-lg-7">
                <div class="row g-3">
                    <div class="col-6">
                        <div class="bg-white p-4 rounded-3 shadow-sm h-100">
                            <h5 class="fw-bold">SMEs & Women</h5>
                            <p class="small text-muted mb-0">Empowering entrepreneurs to earn through insurance referrals.</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="bg-white p-4 rounded-3 shadow-sm h-100">
                            <h5 class="fw-bold">Micro Lending</h5>
                            <p class="small text-muted mb-0">Integrated insurance for micro-finance groups and members.</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="bg-white p-4 rounded-3 shadow-sm h-100">
                            <h5 class="fw-bold">Vehicle Owners</h5>
                            <p class="small text-muted mb-0">Seamless motor cover through association portals.</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="bg-white p-4 rounded-3 shadow-sm h-100">
                            <h5 class="fw-bold">Marginalized</h5>
                            <p class="small text-muted mb-0">Specially designed packages for disabled and youth groups.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Our Expertise -->
<section class="py-5">
    <div class="container text-center">
        <h2 class="fw-bold mb-5">Beyond the Digital Solution</h2>
        <div class="row g-4">
            <div class="col-md-3">
                <h6 class="fw-bold">Business Strategy</h6>
            </div>
            <div class="col-md-3">
                <h6 class="fw-bold">Market Research</h6>
            </div>
            <div class="col-md-3">
                <h6 class="fw-bold">Product Design</h6>
            </div>
            <div class="col-md-3">
                <h6 class="fw-bold">Sales Projections</h6>
            </div>
        </div>
    </div>
</section>

<style>
    .hover-lift {
        transition: all 0.3s ease;
    }
    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 1rem 3rem rgba(0,0,0,.1) !important;
    }
</style>
@endsection

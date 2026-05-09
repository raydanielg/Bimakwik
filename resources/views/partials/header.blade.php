<!-- Top Bar -->
<div class="top-bar py-2 shadow-sm border-bottom">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="top-info d-flex gap-3 gap-md-4">
            <a href="mailto:info@bimakwik.com" class="text-white text-decoration-none d-flex align-items-center hover-opacity">
                <i class="bi bi-envelope-fill text-warning me-1 me-md-2"></i> 
                <span class="d-none d-sm-inline small">info@bimakwik.com</span>
            </a>
            <a href="tel:+255762883065" class="text-white text-decoration-none d-flex align-items-center hover-opacity">
                <i class="bi bi-telephone-fill text-warning me-1 me-md-2"></i> 
                <span class="small">+255 762 883 065</span>
            </a>
        </div>
        <div class="top-links d-flex align-items-center gap-2 gap-md-3">
            <!-- Language Switcher -->
            <div class="dropdown me-2">
                <a class="text-white text-decoration-none small dropdown-toggle d-flex align-items-center" href="#" role="button" id="langDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-globe2 me-1"></i> English
                </a>
                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm rounded-3 mt-2" aria-labelledby="langDropdown">
                    <li><a class="dropdown-item small py-1" href="#">English</a></li>
                    <li><a class="dropdown-item small py-1" href="#">Kiswahili</a></li>
                </ul>
            </div>
            <span class="text-white-50 d-none d-md-inline">|</span>
            <a href="{{ route('support.faqs') }}" class="text-white text-decoration-none small hover-underline d-none d-md-inline">FAQs</a>
            <span class="text-white-50 d-none d-md-inline">|</span>
            <a href="{{ route('quote.request') }}" class="btn btn-warning btn-sm px-3 rounded-pill fw-bold text-dark shadow-sm">
                <i class="bi bi-play-circle me-1"></i> Request Demo
            </a>
        </div>
    </div>
</div>

<!-- Main Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white py-0 sticky-top shadow-sm main-header">
    <div class="container">
        <a class="navbar-brand py-3" href="{{ url('/') }}">
            <img src="{{ asset('logo.png') }}" alt="BimaKwik" height="50">
        </a>
        
        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar">
            <div class="hamburger-icon"><span></span><span></span><span></span></div>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link px-3 py-4 fw-bold {{ request()->is('/') ? 'active text-primary' : '' }}" href="{{ url('/') }}">Home</a>
                </li>
                
                <!-- Platform Mega Menu -->
                <li class="nav-item dropdown has-megamenu">
                    <a class="nav-link dropdown-toggle px-3 py-4 fw-bold" href="#" data-bs-toggle="dropdown">Platform</a>
                    <div class="dropdown-menu megamenu border-0 shadow-lg p-4 animate__animated animate__fadeInUp animate__faster" role="menu">
                        <div class="row g-4">
                            <div class="col-md-3 border-end">
                                <h6 class="fw-bold text-primary mb-3">Overview</h6>
                                <ul class="list-unstyled mega-list">
                                    <li><a href="{{ route('platform.overview') }}">What is Bima Kwik</a></li>
                                    <li><a href="{{ route('platform.overview') }}">Our Ecosystem</a></li>
                                    <li><a href="{{ route('platform.overview') }}">How It Works</a></li>
                                </ul>
                            </div>
                            <div class="col-md-3 border-end">
                                <h6 class="fw-bold text-primary mb-3">For Customers</h6>
                                <ul class="list-unstyled mega-list">
                                    <li><a href="{{ route('platform.customers') }}">Buy Insurance</a></li>
                                    <li><a href="{{ route('platform.customers') }}">File a Claim</a></li>
                                    <li><a href="{{ route('platform.customers') }}">Renew Policy</a></li>
                                    <li><a href="{{ route('platform.customers') }}">Track Status</a></li>
                                </ul>
                            </div>
                            <div class="col-md-3 border-end">
                                <h6 class="fw-bold text-primary mb-3">Technology</h6>
                                <ul class="list-unstyled mega-list">
                                    <li><a href="{{ route('platform.technology') }}">AI-Powered Platform</a></li>
                                    <li><a href="{{ route('platform.technology') }}">API Integration</a></li>
                                    <li><a href="{{ route('platform.technology') }}">Low-Code Builder</a></li>
                                    <li><a href="{{ route('platform.technology') }}">Security</a></li>
                                </ul>
                            </div>
                            <div class="col-md-3">
                                <h6 class="fw-bold text-primary mb-3">Expansion</h6>
                                <ul class="list-unstyled mega-list">
                                    <li><a href="{{ route('platform.businesses') }}">Multi-Country Instances</a></li>
                                    <li><a href="{{ route('platform.businesses') }}">TIRAMIS Replicable</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>

                <!-- Products Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle px-3 py-4 fw-bold" href="#" data-bs-toggle="dropdown">Products</a>
                    <div class="dropdown-menu border-0 shadow-lg rounded-4 p-3 animate__animated animate__fadeInUp animate__faster">
                        <div class="d-flex flex-column gap-1" style="min-width: 250px;">
                            <a class="dropdown-item rounded-3 d-flex align-items-center p-2" href="{{ route('pages.products') }}">
                                <i class="bi bi-car-front text-primary me-3 fs-5"></i>
                                <div><span class="fw-bold d-block">Motor Insurance</span><small class="text-muted">Private & Commercial</small></div>
                            </a>
                            <a class="dropdown-item rounded-3 d-flex align-items-center p-2" href="{{ route('products.health') }}">
                                <i class="bi bi-heart-pulse text-danger me-3 fs-5"></i>
                                <div><span class="fw-bold d-block">Health Insurance</span><small class="text-muted">Family & Corporate</small></div>
                            </a>
                            <a class="dropdown-item rounded-3 d-flex align-items-center p-2" href="{{ route('products.life') }}">
                                <i class="bi bi-umbrella text-info me-3 fs-5"></i>
                                <div><span class="fw-bold d-block">Life Insurance</span><small class="text-muted">Whole Life & Plans</small></div>
                            </a>
                            <a class="dropdown-item rounded-3 d-flex align-items-center p-2" href="{{ route('products.general') }}">
                                <i class="bi bi-box-seam text-success me-3 fs-5"></i>
                                <div><span class="fw-bold d-block">General Insurance</span><small class="text-muted">Fire, Travel & Home</small></div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item rounded-3 text-center fw-bold text-primary" href="{{ route('pages.products') }}">View All Products</a>
                        </div>
                    </div>
                </li>

                <!-- Partners -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle px-3 py-4 fw-bold" href="#" data-bs-toggle="dropdown">Partners</a>
                    <div class="dropdown-menu border-0 shadow-lg rounded-4 p-3 animate__animated animate__fadeInUp animate__faster">
                        <a class="dropdown-item rounded-3 p-2 mb-1" href="#">Become a Broker</a>
                        <a class="dropdown-item rounded-3 p-2 mb-1" href="#">Become an Aggregator</a>
                        <a class="dropdown-item rounded-3 p-2 mb-1" href="#">Service Providers</a>
                        <a class="dropdown-item rounded-3 p-2" href="#">Affiliate Program</a>
                    </div>
                </li>

                <!-- Resources Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle px-3 py-4 fw-bold" href="#" data-bs-toggle="dropdown">Resources</a>
                    <ul class="dropdown-menu border-0 shadow-lg rounded-4 p-3 animate__animated animate__fadeInUp animate__faster">
                        <li><a class="dropdown-item rounded-3 p-2 mb-1" href="{{ route('resources.news') }}">Learning Center</a></li>
                        <li><a class="dropdown-item rounded-3 p-2 mb-1" href="{{ route('resources.news') }}">Blog & News</a></li>
                        <li><a class="dropdown-item rounded-3 p-2 mb-1" href="{{ route('resources.guidelines') }}">Downloads</a></li>
                        <li><a class="dropdown-item rounded-3 p-2" href="{{ route('support.faqs') }}">FAQs</a></li>
                    </ul>
                </li>

                <!-- Company -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle px-3 py-4 fw-bold" href="#" data-bs-toggle="dropdown">Company</a>
                    <div class="dropdown-menu border-0 shadow-lg rounded-4 p-3 animate__animated animate__fadeInUp animate__faster">
                        <a class="dropdown-item rounded-3 p-2 mb-1" href="{{ route('pages.about') }}">About Us</a>
                        <a class="dropdown-item rounded-3 p-2 mb-1" href="{{ route('company.story') }}">Our Story</a>
                        <a class="dropdown-item rounded-3 p-2 mb-1" href="{{ route('company.leadership') }}">Leadership Team</a>
                        <a class="dropdown-item rounded-3 p-2 mb-1" href="{{ route('company.careers') }}">Careers</a>
                        <a class="dropdown-item rounded-3 p-2" href="{{ route('pages.contact') }}">Contact Us</a>
                    </div>
                </li>

                <!-- Portal Access Dropdown -->
                <li class="nav-item dropdown ms-lg-2">
                    <a class="btn btn-outline-primary px-4 rounded-pill fw-bold dropdown-toggle" href="#" id="portalDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-lock me-1"></i> Portals
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-4 p-3 mt-2 animate__animated animate__fadeInUp animate__faster" style="min-width: 250px;">
                        <li><h6 class="dropdown-header text-uppercase small letter-spacing-1 fw-bold text-muted mb-2">Create Account</h6></li>
                        <li><a class="dropdown-item rounded-3 p-2 mb-1" href="{{ route('register.customer') }}">Customer Registration</a></li>
                        <li><a class="dropdown-item rounded-3 p-2 mb-1" href="{{ route('register.broker') }}">Broker/Agent Registration</a></li>
                        <li><a class="dropdown-item rounded-3 p-2 mb-1" href="{{ route('register.insurer') }}">Insurer Registration</a></li>
                        <li><a class="dropdown-item rounded-3 p-2 mb-1" href="{{ route('register.provider') }}">Provider Registration</a></li>
                        <li><div class="dropdown-divider"></div></li>
                        <li><h6 class="dropdown-header text-uppercase small letter-spacing-1 fw-bold text-muted mb-2">Member Login</h6></li>
                        <li><a class="dropdown-item rounded-3 p-2 mb-1 fw-bold text-primary" href="{{ route('login') }}">Access All Portals</a></li>
                    </ul>
                </li>

                <li class="nav-item ms-lg-2">
                    <a href="{{ route('register') }}" class="btn btn-primary px-4 rounded-pill fw-bold shadow-sm hover-lift-sm">
                        Get Started
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Mobile Sidebar (Offcanvas) -->
<div class="offcanvas offcanvas-start border-0 shadow-lg" tabindex="-1" id="mobileSidebar">
    <div class="offcanvas-header border-bottom p-4 bg-light">
        <div class="d-flex align-items-center">
            <img src="{{ asset('logo.png') }}" alt="Logo" height="40" class="me-2">
            <span class="fw-bold text-primary h5 mb-0">BimaKwik</span>
        </div>
        <button type="button" class="btn-close shadow-none" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body p-0 d-flex flex-column h-100">
        <div class="p-4 flex-grow-1 overflow-auto">
            <div class="accordion accordion-flush" id="mobileAccordion">
                <!-- Platform -->
                <div class="accordion-item border-0">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold text-dark px-0" type="button" data-bs-toggle="collapse" data-bs-target="#m-platform">
                            Platform
                        </button>
                    </h2>
                    <div id="m-platform" class="accordion-collapse collapse" data-bs-parent="#mobileAccordion">
                        <div class="accordion-body px-0 py-2">
                            <ul class="list-unstyled ps-3 mobile-sublist">
                                <li><a href="#">Overview</a></li>
                                <li><a href="#">For Customers</a></li>
                                <li><a href="#">For Businesses</a></li>
                                <li><a href="#">Technology</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Products -->
                <div class="accordion-item border-0">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold text-dark px-0" type="button" data-bs-toggle="collapse" data-bs-target="#m-products">
                            Products
                        </button>
                    </h2>
                    <div id="m-products" class="accordion-collapse collapse" data-bs-parent="#mobileAccordion">
                        <div class="accordion-body px-0 py-2">
                            <ul class="list-unstyled ps-3 mobile-sublist">
                                <li><a href="{{ route('pages.products') }}">Motor Insurance</a></li>
                                <li><a href="#">Health Insurance</a></li>
                                <li><a href="#">Life Insurance</a></li>
                                <li><a href="#">General Insurance</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Partners -->
                <div class="accordion-item border-0">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold text-dark px-0" type="button" data-bs-toggle="collapse" data-bs-target="#m-partners">
                            Partners
                        </button>
                    </h2>
                    <div id="m-partners" class="accordion-collapse collapse" data-bs-parent="#mobileAccordion">
                        <div class="accordion-body px-0 py-2">
                            <ul class="list-unstyled ps-3 mobile-sublist">
                                <li><a href="{{ route('register.broker') }}">Become a Broker</a></li>
                                <li><a href="{{ route('register.broker') }}">Become an Aggregator</a></li>
                                <li><a href="{{ route('register.provider') }}">Service Providers</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Company -->
                <div class="accordion-item border-0">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold text-dark px-0" type="button" data-bs-toggle="collapse" data-bs-target="#m-company">
                            Company
                        </button>
                    </h2>
                    <div id="m-company" class="accordion-collapse collapse" data-bs-parent="#mobileAccordion">
                        <div class="accordion-body px-0 py-2">
                            <ul class="list-unstyled ps-3 mobile-sublist">
                                <li><a href="{{ route('pages.about') }}">About Us</a></li>
                                <li><a href="{{ route('company.story') }}">Our Story</a></li>
                                <li><a href="{{ route('company.leadership') }}">Leadership Team</a></li>
                                <li><a href="{{ route('company.careers') }}">Careers</a></li>
                                <li><a href="{{ route('pages.contact') }}">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-4 pt-4 border-top">
                <a href="{{ route('login') }}" class="btn btn-outline-primary w-100 mb-3 rounded-pill fw-bold">Login</a>
                <a href="{{ route('register') }}" class="btn btn-primary w-100 rounded-pill fw-bold shadow-sm">Join BimaKwik</a>
            </div>
        </div>
    </div>
</div>

<style>
    /* Mega Menu Styling */
    .has-megamenu { position: static; }
    .megamenu {
        width: 100%;
        left: 0;
        right: 0;
        top: 100%;
        padding: 40px !important;
        border-radius: 0 0 1.5rem 1.5rem !important;
    }
    .mega-list li { margin-bottom: 8px; }
    .mega-list li a {
        color: #475569;
        text-decoration: none;
        font-size: 0.95rem;
        transition: color 0.2s;
    }
    .mega-list li a:hover { color: #0d6efd; }

    /* General Header Enhancements */
    .main-header { transition: all 0.3s ease; }
    .nav-link { 
        color: #1e293b !important; 
        position: relative;
        font-size: 0.95rem;
    }
    .nav-link.active, .nav-link:hover { color: #0d6efd !important; }
    
    .dropdown-toggle::after { 
        display: inline-block;
        margin-left: 0.255em;
        vertical-align: 0.255em;
        content: "";
        border-top: 0.3em solid;
        border-right: 0.3em solid transparent;
        border-bottom: 0;
        border-left: 0.3em solid transparent;
        transition: transform 0.3s ease;
    }
    .nav-item.dropdown:hover .dropdown-toggle::after { transform: rotate(180deg); }
    
    .nav-item.dropdown:hover > .dropdown-menu { display: block; margin-top: 0; }
    
    .dropdown-item { transition: all 0.2s; }
    .dropdown-item:hover { background-color: rgba(13,110,253,0.05) !important; color: #0d6efd !important; }
    
    .mobile-sublist li { margin-bottom: 12px; }
    .mobile-sublist li a { color: #64748b; text-decoration: none; display: block; }
    
    .letter-spacing-1 { letter-spacing: 1px; }
    .hover-lift-sm:hover { transform: translateY(-2px); }
</style>

<style>
    /* Navbar Dropdowns */
    .dropdown-menu {
        border-radius: 1.25rem !important;
        margin-top: 10px !important;
    }
    .dropdown-item {
        padding: 0.75rem 1rem !important;
        transition: all 0.2s ease;
    }
    .dropdown-item:hover {
        background-color: rgba(13, 110, 253, 0.05) !important;
        color: #0d6efd !important;
    }
    .nav-item.dropdown:hover > .dropdown-menu {
        display: block;
    }

    /* Mobile Menu Refinements */
    .mobile-nav-sublink {
        display: block;
        padding: 8px 0;
        color: #6c757d;
        text-decoration: none;
        font-size: 0.95rem;
        font-weight: 600;
        transition: color 0.2s;
    }
    .mobile-nav-sublink:hover { color: #0d6efd; }
    
    .hamburger-icon {
        width: 30px;
        height: 20px;
        position: relative;
        cursor: pointer;
    }
    .hamburger-icon span {
        display: block;
        position: absolute;
        height: 3px;
        width: 100%;
        background: #004a99;
        border-radius: 9px;
        transition: .25s ease-in-out;
    }
    .hamburger-icon span:nth-child(1) { top: 0px; }
    .hamburger-icon span:nth-child(2) { top: 8px; }
    .hamburger-icon span:nth-child(3) { top: 16px; }

    .offcanvas { width: 85% !important; max-width: 350px !important; }
    .mobile-nav-link {
        display: block;
        font-size: 1.1rem;
        font-weight: 700;
        color: #333;
        text-decoration: none;
        padding: 10px 0;
        transition: all 0.3s ease;
    }
    .mobile-nav-link.active, .mobile-nav-link:hover { color: #0d6efd; }
    
    .sidebar-icon-circle {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
    }
    .letter-spacing-1 { letter-spacing: 1px; }

    .top-bar { background-color: #004a99 !important; font-size: 0.85rem; font-family: 'Nunito', sans-serif; }
    .navbar .nav-link { color: #334155 !important; font-family: 'Nunito', sans-serif; font-size: 0.95rem; transition: all 0.2s ease; }
    .navbar .nav-link:hover { color: #0d6efd !important; }
    .navbar .nav-link.active { color: #0d6efd !important; }
    
    .hover-lift-sm:hover { transform: translateY(-2px); transition: transform 0.2s; }
</style>

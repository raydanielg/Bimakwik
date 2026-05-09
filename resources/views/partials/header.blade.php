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
            <a href="{{ route('support.faqs') }}" class="text-white text-decoration-none small hover-underline d-flex align-items-center">
                <i class="bi bi-question-circle me-1 d-md-none"></i>
                <span class="d-none d-md-inline">FAQs</span>
            </a>
            <span class="text-white-50 d-none d-md-inline">|</span>
            <a href="{{ route('quote.request') }}" class="btn btn-warning btn-sm px-2 px-md-3 rounded-pill fw-bold text-dark shadow-sm x-small-mobile">
                <i class="bi bi-file-earmark-text me-1"></i> <span class="d-none d-sm-inline">Request Quote</span><span class="d-sm-none">Quote</span>
            </a>
        </div>
    </div>
</div>

<!-- Main Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white py-3 sticky-top shadow-sm main-header">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('logo.png') }}" alt="BUMACO INSURANCE" height="60">
        </a>
        
        <!-- Mobile Toggle Button -->
        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar" aria-controls="mobileSidebar">
            <div class="hamburger-icon">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </button>

        <!-- Desktop Navigation -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link px-3 fw-bold {{ request()->is('/') ? 'active text-primary' : '' }}" href="{{ url('/') }}">Home</a>
                </li>
                
                <!-- About Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fw-bold px-3 {{ request()->is('about*') || request()->is('branches*') ? 'active text-primary' : '' }}" href="#" id="aboutDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Company
                    </a>
                    <ul class="dropdown-menu border-0 shadow-lg rounded-4 p-3 animate__animated animate__fadeInUp animate__faster" aria-labelledby="aboutDropdown">
                        <li><a class="dropdown-item rounded-3 p-2 d-flex align-items-center mb-1" href="{{ route('pages.about') }}">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3"><i class="bi bi-info-circle text-primary"></i></div>
                            <div><span class="fw-bold d-block">About Us</span><small class="text-muted">Our history & mission</small></div>
                        </a></li>
                        <li><a class="dropdown-item rounded-3 p-2 d-flex align-items-center mb-1" href="{{ route('pages.branches') }}">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3"><i class="bi bi-geo-alt text-primary"></i></div>
                            <div><span class="fw-bold d-block">Branches</span><small class="text-muted">Find us near you</small></div>
                        </a></li>
                        <li><a class="dropdown-item rounded-3 p-2 d-flex align-items-center" href="{{ route('pages.contact') }}">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3"><i class="bi bi-telephone text-primary"></i></div>
                            <div><span class="fw-bold d-block">Contact Us</span><small class="text-muted">Get in touch 24/7</small></div>
                        </a></li>
                    </ul>
                </li>

                <!-- Products Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fw-bold px-3 {{ request()->is('products*') || request()->is('claims*') ? 'active text-primary' : '' }}" href="#" id="productsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Solutions
                    </a>
                    <ul class="dropdown-menu border-0 shadow-lg rounded-4 p-3 animate__animated animate__fadeInUp animate__faster" aria-labelledby="productsDropdown" style="min-width: 250px;">
                        <li><a class="dropdown-item rounded-3 p-2 d-flex align-items-center mb-1" href="{{ route('pages.products') }}">
                            <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3"><i class="bi bi-shield-check text-success"></i></div>
                            <div><span class="fw-bold d-block">Our Products</span><small class="text-muted">Explore insurance plans</small></div>
                        </a></li>
                        <li><a class="dropdown-item rounded-3 p-2 d-flex align-items-center mb-1" href="{{ route('pages.claims') }}">
                            <div class="bg-warning bg-opacity-10 rounded-circle p-2 me-3"><i class="bi bi-lightning text-warning"></i></div>
                            <div><span class="fw-bold d-block">Digital Claims</span><small class="text-muted">Fast processing flow</small></div>
                        </a></li>
                    </ul>
                </li>

                <!-- Resources Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fw-bold px-3 {{ request()->is('resources*') || request()->is('news*') || request()->is('guidelines*') ? 'active text-primary' : '' }}" href="#" id="resourcesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Resources
                    </a>
                    <ul class="dropdown-menu border-0 shadow-lg rounded-4 p-3 animate__animated animate__fadeInUp animate__faster" aria-labelledby="resourcesDropdown" style="min-width: 250px;">
                        <li><a class="dropdown-item rounded-3 p-2 d-flex align-items-center mb-1" href="{{ route('resources.news') }}">
                            <div class="bg-info bg-opacity-10 rounded-circle p-2 me-3"><i class="bi bi-newspaper text-info"></i></div>
                            <div><span class="fw-bold d-block">News & Research</span><small class="text-muted">Latest industry updates</small></div>
                        </a></li>
                        <li><a class="dropdown-item rounded-3 p-2 d-flex align-items-center mb-1" href="{{ route('resources.guidelines') }}">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3"><i class="bi bi-book text-primary"></i></div>
                            <div><span class="fw-bold d-block">Guidelines</span><small class="text-muted">Step-by-step materials</small></div>
                        </a></li>
                        <li><a class="dropdown-item rounded-3 p-2 d-flex align-items-center" href="{{ route('support.help') }}">
                            <div class="bg-danger bg-opacity-10 rounded-circle p-2 me-3"><i class="bi bi-headset text-danger"></i></div>
                            <div><span class="fw-bold d-block">Help Center</span><small class="text-muted">Get support & faqs</small></div>
                        </a></li>
                    </ul>
                </li>
                
                @auth
                    <li class="nav-item ms-lg-3 d-flex align-items-center gap-2">
                        @php
                            $dashboardRoute = 'customer.dashboard';
                            if(auth()->user()->hasRole('super-admin') || auth()->user()->hasRole('sub-admin')) $dashboardRoute = 'admin.dashboard';
                            elseif(auth()->user()->hasRole('insurer')) $dashboardRoute = 'insurer.dashboard';
                            elseif(auth()->user()->hasRole('broker')) $dashboardRoute = 'broker.dashboard';
                            elseif(auth()->user()->hasRole('aggregator')) $dashboardRoute = 'aggregator.dashboard';
                            elseif(auth()->user()->hasRole('service-provider')) $dashboardRoute = 'service-provider.dashboard';
                            elseif(auth()->user()->hasRole('financing-partner')) $dashboardRoute = 'financing-partner.dashboard';
                            elseif(auth()->user()->hasRole('developer')) $dashboardRoute = 'developer.dashboard';
                        @endphp
                        <a href="{{ route($dashboardRoute) }}" class="btn btn-primary px-4 rounded-pill fw-bold shadow-sm hover-lift-sm">
                            <i class="bi bi-speedometer2 me-1"></i> My Dashboard
                        </a>
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger px-3 rounded-pill fw-bold border-0 shadow-none">
                                <i class="bi bi-box-arrow-right"></i>
                            </button>
                        </form>
                    </li>
                @else
                    <li class="nav-item ms-lg-3">
                        <a href="{{ route('login') }}" class="btn btn-outline-primary px-4 rounded-pill fw-bold hover-lift-sm">Login</a>
                    </li>
                    <li class="nav-item ms-2">
                        <a href="{{ route('register') }}" class="btn btn-primary px-4 rounded-pill fw-bold shadow-sm hover-lift-sm">Register</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<!-- Mobile Sidebar (Offcanvas) -->
<div class="offcanvas offcanvas-start border-0 shadow-lg" tabindex="-1" id="mobileSidebar" aria-labelledby="mobileSidebarLabel">
    <div class="offcanvas-header border-bottom p-4 bg-light">
        <div class="d-flex align-items-center">
            <img src="{{ asset('logo.png') }}" alt="Logo" height="45" class="me-2">
            <span class="fw-bold text-primary h5 mb-0">{{ config('app.name') }}</span>
        </div>
        <button type="button" class="btn-close shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0 d-flex flex-column h-100">
        <!-- Auth Section for Mobile -->
        <div class="p-4 border-bottom">
            @auth
                <div class="d-flex align-items-center mb-3 p-3 bg-primary bg-opacity-10 rounded-4">
                    <div class="flex-shrink-0">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 45px; height: 45px; font-size: 1.2rem;">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="fw-bold mb-0 text-dark">{{ auth()->user()->name }}</h6>
                        <small class="text-primary fw-bold text-uppercase" style="font-size: 0.65rem;">{{ auth()->user()->roles->first()->name ?? 'User' }}</small>
                    </div>
                </div>
            @else
                <div class="row g-2 mb-2">
                    <div class="col-6">
                        <a href="{{ route('login') }}" class="btn btn-outline-primary w-100 py-2 rounded-pill fw-bold shadow-sm">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Login
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('register') }}" class="btn btn-primary w-100 py-2 rounded-pill fw-bold shadow-sm">
                            <i class="bi bi-person-plus me-1"></i> Join Now
                        </a>
                    </div>
                </div>
            @endauth
        </div>

        <div class="p-4 flex-grow-1 overflow-auto">
            <div class="mb-5">
                <h6 class="text-uppercase small fw-bold text-muted mb-3 letter-spacing-1" style="font-size: 0.7rem;">Main Menu</h6>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="{{ url('/') }}" class="mobile-nav-link {{ request()->is('/') ? 'active' : '' }}"><i class="bi bi-house-door me-3"></i> Home</a></li>
                    
                    @auth
                        <li class="mb-2">
                            <a href="{{ route($dashboardRoute) }}" class="mobile-nav-link text-primary fw-bold bg-primary bg-opacity-10 rounded-3 px-3">
                                <i class="bi bi-speedometer2 me-3"></i> My Dashboard
                            </a>
                        </li>
                    @endauth

                    <li class="mb-2">
                        <a class="mobile-nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#mobileAbout">
                            <span><i class="bi bi-building me-3"></i> Company</span>
                            <i class="bi bi-chevron-down small"></i>
                        </a>
                        <div class="collapse ps-4 mt-2" id="mobileAbout">
                            <a href="{{ route('pages.about') }}" class="mobile-nav-sublink"><i class="bi bi-info-circle me-2"></i> About Us</a>
                            <a href="{{ route('pages.branches') }}" class="mobile-nav-sublink"><i class="bi bi-geo-alt me-2"></i> Our Branches</a>
                            <a href="{{ route('pages.contact') }}" class="mobile-nav-sublink"><i class="bi bi-telephone me-2"></i> Contact Us</a>
                        </div>
                    </li>
                    <li class="mb-2">
                        <a class="mobile-nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#mobileProducts">
                            <span><i class="bi bi-shield-check me-3"></i> Solutions</span>
                            <i class="bi bi-chevron-down small"></i>
                        </a>
                        <div class="collapse ps-4 mt-2" id="mobileProducts">
                            <a href="{{ route('pages.products') }}" class="mobile-nav-sublink"><i class="bi bi-grid me-2"></i> Insurance Products</a>
                            <a href="{{ route('pages.claims') }}" class="mobile-nav-sublink"><i class="bi bi-lightning-charge me-2"></i> Digital Claims</a>
                        </div>
                    </li>
                    <li class="mb-2">
                        <a class="mobile-nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#mobileResources">
                            <span><i class="bi bi-collection me-3"></i> Resources</span>
                            <i class="bi bi-chevron-down small"></i>
                        </a>
                        <div class="collapse ps-4 mt-2" id="mobileResources">
                            <a href="{{ route('resources.news') }}" class="mobile-nav-sublink"><i class="bi bi-newspaper me-2"></i> News & Research</a>
                            <a href="{{ route('resources.guidelines') }}" class="mobile-nav-sublink"><i class="bi bi-journal-text me-2"></i> Guidelines</a>
                            <a href="{{ route('support.help') }}" class="mobile-nav-sublink"><i class="bi bi-headset me-2"></i> Help Center</a>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="contact-sidebar-section mb-5">
                <h6 class="text-uppercase small fw-bold text-muted mb-4 letter-spacing-1" style="font-size: 0.7rem;">Quick Support</h6>
                <div class="d-grid gap-3">
                    <a href="tel:+255762883065" class="d-flex align-items-center text-dark text-decoration-none">
                        <div class="sidebar-icon-circle bg-success bg-opacity-10 text-success"><i class="bi bi-telephone-outbound"></i></div>
                        <div class="ms-3">
                            <small class="text-muted d-block" style="font-size: 0.65rem;">Call Support</small>
                            <span class="fw-bold small">+255 762 883 065</span>
                        </div>
                    </a>
                    <a href="mailto:info@bimakwik.com" class="d-flex align-items-center text-dark text-decoration-none">
                        <div class="sidebar-icon-circle bg-info bg-opacity-10 text-info"><i class="bi bi-envelope-at"></i></div>
                        <div class="ms-3">
                            <small class="text-muted d-block" style="font-size: 0.65rem;">Email Us</small>
                            <span class="fw-bold small">info@bimakwik.com</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        @auth
            <div class="p-4 border-top bg-light">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger w-100 rounded-pill py-2 fw-bold shadow-sm d-flex align-items-center justify-content-center">
                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                    </button>
                </form>
            </div>
        @endauth
    </div>
</div>

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

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
<nav class="navbar navbar-expand-lg navbar-light bg-white py-3 sticky-top shadow-sm">
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
                    <a class="nav-link px-3 fw-bold text-primary active" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold px-3" href="{{ route('pages.about') }}">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold px-3" href="{{ route('pages.products') }}">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold px-3" href="{{ route('pages.claims') }}">Claims</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold px-3" href="{{ route('pages.contact') }}">Contact</a>
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
                        <a href="{{ route($dashboardRoute) }}" class="btn btn-primary px-4 rounded-pill fw-bold shadow-sm">
                            <i class="bi bi-speedometer2 me-1"></i> View My Dashboard
                        </a>
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger px-3 rounded-pill fw-bold">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </button>
                        </form>
                    </li>
                @else
                    <li class="nav-item ms-lg-3">
                        <a href="{{ route('login') }}" class="btn btn-outline-primary px-4 rounded-pill fw-bold">Login</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<!-- Mobile Sidebar (Offcanvas) -->
<div class="offcanvas offcanvas-start border-0" tabindex="-1" id="mobileSidebar" aria-labelledby="mobileSidebarLabel">
    <div class="offcanvas-header border-bottom p-4">
        <img src="{{ asset('logo.png') }}" alt="Logo" height="50">
        <button type="button" class="btn-close shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0 d-flex flex-column h-100">
        <div class="p-4 flex-grow-1 overflow-auto">
            <ul class="list-unstyled mb-5">
                <li class="mb-3">
                    <a href="{{ url('/') }}" class="mobile-nav-link active">Home</a>
                </li>
                @auth
                    <li class="mb-3">
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
                        <a href="{{ route($dashboardRoute) }}" class="mobile-nav-link text-primary fw-bold">
                            <i class="bi bi-speedometer2 me-2"></i> View My Dashboard
                        </a>
                    </li>
                @endauth
                <li class="mb-3">
                    <a href="{{ route('pages.about') }}" class="mobile-nav-link">About Us</a>
                </li>
                <li class="mb-3">
                    <a href="{{ route('pages.products') }}" class="mobile-nav-link">Products</a>
                </li>
                <li class="mb-3">
                    <a href="{{ route('pages.claims') }}" class="mobile-nav-link">Claims</a>
                </li>
                <li class="mb-3">
                    <a href="{{ route('pages.branches') }}" class="mobile-nav-link">Branches</a>
                </li>
                <li class="mb-3">
                    <a href="{{ route('pages.contact') }}" class="mobile-nav-link">Contact</a>
                </li>
            </ul>

            <div class="contact-sidebar-section mb-5">
                <h6 class="text-uppercase small fw-bold text-muted mb-4 letter-spacing-1">Get in Touch</h6>
                <a href="tel:+255762883065" class="d-flex align-items-center text-dark text-decoration-none mb-3">
                    <div class="sidebar-icon-circle"><i class="bi bi-telephone"></i></div>
                    <span class="ms-3 fw-bold">+255 762 883 065</span>
                </a>
                <a href="mailto:info@bimakwik.com" class="d-flex align-items-center text-dark text-decoration-none mb-3">
                    <div class="sidebar-icon-circle"><i class="bi bi-envelope"></i></div>
                    <span class="ms-3 fw-bold">info@bimakwik.com</span>
                </a>
            </div>
        </div>

        <div class="p-4 border-top bg-light">
            <a href="{{ route('quote.request') }}" class="btn-quote-custom w-100 justify-content-between">
                <span>Request a Quote</span>
                <div class="icon-circle">
                    <i class="bi bi-chevron-right"></i>
                </div>
            </a>
        </div>
    </div>
</div>

<style>
    /* Hamburger Icon Animation */
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
        opacity: 1;
        left: 0;
        transform: rotate(0deg);
        transition: .25s ease-in-out;
    }
    .hamburger-icon span:nth-child(1) { top: 0px; }
    .hamburger-icon span:nth-child(2) { top: 8px; }
    .hamburger-icon span:nth-child(3) { top: 16px; }

    /* Mobile Sidebar Styles */
    .offcanvas {
        width: 85% !important;
        max-width: 350px !important;
    }
    .mobile-nav-link {
        display: block;
        font-size: 1.25rem;
        font-weight: 700;
        color: #333;
        text-decoration: none;
        padding: 10px 0;
        transition: all 0.3s ease;
    }
    .mobile-nav-link.active, .mobile-nav-link:hover {
        color: #004a99;
        padding-left: 10px;
    }
    .sidebar-icon-circle {
        width: 40px;
        height: 40px;
        background: #f8f9fa;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #004a99;
        font-size: 1.2rem;
    }
    .letter-spacing-1 { letter-spacing: 1px; }

    /* Header CSS refinement */
    .top-bar {
        background-color: #004a99 !important; /* Slightly darker premium blue */
        font-size: 0.85rem;
        font-family: 'Nunito', sans-serif;
    }
    .top-bar a {
        transition: opacity 0.2s ease;
    }
    .top-bar a:hover {
        opacity: 0.8;
    }
    @media (max-width: 576px) {
        .x-small-mobile {
            font-size: 0.7rem !important;
            padding: 4px 8px !important;
        }
        .top-info i {
            font-size: 0.9rem;
        }
        .top-info span {
            font-size: 0.75rem !important;
        }
    }
    .hover-opacity:hover {
        opacity: 0.85;
    }
    .hover-underline:hover {
        text-decoration: underline !important;
    }
    .navbar .nav-link {
        color: #0056b3 !important;
        font-family: 'Nunito', sans-serif;
        font-size: 1rem;
        transition: all 0.3s ease;
    }
    .navbar .nav-link:hover {
        color: #ffc107 !important; /* Warning/Gold color on hover */
        transform: translateY(-1px);
    }
    .navbar .nav-link.active {
        border-bottom: 2px solid #0056b3;
    }
    .top-bar .dropdown-item.active {
        background-color: #004a99;
    }
</style>

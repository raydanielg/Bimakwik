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
                    <i class="bi bi-globe2 me-1"></i> {{ strtoupper(app()->getLocale()) == 'SW' ? 'Kiswahili' : 'English' }}
                </a>
                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm rounded-3 mt-2" aria-labelledby="langDropdown">
                    <li><a class="dropdown-item small py-1" href="{{ route('lang.switch', 'en') }}">English</a></li>
                    <li><a class="dropdown-item small py-1" href="{{ route('lang.switch', 'sw') }}">Kiswahili</a></li>
                </ul>
            </div>
            <span class="text-white-50 d-none d-md-inline">|</span>
            <a href="{{ route('support.faqs') }}" class="text-white text-decoration-none small hover-underline d-none d-md-inline">{{ __('site.faqs') }}</a>
            <span class="text-white-50 d-none d-md-inline">|</span>
            <a href="{{ route('quote.request') }}" class="btn btn-warning btn-sm px-3 rounded-pill fw-bold text-dark shadow-sm">
                <i class="bi bi-file-earmark-text me-1"></i> {{ __('site.request_quote') }}
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
                    <a class="nav-link px-3 py-4 fw-bold {{ request()->is('/') ? 'active text-primary' : '' }}" href="{{ url('/') }}">{{ __('site.home') }}</a>
                </li>
                
                <!-- Platform Mega Menu -->
                <li class="nav-item dropdown has-megamenu">
                    <a class="nav-link dropdown-toggle px-3 py-4 fw-bold" href="#" data-bs-toggle="dropdown">{{ __('site.platform') }}</a>
                    <div class="dropdown-menu megamenu border-0 shadow-lg p-4 animate__animated animate__fadeInUp animate__faster" role="menu">
                        <div class="row g-4">
                            <div class="col-md-3 border-end">
                                <h6 class="fw-bold text-primary mb-3">{{ __('site.platform_overview') }}</h6>
                                <ul class="list-unstyled mega-list">
                                    <li><a href="{{ route('platform.overview') }}">{{ __('site.platform_overview') }}</a></li>
                                    <li><a href="{{ route('platform.overview') }}">{{ __('site.our_ecosystem') }}</a></li>
                                    <li><a href="{{ route('platform.overview') }}">{{ __('site.how_it_works') }}</a></li>
                                </ul>
                            </div>
                            <div class="col-md-3 border-end">
                                <h6 class="fw-bold text-primary mb-3">{{ __('site.for_customers') }}</h6>
                                <ul class="list-unstyled mega-list">
                                    <li><a href="{{ route('platform.customers') }}">{{ __('site.buy_insurance') }}</a></li>
                                    <li><a href="{{ route('platform.customers') }}">{{ __('site.file_claim') }}</a></li>
                                    <li><a href="{{ route('platform.customers') }}">{{ __('site.renew_policy') }}</a></li>
                                    <li><a href="{{ route('platform.customers') }}">{{ __('site.track_status') }}</a></li>
                                </ul>
                            </div>
                            <div class="col-md-3 border-end">
                                <h6 class="fw-bold text-primary mb-3">{{ __('site.technology') }}</h6>
                                <ul class="list-unstyled mega-list">
                                    <li><a href="{{ route('platform.technology') }}">{{ __('site.ai_powered') }}</a></li>
                                    <li><a href="{{ route('platform.technology') }}">{{ __('site.api_integration') }}</a></li>
                                    <li><a href="{{ route('platform.technology') }}">{{ __('site.low_code_builder') }}</a></li>
                                    <li><a href="{{ route('platform.technology') }}">{{ __('site.security') }}</a></li>
                                </ul>
                            </div>
                            <div class="col-md-3">
                                <h6 class="fw-bold text-primary mb-3">{{ __('site.expansion') }}</h6>
                                <ul class="list-unstyled mega-list">
                                    <li><a href="{{ route('platform.businesses') }}">{{ __('site.multi_country') }}</a></li>
                                    <li><a href="{{ route('platform.businesses') }}">{{ __('site.tiramis_replicable') }}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>

                <!-- Products Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle px-3 py-4 fw-bold" href="#" data-bs-toggle="dropdown">{{ __('site.products') }}</a>
                    <div class="dropdown-menu border-0 shadow-lg rounded-4 p-3 animate__animated animate__fadeInUp animate__faster">
                        <div class="d-flex flex-column gap-1" style="min-width: 250px;">
                            <a class="dropdown-item rounded-3 d-flex align-items-center p-2" href="{{ route('pages.products') }}">
                                <i class="bi bi-car-front text-primary me-3 fs-5"></i>
                                <div><span class="fw-bold d-block">{{ __('site.motor_insurance') }}</span><small class="text-muted">{{ __('site.motor_desc') }}</small></div>
                            </a>
                            <a class="dropdown-item rounded-3 d-flex align-items-center p-2" href="{{ route('products.health') }}">
                                <i class="bi bi-heart-pulse text-danger me-3 fs-5"></i>
                                <div><span class="fw-bold d-block">{{ __('site.health_insurance') }}</span><small class="text-muted">{{ __('site.health_desc') }}</small></div>
                            </a>
                            <a class="dropdown-item rounded-3 d-flex align-items-center p-2" href="{{ route('products.life') }}">
                                <i class="bi bi-umbrella text-info me-3 fs-5"></i>
                                <div><span class="fw-bold d-block">{{ __('site.life_insurance') }}</span><small class="text-muted">{{ __('site.life_desc') }}</small></div>
                            </a>
                            <a class="dropdown-item rounded-3 d-flex align-items-center p-2" href="{{ route('products.general') }}">
                                <i class="bi bi-box-seam text-success me-3 fs-5"></i>
                                <div><span class="fw-bold d-block">{{ __('site.general_insurance') }}</span><small class="text-muted">{{ __('site.general_desc') }}</small></div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item rounded-3 text-center fw-bold text-primary" href="{{ route('pages.products') }}">{{ __('site.view_all_products') }}</a>
                        </div>
                    </div>
                </li>

                <!-- Partners -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle px-3 py-4 fw-bold" href="#" data-bs-toggle="dropdown">{{ __('site.partners') }}</a>
                    <div class="dropdown-menu border-0 shadow-lg rounded-4 p-3 animate__animated animate__fadeInUp animate__faster">
                        <a class="dropdown-item rounded-3 p-2 mb-1" href="{{ route('partners.brokers') }}">{{ __('site.become_broker') }}</a>
                        <a class="dropdown-item rounded-3 p-2 mb-1" href="{{ route('partners.aggregators') }}">{{ __('site.become_aggregator') }}</a>
                        <a class="dropdown-item rounded-3 p-2 mb-1" href="{{ route('partners.providers') }}">{{ __('site.service_providers') }}</a>
                        <a class="dropdown-item rounded-3 p-2" href="{{ route('partners.affiliates') }}">{{ __('site.affiliate_program') }}</a>
                    </div>
                </li>

                <!-- Resources Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle px-3 py-4 fw-bold" href="#" data-bs-toggle="dropdown">{{ __('site.resources') }}</a>
                    <ul class="dropdown-menu border-0 shadow-lg rounded-4 p-3 animate__animated animate__fadeInUp animate__faster">
                        <li><a class="dropdown-item rounded-3 p-2 mb-1" href="{{ route('resources.news') }}">{{ __('site.learning_center') }}</a></li>
                        <li><a class="dropdown-item rounded-3 p-2 mb-1" href="{{ route('resources.news') }}">{{ __('site.blog_news') }}</a></li>
                        <li><a class="dropdown-item rounded-3 p-2 mb-1" href="{{ route('resources.guidelines') }}">{{ __('site.downloads') }}</a></li>
                        <li><a class="dropdown-item rounded-3 p-2" href="{{ route('support.faqs') }}">{{ __('site.faqs') }}</a></li>
                    </ul>
                </li>

                <!-- Company -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle px-3 py-4 fw-bold" href="#" data-bs-toggle="dropdown">{{ __('site.company') }}</a>
                    <div class="dropdown-menu border-0 shadow-lg rounded-4 p-3 animate__animated animate__fadeInUp animate__faster">
                        <a class="dropdown-item rounded-3 p-2 mb-1" href="{{ route('pages.about') }}">{{ __('site.about_us') }}</a>
                        <a class="dropdown-item rounded-3 p-2 mb-1" href="{{ route('company.story') }}">{{ __('site.our_story') }}</a>
                        <a class="dropdown-item rounded-3 p-2 mb-1" href="{{ route('company.leadership') }}">{{ __('site.leadership_team') }}</a>
                        <a class="dropdown-item rounded-3 p-2 mb-1" href="{{ route('company.careers') }}">{{ __('site.careers') }}</a>
                        <a class="dropdown-item rounded-3 p-2" href="{{ route('pages.contact') }}">{{ __('site.contact_us') }}</a>
                    </div>
                </li>

                <!-- Portal Access Dropdown -->
                <li class="nav-item dropdown ms-lg-2">
                    @auth
                        <a class="btn btn-outline-primary px-4 rounded-pill fw-bold dropdown-toggle" href="#" id="portalDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle me-1"></i> {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-4 p-3 mt-2 animate__animated animate__fadeInUp animate__faster" style="min-width: 250px;">
                            <li><h6 class="dropdown-header text-uppercase small letter-spacing-1 fw-bold text-muted mb-2">{{ __('site.my_account') }}</h6></li>
                            <li><a class="dropdown-item rounded-3 p-2 mb-1" href="{{ route('dashboard') }}"><i class="bi bi-speedometer2 me-2"></i> {{ __('site.go_to_dashboard') }}</a></li>
                            @if(auth()->user()->hasRole('customer'))
                                <li><a class="dropdown-item rounded-3 p-2 mb-1" href="{{ route('customer.profile') }}"><i class="bi bi-person me-2"></i> {{ __('site.view_profile') }}</a></li>
                                <li><a class="dropdown-item rounded-3 p-2 mb-1" href="{{ route('customer.policies.index') }}"><i class="bi bi-shield-check me-2"></i> {{ __('site.my_policies') }}</a></li>
                            @endif
                            <li><div class="dropdown-divider"></div></li>
                            <li>
                                <a class="dropdown-item rounded-3 p-2 text-danger fw-bold" href="{{ route('logout.get') }}">
                                    <i class="bi bi-box-arrow-right me-2"></i> {{ __('site.logout') }}
                                </a>
                            </li>
                        </ul>
                    @else
                        <a class="btn btn-outline-primary px-4 rounded-pill fw-bold dropdown-toggle" href="#" id="portalDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-lock me-1"></i> {{ __('site.portals') }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-4 p-3 mt-2 animate__animated animate__fadeInUp animate__faster" style="min-width: 250px;">
                            <li><h6 class="dropdown-header text-uppercase small letter-spacing-1 fw-bold text-muted mb-2">{{ __('site.create_account') }}</h6></li>
                            <li><a class="dropdown-item rounded-3 p-2 mb-1" href="{{ route('register.customer') }}">{{ __('site.customer_registration') }}</a></li>
                            <li><a class="dropdown-item rounded-3 p-2 mb-1" href="{{ route('register.broker') }}">{{ __('site.broker_registration') }}</a></li>
                            <li><a class="dropdown-item rounded-3 p-2 mb-1" href="{{ route('register.insurer') }}">{{ __('site.insurer_registration') }}</a></li>
                            <li><a class="dropdown-item rounded-3 p-2 mb-1" href="{{ route('register.provider') }}">{{ __('site.provider_registration') }}</a></li>
                            <li><div class="dropdown-divider"></div></li>
                            <li><h6 class="dropdown-header text-uppercase small letter-spacing-1 fw-bold text-muted mb-2">{{ __('site.member_login') }}</h6></li>
                            <li><a class="dropdown-item rounded-3 p-2 mb-1 fw-bold text-primary" href="{{ route('login') }}">{{ __('site.access_all_portals') }}</a></li>
                        </ul>
                    @endauth
                </li>

                <li class="nav-item ms-lg-2">
                    <a href="{{ route('register') }}" class="btn btn-primary px-4 rounded-pill fw-bold shadow-sm hover-lift-sm">
                        {{ __('site.get_started') }}
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
                <!-- Mobile Language Switcher -->
                <div class="d-flex align-items-center gap-2 mb-3">
                    <i class="bi bi-globe2 text-primary"></i>
                    <span class="small fw-bold text-muted">Language:</span>
                    <a href="{{ route('lang.switch', 'en') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3 {{ app()->getLocale() == 'en' ? 'active' : '' }}">English</a>
                    <a href="{{ route('lang.switch', 'sw') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3 {{ app()->getLocale() == 'sw' ? 'active' : '' }}">Kiswahili</a>
                </div>
                <a href="{{ route('login') }}" class="btn btn-outline-primary w-100 mb-3 rounded-pill fw-bold">{{ __('site.login') }}</a>
                <a href="{{ route('register') }}" class="btn btn-primary w-100 rounded-pill fw-bold shadow-sm">{{ __('site.join_bimakwik') }}</a>
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

    /* === Font: Plus Jakarta Sans for all header elements === */
    .top-bar,
    .top-bar a,
    .top-bar .dropdown-menu,
    .main-header,
    .main-header .nav-link,
    .main-header .navbar-brand,
    .main-header .btn,
    .main-header .dropdown-menu {
        font-family: 'Plus Jakarta Sans', 'Nunito', sans-serif;
    }

    /* === Top bar base === */
    .top-bar {
        background-color: #004a99 !important;
        font-size: 0.85rem;
        /* Critical: create stacking context ABOVE the sticky navbar (z-index 1020) */
        position: relative;
        z-index: 1030;
        overflow: visible !important;
    }

    /* === Language dropdown z-index fix === */
    .top-bar .dropdown {
        position: relative;
        z-index: 1031;
    }
    .top-bar .dropdown-menu {
        z-index: 1032 !important;
        overflow: visible !important;
        /* Smooth entry */
        animation: fadeDropIn 0.18s ease;
    }
    @keyframes fadeDropIn {
        from { opacity: 0; transform: translateY(-6px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* === Mobile: language dropdown full-width fix === */
    @media (max-width: 767.98px) {
        .top-bar .dropdown-menu {
            position: fixed !important;
            top: auto !important;
            left: 50% !important;
            transform: translateX(-50%) !important;
            min-width: 180px;
            z-index: 9999 !important;
            margin-top: 0 !important;
        }
    }

    .navbar .nav-link { color: #334155 !important; font-family: 'Plus Jakarta Sans', 'Nunito', sans-serif; font-size: 0.95rem; font-weight: 600; transition: all 0.2s ease; }
    .navbar .nav-link:hover { color: #0d6efd !important; }
    .navbar .nav-link.active { color: #0d6efd !important; }

    /* === Navbar brand stronger === */
    .navbar-brand {
        font-family: 'Plus Jakarta Sans', 'Nunito', sans-serif;
        font-weight: 800;
        letter-spacing: -0.5px;
    }
    
    .hover-lift-sm:hover { transform: translateY(-2px); transition: transform 0.2s; }
</style>

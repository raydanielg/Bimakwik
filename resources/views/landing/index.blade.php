@extends('layouts.landing')

@section('content')
<!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<style>
    .hero-slider {
        width: 100%;
        height: 600px;
        position: relative;
    }
    .hero-slide {
        background-size: cover;
        background-position: center;
        position: relative;
        display: flex;
        align-items: center;
    }
    .hero-slide::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(rgba(0, 74, 153, 0.6), rgba(0, 74, 153, 0.3)); /* Primary color gradient overlay */
        z-index: 1;
    }
    .hero-content {
        position: relative;
        z-index: 2;
        color: white;
    }
    .swiper-button-next, .swiper-button-prev {
        color: white;
        background: rgba(255, 193, 7, 0.2);
        width: 50px;
        height: 50px;
        border-radius: 50%;
        backdrop-filter: blur(5px);
    }
    .swiper-button-next:after, .swiper-button-prev:after {
        font-size: 20px;
        font-weight: bold;
    }
    .swiper-pagination-bullet-active {
        background: #ffc107 !important;
    }
    .floating-badge {
        background: rgba(255, 193, 7, 0.9);
        color: #000;
        padding: 5px 15px;
        border-radius: 50px;
        display: inline-block;
        font-weight: bold;
        margin-bottom: 20px;
    }
</style>

<!-- Hero Slider -->
<div class="swiper hero-slider">
    <div class="swiper-wrapper">
        <!-- Slide 1 -->
        <div class="swiper-slide hero-slide" style="background-image: url('{{ asset('hero/black-man-shaking-hands_780608-4320.jpg') }}');">
            <div class="container hero-content">
                <div class="row">
                    <div class="col-lg-7">
                        <span class="floating-badge animate__animated animate__fadeInDown">Trust & Reliability</span>
                        <h1 class="display-2 fw-bold mb-4 animate__animated animate__fadeInUp" style="animation-delay: 0.2s">Insurance Protection for Every <span class="text-warning">Moment</span></h1>
                        <p class="lead mb-5 animate__animated animate__fadeInUp" style="animation-delay: 0.4s">Secure your future with BimaKwik. We provide reliable health, motor, and life insurance tailored for you.</p>
                        <div class="d-flex gap-3 animate__animated animate__fadeInUp" style="animation-delay: 0.6s">
                            <a href="{{ route('register') }}" class="btn btn-warning btn-lg px-5 rounded-pill fw-bold shadow">Get Started</a>
                            <a href="#" class="btn btn-outline-light btn-lg px-5 rounded-pill">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Slide 2 -->
        <div class="swiper-slide hero-slide" style="background-image: url('{{ asset('hero/explain-black-man-laptop-office-meeting-ideas-project-with-teamwork-collaboration-employee-discussion-boardroom-with-research-partnership-strategy-as-lawyers_590464-394339.jpg') }}');">
            <div class="container hero-content text-center">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <h1 class="display-3 fw-bold mb-4">Digital Solutions for Modern <span class="text-warning">Business</span></h1>
                        <p class="lead mb-5">Professional consulting and comprehensive coverage for your business needs.</p>
                        <a href="#" class="btn btn-warning btn-lg px-5 rounded-pill fw-bold shadow">View Business Plans</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Slide 3 -->
        <div class="swiper-slide hero-slide" style="background-image: url('{{ asset('hero/smiling-man-purchasing-clothes-internet-with-credit-card_482257-92484.jpg') }}');">
            <div class="container hero-content text-end">
                <div class="row justify-content-end">
                    <div class="col-lg-7">
                        <h1 class="display-3 fw-bold mb-4">Quick & Easy <span class="text-warning">Claims</span></h1>
                        <p class="lead mb-5">Experience seamless digital claims processing with BimaKwik.</p>
                        <a href="#" class="btn btn-warning btn-lg px-5 rounded-pill fw-bold shadow">Claim Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pagination Only -->
    <div class="swiper-pagination hero-pagination"></div>
</div>

<style>
    /* Professional Subtle Pagination */
    .hero-pagination .swiper-pagination-bullet {
        width: 12px;
        height: 12px;
        background: #fff;
        opacity: 0.5;
        transition: all 0.3s ease;
    }
    .hero-pagination .swiper-pagination-bullet-active {
        width: 30px;
        border-radius: 20px;
        background: #ffc107; /* Warning Yellow */
        opacity: 1;
    }
</style>

<!-- Insurance Packages Section -->
<section class="py-5 bg-white overflow-hidden">
    <div class="container py-5">
        <div class="row align-items-center mb-5 animate__animated animate__fadeIn">
            <div class="col-lg-6">
                <h2 class="display-5 fw-bold mb-3">Insurance Packages.</h2>
                <p class="lead text-secondary">Comprehensive Insurance Packages: Protecting What Matters Most</p>
            </div>
            <div class="col-lg-6 text-lg-end">
                <p class="text-secondary">Streamline your insurance experience with our comprehensive platform. Find quotes for all your insurance needs in one convenient place.</p>
            </div>
        </div>

        <div class="swiper packages-slider pb-5">
            <div class="swiper-wrapper">
                <!-- Package 1: Motor -->
                <div class="swiper-slide h-auto">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden package-card">
                        <div class="package-img-wrapper position-relative">
                            <img src="https://www.bimakwik.com/wp-content/uploads/2024/03/car-in.jpg" class="card-img-top" alt="Motor Insurance" style="height: 300px; object-fit: cover;">
                            <div class="package-overlay d-flex flex-column justify-content-end p-4">
                                <h6 class="text-white-50 text-uppercase small mb-2">Vehicles</h6>
                                <h3 class="text-white fw-bold mb-3">Motor Insurance</h3>
                                <div class="package-details animate__animated">
                                    <p class="text-white-50 small mb-4">Coverage for damages to your vehicle and liabilities arising from accidents.</p>
                                    <a href="#" class="btn btn-warning btn-sm px-4 rounded-pill fw-bold">Learn More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Package 2: Home -->
                <div class="swiper-slide h-auto">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden package-card">
                        <div class="package-img-wrapper position-relative">
                            <img src="https://www.bimakwik.com/wp-content/uploads/2024/03/home-in.jpg" class="card-img-top" alt="Home Insurance" style="height: 300px; object-fit: cover;">
                            <div class="package-overlay d-flex flex-column justify-content-end p-4">
                                <h6 class="text-white-50 text-uppercase small mb-2">Home</h6>
                                <h3 class="text-white fw-bold mb-3">Home Insurance</h3>
                                <div class="package-details animate__animated">
                                    <p class="text-white-50 small mb-4">Protection for your house and belongings against fire, theft, or natural disasters.</p>
                                    <a href="#" class="btn btn-warning btn-sm px-4 rounded-pill fw-bold">Learn More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Package 3: Health -->
                <div class="swiper-slide h-auto">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden package-card">
                        <div class="package-img-wrapper position-relative">
                            <img src="https://www.bimakwik.com/wp-content/uploads/2021/09/health-in.jpg" class="card-img-top" alt="Health Insurance" style="height: 300px; object-fit: cover;">
                            <div class="package-overlay d-flex flex-column justify-content-end p-4">
                                <h6 class="text-white-50 text-uppercase small mb-2">Healthcare</h6>
                                <h3 class="text-white fw-bold mb-3">Health Insurance</h3>
                                <div class="package-details animate__animated">
                                    <p class="text-white-50 small mb-4">Comprehensive coverage for medical expenses and healthcare needs.</p>
                                    <a href="#" class="btn btn-warning btn-sm px-4 rounded-pill fw-bold">Learn More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Package 4: Travel -->
                <div class="swiper-slide h-auto">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden package-card">
                        <div class="package-img-wrapper position-relative">
                            <img src="https://www.bimakwik.com/wp-content/uploads/2024/03/travel-insurance.jpg" class="card-img-top" alt="Travel Insurance" style="height: 300px; object-fit: cover;">
                            <div class="package-overlay d-flex flex-column justify-content-end p-4">
                                <h6 class="text-white-50 text-uppercase small mb-2">Travel</h6>
                                <h3 class="text-white fw-bold mb-3">Travel Insurance</h3>
                                <div class="package-details animate__animated">
                                    <p class="text-white-50 small mb-4">Insurance for unexpected events during trips, medical emergencies, or lost luggage.</p>
                                    <a href="#" class="btn btn-warning btn-sm px-4 rounded-pill fw-bold">Learn More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>

        <div class="text-center mt-4">
            <p class="text-secondary">Our nearly 20+ staff members are committed and ready to help.</p>
        </div>
    </div>
</section>

<!-- Mobile App Section -->
<section class="py-5 bg-dark text-white overflow-hidden position-relative" style="background: linear-gradient(135deg, #1a1a1a 0%, #0d0d0d 100%);">
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0 animate__animated animate__fadeInLeft">
                <h6 class="text-primary fw-bold text-uppercase mb-3">Our Mobile App</h6>
                <h2 class="display-5 fw-bold mb-4">Insurance in Your Pocket</h2>
                <p class="lead text-white-50 mb-5">Experience the future of insurance with our upcoming mobile applications. Whether you are a customer looking for protection or a referrer aiming to grow your business, Bima Kwik is coming to your phone soon.</p>
                
                <div class="row g-4 mb-5">
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center p-3 bg-white bg-opacity-10 rounded-4 border border-white border-opacity-10">
                            <div class="icon-box bg-primary p-2 rounded-3 me-3">
                                <i class="bi bi-android2 fs-4"></i>
                            </div>
                            <h6 class="fw-bold mb-0">Android</h6>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center p-3 bg-white bg-opacity-10 rounded-4 border border-white border-opacity-10">
                            <div class="icon-box bg-white bg-opacity-20 p-2 rounded-3 me-3">
                                <i class="bi bi-apple fs-4"></i>
                            </div>
                            <h6 class="fw-bold mb-0">iOS</h6>
                        </div>
                    </div>
                </div>

                <div class="d-flex flex-wrap gap-4 align-items-center">
                    <!-- Play Store -->
                    <div class="position-relative">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg" alt="Google Play" height="60" style="filter: grayscale(1) opacity(0.5);">
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning text-dark px-3 py-2 fw-bold animate__animated animate__pulse animate__infinite" style="font-size: 0.65rem; z-index: 2;">Coming Soon</span>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning text-dark px-3 py-2 fw-bold animate__animated animate__pulse animate__infinite" style="font-size: 0.65rem; z-index: 2;">COMING SOON</span>
                    </div>
                    <!-- App Store -->
                    <div class="position-relative">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/3/3c/Download_on_the_App_Store_Badge_US-UK_RGB_blk_092917.svg" alt="App Store" height="60" style="filter: grayscale(1) opacity(0.5);">
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning text-dark px-3 py-2 fw-bold animate__animated animate__pulse animate__infinite" style="font-size: 0.65rem; z-index: 2;">COMING SOON</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 animate__animated animate__fadeInRight">
                <div class="position-relative text-center">
                    <!-- Background Glow -->
                    <div class="position-absolute top-50 start-50 translate-middle bg-primary rounded-circle blur-3xl opacity-25" style="width: 400px; height: 400px; filter: blur(100px);"></div>
                    <img src="https://img.freepik.com/free-psd/premium-mobile-phone-screen-mockup_53876-113350.jpg?t=st=1715168172~exp=1715171772~hmac=556942484432130e5270c56780c1097240f968987483733075c3175865662768&w=800" alt="Mobile App" class="img-fluid rounded-5 shadow-2xl position-relative" style="max-width: 300px; transform: rotate(-10deg);">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Trusted By Section -->
<section class="py-5 bg-white border-top">
    <div class="container py-4">
        <div class="text-center mb-5 animate__animated animate__fadeIn">
            <h6 class="text-secondary fw-bold text-uppercase small letter-spacing-1 mb-4">Trusted by global companies</h6>
        </div>
        <div class="row align-items-center justify-content-center g-5">
            <div class="col-6 col-md-3 col-lg-2 text-center">
                <img src="{{ asset('myheritage.png') }}" alt="MyHeritage" class="img-fluid partner-logo grayscale">
            </div>
            <div class="col-6 col-md-3 col-lg-2 text-center">
                <img src="{{ asset('rebohoth.png') }}" alt="Rebohoth" class="img-fluid partner-logo grayscale">
            </div>
            <div class="col-6 col-md-3 col-lg-2 text-center">
                <img src="{{ asset('ilinklogo.png') }}" alt="iLink" class="img-fluid partner-logo grayscale">
            </div>
            <div class="col-6 col-md-3 col-lg-2 text-center">
                <img src="{{ asset('ibank.png') }}" alt="iBank" class="img-fluid partner-logo grayscale">
            </div>
        </div>
    </div>
</section>

<!-- Why Bimakwik Comparison Section -->
<section class="py-5 bg-primary text-white position-relative overflow-hidden why-comparison">
    <div class="container py-5 z-index-1">
        <div class="text-center mb-5 animate__animated animate__fadeIn">
            <h2 class="display-5 fw-bold mb-3">Why BimaKwik</h2>
            <p class="text-white-50 mx-auto" style="max-width: 600px;">Compare our digital-first approach with traditional insurance experiences.</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="table-responsive">
                    <table class="table table-borderless text-white comparison-table align-middle">
                        <thead>
                            <tr class="border-bottom border-white border-opacity-10">
                                <th class="py-4 h4 fw-bold text-warning" style="width: 20%;">Feature</th>
                                <th class="py-4 text-center h4 fw-bold" style="width: 60%;">Our Digital Advantage</th>
                                <th class="py-4 text-center text-white fw-normal small" style="width: 20%;">Other Companies</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Trusted Row -->
                            <tr class="border-bottom border-white border-opacity-10">
                                <td class="py-4 fw-bold h5">Trusted</td>
                                <td class="py-4 text-center px-4">
                                    <p class="mb-0 h6 fw-normal" style="line-height: 1.6;">Recorded Lines - No Misselling - Know your Advisor, Insurance Digital Platform (IDP’s) Approved.</p>
                                </td>
                                <td class="py-4 text-center">
                                    <i class="bi bi-x-lg text-white h4"></i>
                                </td>
                            </tr>
                            <!-- Product Row -->
                            <tr class="border-bottom border-white border-opacity-10">
                                <td class="py-4 fw-bold h5">Product</td>
                                <td class="py-4 text-center px-4">
                                    <p class="mb-0 h6 fw-normal" style="line-height: 1.6;">Verified Leading brands, Reputation Check, Quick Comparison Check of Features, Brand & Price, Thorough Product Research Before Launch.</p>
                                </td>
                                <td class="py-4 text-center">
                                    <i class="bi bi-x-lg text-white h4"></i>
                                </td>
                            </tr>
                            <!-- Convenience Row -->
                            <tr class="border-bottom border-white border-opacity-10">
                                <td class="py-4 fw-bold h5">Convenience</td>
                                <td class="py-4 text-center px-4">
                                    <p class="mb-0 h6 fw-normal" style="line-height: 1.6;">100% Digital - Takes 5 Mins, No Documents, Free Advise via WhatsApp, Email or Call, Quick Comparison Charts & Tables</p>
                                </td>
                                <td class="py-4 text-center">
                                    <i class="bi bi-x-lg text-white h4"></i>
                                </td>
                            </tr>
                            <!-- Support Row -->
                            <tr class="border-bottom border-white border-opacity-10">
                                <td class="py-4 fw-bold h5">Support</td>
                                <td class="py-4 text-center px-4">
                                    <p class="mb-0 h6 fw-normal" style="line-height: 1.6;">Dedicated Claims & Guidance Online Free Helpdesk. We’re With You Always - Renewal & Support</p>
                                </td>
                                <td class="py-4 text-center">
                                    <i class="bi bi-x-lg text-white h4"></i>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="text-center mt-5">
                    <a href="{{ route('quote.request') }}" class="btn-quote-custom">
                        <span>Ready to Switch? Request a Quote</span>
                        <div class="icon-circle">
                            <i class="bi bi-chevron-right"></i>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .partner-logo {
        max-height: 50px;
        transition: all 0.3s ease;
    }
    .grayscale {
        filter: grayscale(100%) opacity(0.6);
    }
    .partner-logo:hover {
        filter: grayscale(0%) opacity(1);
    }
    .why-comparison {
        background-color: #004a99 !important; /* Premium blue */
    }
    .comparison-table td, .comparison-table th {
        background: transparent;
    }
    .z-index-1 { z-index: 1; position: relative; }
    .why-comparison::before {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0; left: 0;
        background-image: radial-gradient(circle at 10% 20%, rgba(255, 255, 255, 0.05) 0%, transparent 50%);
        pointer-events: none;
    }
</style>

<style>
    .package-card {
        transition: all 0.3s ease;
    }
    .package-img-wrapper::after {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: linear-gradient(to bottom, transparent 0%, rgba(0,0,0,0.8) 100%);
        z-index: 1;
    }
    .package-overlay {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        z-index: 2;
        transition: all 0.3s ease;
    }
    .package-details {
        max-height: 0;
        opacity: 0;
        overflow: hidden;
        transition: all 0.5s ease;
    }
    .package-card:hover .package-details {
        max-height: 200px;
        opacity: 1;
    }
    .package-card:hover {
        transform: translateY(-10px);
    }
    .package-card:hover img {
        transform: scale(1.1);
        transition: transform 0.8s ease;
    }
    .bg-primary-soft { background-color: rgba(0, 86, 179, 0.1); }
</style>

<!-- Blog Section -->
<section class="py-5 bg-white overflow-hidden">
    <div class="container py-5">
        <div class="row align-items-center mb-5 animate__animated animate__fadeIn">
            <div class="col-md-8 text-center text-md-start mb-4 mb-md-0">
                <h6 class="text-primary fw-bold text-uppercase mb-3 small letter-spacing-1">Latest Updates</h6>
                <h2 class="display-5 fw-bold">Our News & Blogs</h2>
                <p class="text-secondary mb-0">Stay informed with the latest insights and news from the insurance industry.</p>
            </div>
            <div class="col-md-4 text-center text-md-end">
                <a href="{{ route('resources.news') }}" class="btn-quote-custom">
                    <span>View All Blogs</span>
                    <div class="icon-circle">
                        <i class="bi bi-chevron-right"></i>
                    </div>
                </a>
            </div>
        </div>

        <div class="swiper blog-slider pb-5">
            <div class="swiper-wrapper">
                <!-- Blog 1 -->
                <div class="swiper-slide h-auto">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden hover-lift">
                        <div class="position-relative">
                            <img src="https://www.bimakwik.com/wp-content/uploads/2024/07/family.webp" class="card-img-top" alt="Blog 1" style="height: 240px; object-fit: cover;">
                            <span class="badge bg-primary position-absolute top-0 start-0 m-3 rounded-pill">Digital</span>
                        </div>
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center gap-2 mb-3 small text-muted">
                                <i class="bi bi-calendar3"></i> May 08, 2026
                            </div>
                            <h4 class="fw-bold mb-3 h5">How Digital Insurance is Changing Tanzania</h4>
                            <p class="text-secondary small mb-4">Discover the impact of technology on making insurance more accessible to every Tanzanian...</p>
                            <a href="#" class="text-primary fw-bold text-decoration-none small">Read More <i class="bi bi-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Blog 2 -->
                <div class="swiper-slide h-auto">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden hover-lift">
                        <div class="position-relative">
                            <img src="https://www.bimakwik.com/wp-content/uploads/2024/03/travel-insurance.jpg" class="card-img-top" alt="Blog 2" style="height: 240px; object-fit: cover;">
                            <span class="badge bg-success position-absolute top-0 start-0 m-3 rounded-pill">Travel</span>
                        </div>
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center gap-2 mb-3 small text-muted">
                                <i class="bi bi-calendar3"></i> May 05, 2026
                            </div>
                            <h4 class="fw-bold mb-3 h5">Top 5 Reasons You Need Travel Insurance</h4>
                            <p class="text-secondary small mb-4">Planning your next trip? Here is why having insurance should be your top priority...</p>
                            <a href="#" class="text-primary fw-bold text-decoration-none small">Read More <i class="bi bi-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Blog 3 -->
                <div class="swiper-slide h-auto">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden hover-lift">
                        <div class="position-relative">
                            <img src="https://www.bimakwik.com/wp-content/uploads/2024/03/home-in.jpg" class="card-img-top" alt="Blog 3" style="height: 240px; object-fit: cover;">
                            <span class="badge bg-warning text-dark position-absolute top-0 start-0 m-3 rounded-pill">Security</span>
                        </div>
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center gap-2 mb-3 small text-muted">
                                <i class="bi bi-calendar3"></i> May 02, 2026
                            </div>
                            <h4 class="fw-bold mb-3 h5">Protecting Your Home: A Simple Guide</h4>
                            <p class="text-secondary small mb-4">Learn the basics of home insurance and how it can safeguard your most valuable asset...</p>
                            <a href="#" class="text-primary fw-bold text-decoration-none small">Read More <i class="bi bi-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Pagination dots -->
            <div class="swiper-pagination blog-pagination"></div>
        </div>
    </div>
</section>

<style>
    /* Blog Slider Custom Pagination */
    .blog-pagination {
        bottom: 0 !important;
    }
    .blog-pagination .swiper-pagination-bullet {
        width: 10px;
        height: 10px;
        background: #004a99;
        opacity: 0.3;
    }
    .blog-pagination .swiper-pagination-bullet-active {
        width: 25px;
        border-radius: 20px;
        background: #004a99;
        opacity: 1;
    }
</style>

<!-- Testimonials Section -->
<section class="py-5 bg-light overflow-hidden">
    <div class="container py-5 text-center">
        <div class="mb-5 animate__animated animate__fadeIn">
            <span class="badge rounded-pill px-3 py-2 mb-3" style="background-color: rgba(0, 86, 179, 0.1); color: #0056b3; font-size: 0.75rem; letter-spacing: 1px;">
                <i class="bi bi-quote me-1"></i> TESTIMONIALS
            </span>
            <h2 class="display-5 fw-bold mb-3" style="color: #1a202c;">What Our Clients Say</h2>
            <p class="text-secondary mx-auto" style="max-width: 650px; font-size: 0.95rem;">Feedback from customers across Tanzania using BimaKwik to protect their future and manage insurance with ease.</p>
        </div>

        <div class="swiper testimonials-slider pb-5">
            <div class="swiper-wrapper">
                <!-- Testimonial 1 -->
                <div class="swiper-slide h-auto">
                    <div class="mx-auto" style="max-width: 800px;">
                        <div class="mb-4">
                            <i class="bi bi-quote text-secondary opacity-25" style="font-size: 4rem; line-height: 1;"></i>
                        </div>
                        <h4 class="fw-bold mb-5 px-lg-5" style="color: #2d3748; line-height: 1.6;">
                            "BimaKwik has revolutionized how I handle my motor insurance. The process is entirely digital, fast, and very professional. Highly recommended!"
                        </h4>
                        <div class="d-flex align-items-center justify-content-center gap-3">
                            <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold text-white shadow-sm" style="width: 45px; height: 45px; background-color: #b91c1c; font-size: 0.9rem;">
                                AM
                            </div>
                            <div class="text-start">
                                <h6 class="fw-bold mb-0" style="color: #1a202c;">Abubakar Mwinyi</h6>
                                <p class="text-secondary mb-0 small">Business Owner, Dar es Salaam</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="swiper-slide h-auto">
                    <div class="mx-auto" style="max-width: 800px;">
                        <div class="mb-4">
                            <i class="bi bi-quote text-secondary opacity-25" style="font-size: 4rem; line-height: 1;"></i>
                        </div>
                        <h4 class="fw-bold mb-5 px-lg-5" style="color: #2d3748; line-height: 1.6;">
                            "The health insurance support is exceptional. I managed to process my family's claims in record time without any physical office visits."
                        </h4>
                        <div class="d-flex align-items-center justify-content-center gap-3">
                            <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold text-white shadow-sm" style="width: 45px; height: 45px; background-color: #0369a1; font-size: 0.9rem;">
                                NJ
                            </div>
                            <div class="text-start">
                                <h6 class="fw-bold mb-0" style="color: #1a202c;">Neema Joseph</h6>
                                <p class="text-secondary mb-0 small">Project Manager, Arusha</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="swiper-slide h-auto">
                    <div class="mx-auto" style="max-width: 800px;">
                        <div class="mb-4">
                            <i class="bi bi-quote text-secondary opacity-25" style="font-size: 4rem; line-height: 1;"></i>
                        </div>
                        <h4 class="fw-bold mb-5 px-lg-5" style="color: #2d3748; line-height: 1.6;">
                            "I've finally found an insurance partner that values transparency and education. BimaKwik's team is knowledgeable and very helpful."
                        </h4>
                        <div class="d-flex align-items-center justify-content-center gap-3">
                            <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold text-white shadow-sm" style="width: 45px; height: 45px; background-color: #15803d; font-size: 0.9rem;">
                                KS
                            </div>
                            <div class="text-start">
                                <h6 class="fw-bold mb-0" style="color: #1a202c;">Kelvin Shayo</h6>
                                <p class="text-secondary mb-0 small">Tech Entrepreneur, Mwanza</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Slider Pagination -->
            <div class="swiper-pagination mt-5"></div>
        </div>
    </div>
</section>

<style>
    .products-slider .swiper-pagination-bullet-active {
        background: #0056b3 !important;
    }
    .feature-icon {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        font-size: 24px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
</style>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const heroSwiper = new Swiper('.hero-slider', {
            effect: 'fade',
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: false, 
        });

        const productsSwiper = new Swiper('.products-slider', {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
            },
        });

        const packagesSwiper = new Swiper('.packages-slider', {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                768: {
                    slidesPerView: 2,
                },
                1200: {
                    slidesPerView: 3,
                },
            },
        });

        const blogSwiper = new Swiper('.blog-slider', {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            autoplay: {
                delay: 4500,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.blog-pagination',
                clickable: true,
            },
            breakpoints: {
                768: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
            },
        });

        const testimonialsSwiper = new Swiper('.testimonials-slider', {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                768: {
                    slidesPerView: 2,
                },
                1200: {
                    slidesPerView: 3,
                },
            },
        });
    });
</script>
@endsection

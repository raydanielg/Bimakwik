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
    <!-- Pagination & Navigation -->
    <div class="swiper-pagination"></div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
</div>

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

<!-- Why Bimakwik Section -->
<section class="py-5 bg-dark text-white">
    <div class="container py-5">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="display-5 fw-bold mb-3">Why BimaKwik</h2>
                <p class="text-secondary">Delivering Confidence in Every Partnership</p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-md-3">
                <div class="p-4 rounded-4 border border-secondary border-opacity-25 h-100">
                    <h4 class="fw-bold mb-3 text-warning">Trusted</h4>
                    <p class="text-secondary small">Recorded Lines - No Misselling - Know your Advisor, IDP's Approved.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-4 rounded-4 border border-secondary border-opacity-25 h-100">
                    <h4 class="fw-bold mb-3 text-warning">Product</h4>
                    <p class="text-secondary small">Verified Leading brands, Reputation Check, Quick Comparison, Thorough Research.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-4 rounded-4 border border-secondary border-opacity-25 h-100">
                    <h4 class="fw-bold mb-3 text-warning">Convenience</h4>
                    <p class="text-secondary small">100% Digital-Takes 5 Mins, No Documents, Free Advice via WhatsApp/Email/Call.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-4 rounded-4 border border-secondary border-opacity-25 h-100">
                    <h4 class="fw-bold mb-3 text-warning">Support</h4>
                    <p class="text-secondary small">Dedicated Claims Guidance, Online Free Helpdesk, Renewals & Always With You.</p>
                </div>
            </div>
        </div>
    </div>
</section>

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
<section class="py-5 bg-white">
    <div class="container py-5">
        <div class="row align-items-center mb-5 animate__animated animate__fadeIn">
            <div class="col-md-8 text-center text-md-start">
                <h6 class="text-primary fw-bold text-uppercase mb-3">Latest Updates</h6>
                <h2 class="display-5 fw-bold">Our News & Blogs</h2>
                <p class="text-secondary">Stay informed with the latest insights and news from the insurance industry.</p>
            </div>
            <div class="col-md-4 text-center text-md-end d-none d-md-block">
                <a href="#" class="btn btn-outline-primary px-4 rounded-pill fw-bold">View All Posts <i class="bi bi-arrow-right ms-1"></i></a>
            </div>
        </div>

        <div class="row g-4">
            <!-- Blog 1 -->
            <div class="col-md-4 animate__animated animate__fadeInUp" style="animation-delay: 0.1s">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden hover-lift">
                    <img src="https://images.unsplash.com/photo-1450101499163-c8848c66ca85?auto=format&fit=crop&q=80&w=800" class="card-img-top" alt="Blog 1" style="height: 200px; object-fit: cover;">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <span class="badge bg-primary-soft text-primary rounded-pill px-3 py-2 small" style="background-color: rgba(13, 110, 253, 0.1);">Insurance Tips</span>
                            <span class="text-secondary small ms-3"><i class="bi bi-calendar3 me-1"></i> May 5, 2026</span>
                        </div>
                        <h5 class="fw-bold mb-3">Why You Need Life Insurance in 2026</h5>
                        <p class="text-secondary small mb-4">Discover the key reasons why life insurance is more important than ever for your family's future security...</p>
                        <a href="#" class="text-primary fw-bold text-decoration-none small">Read More <i class="bi bi-chevron-right ms-1"></i></a>
                    </div>
                </div>
            </div>

            <!-- Blog 2 -->
            <div class="col-md-4 animate__animated animate__fadeInUp" style="animation-delay: 0.2s">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden hover-lift">
                    <img src="https://images.unsplash.com/photo-1533134486753-c833f0ed4866?auto=format&fit=crop&q=80&w=800" class="card-img-top" alt="Blog 2" style="height: 200px; object-fit: cover;">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <span class="badge bg-success-soft text-success rounded-pill px-3 py-2 small" style="background-color: rgba(25, 135, 84, 0.1);">Digital Trends</span>
                            <span class="text-secondary small ms-3"><i class="bi bi-calendar3 me-1"></i> May 2, 2026</span>
                        </div>
                        <h5 class="fw-bold mb-3">The Future of Digital Claims Processing</h5>
                        <p class="text-secondary small mb-4">How BimaKwik is leading the way in making insurance claims faster and more efficient using AI...</p>
                        <a href="#" class="text-primary fw-bold text-decoration-none small">Read More <i class="bi bi-chevron-right ms-1"></i></a>
                    </div>
                </div>
            </div>

            <!-- Blog 3 -->
            <div class="col-md-4 animate__animated animate__fadeInUp" style="animation-delay: 0.3s">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden hover-lift">
                    <img src="https://images.unsplash.com/photo-1512428559087-560fa5ceab42?auto=format&fit=crop&q=80&w=800" class="card-img-top" alt="Blog 3" style="height: 200px; object-fit: cover;">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <span class="badge bg-warning-soft text-warning rounded-pill px-3 py-2 small" style="background-color: rgba(255, 193, 7, 0.1);">Safety First</span>
                            <span class="text-secondary small ms-3"><i class="bi bi-calendar3 me-1"></i> April 28, 2026</span>
                        </div>
                        <h5 class="fw-bold mb-3">Protecting Your Vehicle During Floods</h5>
                        <p class="text-secondary small mb-4">Essential steps every car owner should take to minimize damage during the heavy rainy seasons...</p>
                        <a href="#" class="text-primary fw-bold text-decoration-none small">Read More <i class="bi bi-chevron-right ms-1"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-5 d-md-none">
            <a href="#" class="btn btn-outline-primary px-5 rounded-pill fw-bold">View All Posts</a>
        </div>
    </div>
</section>

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
        const swiper = new Swiper('.hero-slider', {
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            effect: 'fade',
            fadeEffect: {
                crossFade: true
            },
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

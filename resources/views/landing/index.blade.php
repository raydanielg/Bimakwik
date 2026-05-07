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

<section class="py-5 bg-light">
    <div class="container py-5">
        <div class="text-center mb-5 animate__animated animate__fadeIn">
            <h6 class="text-primary fw-bold text-uppercase mb-3">Comprehensive Coverage</h6>
            <h2 class="display-5 fw-bold">Our Insurance Products</h2>
            <p class="text-secondary mx-auto" style="max-width: 600px;">Explore our wide range of insurance solutions designed to protect you, your family, and your business.</p>
        </div>

        <!-- Products Slider -->
        <div class="swiper products-slider pb-5">
            <div class="swiper-wrapper">
                <!-- Fire Insurance -->
                <div class="swiper-slide h-auto">
                    <div class="card h-100 border-0 shadow-sm p-4 hover-lift rounded-4 m-2">
                        <div class="feature-icon bg-danger text-white mb-4">
                            <i class="bi bi-fire"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Fire Insurance</h4>
                        <p class="text-secondary small">Fire insurance is insurance that protects against losses incurred by fire disasters. A fire disaster can happen at any time, and when happen, both bring losses to the building.</p>
                    </div>
                </div>

                <!-- Bond Insurance -->
                <div class="swiper-slide h-auto">
                    <div class="card h-100 border-0 shadow-sm p-4 hover-lift rounded-4 m-2">
                        <div class="feature-icon bg-info text-white mb-4">
                            <i class="bi bi-safe2"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Bond Insurance</h4>
                        <p class="text-secondary small">Also known as "financial guaranty insurance", guarantees scheduled payments of interest and principal on a bond in the event of default by the issuer.</p>
                    </div>
                </div>

                <!-- Marine Insurance -->
                <div class="swiper-slide h-auto">
                    <div class="card h-100 border-0 shadow-sm p-4 hover-lift rounded-4 m-2">
                        <div class="feature-icon bg-primary text-white mb-4">
                            <i class="bi bi-tsunami"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Marine Insurance</h4>
                        <p class="text-secondary small">Insurance of water vessels (yachts, boats, and ships) against loss or damage to hull, engines, caused by perils of navigable waters.</p>
                    </div>
                </div>

                <!-- Personal Accident Insurance -->
                <div class="swiper-slide h-auto">
                    <div class="card h-100 border-0 shadow-sm p-4 hover-lift rounded-4 m-2">
                        <div class="feature-icon bg-success text-white mb-4">
                            <i class="bi bi-heart-pulse"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Personal Accident</h4>
                        <p class="text-secondary small">Designed to protect you against accidents that are not a result of anyone's fault. Be prepared financially for unexpected events.</p>
                    </div>
                </div>

                <!-- Motor Insurance -->
                <div class="swiper-slide h-auto">
                    <div class="card h-100 border-0 shadow-sm p-4 hover-lift rounded-4 m-2">
                        <div class="feature-icon bg-dark text-white mb-4">
                            <i class="bi bi-car-front"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Motor Insurance</h4>
                        <p class="text-secondary small">Third-party and Comprehensive motor insurance covering vehicles for loss, damage, and third-party liabilities anywhere in Tanzania.</p>
                    </div>
                </div>

                <!-- Money Insurance -->
                <div class="swiper-slide h-auto">
                    <div class="card h-100 border-0 shadow-sm p-4 hover-lift rounded-4 m-2">
                        <div class="feature-icon bg-warning text-dark mb-4">
                            <i class="bi bi-cash-stack"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Money Insurance</h4>
                        <p class="text-secondary small">Protects against financial loss in transit and on-premises due to robbery or theft. Covers money carried or stored in a safe.</p>
                    </div>
                </div>

                <!-- Machinery Breakdown -->
                <div class="swiper-slide h-auto">
                    <div class="card h-100 border-0 shadow-sm p-4 hover-lift rounded-4 m-2">
                        <div class="feature-icon bg-secondary text-white mb-4">
                            <i class="bi bi-gear-wide-connected"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Machinery Breakdown</h4>
                        <p class="text-secondary small">Businesses invest heavily in machinery but may experience unexpected breakdowns. We provide coverage to keep you running.</p>
                    </div>
                </div>

                <!-- Domestic Package Insurance -->
                <div class="swiper-slide h-auto">
                    <div class="card h-100 border-0 shadow-sm p-4 hover-lift rounded-4 m-2">
                        <div class="feature-icon bg-primary text-white mb-4" style="background-color: #6610f2 !important;">
                            <i class="bi bi-house-door"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Domestic Package</h4>
                        <p class="text-secondary small">Specifically for residential houses and movable personal property. It covers buildings, electronic equipment, and furniture.</p>
                    </div>
                </div>
            </div>
            <!-- Slider Pagination -->
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>

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
    <div class="container py-5">
        <div class="text-center mb-5 animate__animated animate__fadeIn">
            <h6 class="text-primary fw-bold text-uppercase mb-3">Testimonials</h6>
            <h2 class="display-5 fw-bold">What Our Clients Say</h2>
            <p class="text-secondary mx-auto" style="max-width: 600px;">Join thousands of satisfied customers who trust BimaKwik for their insurance needs.</p>
        </div>

        <div class="swiper testimonials-slider pb-5">
            <div class="swiper-wrapper">
                <!-- Testimonial 1 -->
                <div class="swiper-slide h-auto">
                    <div class="card h-100 border-0 shadow-sm rounded-4 p-4 m-2 text-center">
                        <div class="mb-4">
                            <img src="https://i.pravatar.cc/150?u=1" alt="Client 1" class="rounded-circle shadow-sm" style="width: 80px; height: 80px; object-fit: cover; border: 3px solid white;">
                        </div>
                        <div class="mb-3 text-warning">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <p class="text-secondary italic mb-4">"BimaKwik made it so easy for me to get motor insurance. The digital process is seamless and very fast!"</p>
                        <h5 class="fw-bold mb-0">James M.</h5>
                        <p class="text-primary small">Business Owner</p>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="swiper-slide h-auto">
                    <div class="card h-100 border-0 shadow-sm rounded-4 p-4 m-2 text-center">
                        <div class="mb-4">
                            <img src="https://i.pravatar.cc/150?u=2" alt="Client 2" class="rounded-circle shadow-sm" style="width: 80px; height: 80px; object-fit: cover; border: 3px solid white;">
                        </div>
                        <div class="mb-3 text-warning">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <p class="text-secondary italic mb-4">"I highly recommend their health insurance. Their support team helped me through every step of my claim."</p>
                        <h5 class="fw-bold mb-0">Sarah K.</h5>
                        <p class="text-primary small">Marketing Executive</p>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="swiper-slide h-auto">
                    <div class="card h-100 border-0 shadow-sm rounded-4 p-4 m-2 text-center">
                        <div class="mb-4">
                            <img src="https://i.pravatar.cc/150?u=3" alt="Client 3" class="rounded-circle shadow-sm" style="width: 80px; height: 80px; object-fit: cover; border: 3px solid white;">
                        </div>
                        <div class="mb-3 text-warning">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-half"></i>
                        </div>
                        <p class="text-secondary italic mb-4">"Excellent service! The mobile app is very intuitive and I can manage all my policies in one place."</p>
                        <h5 class="fw-bold mb-0">David L.</h5>
                        <p class="text-primary small">Software Engineer</p>
                    </div>
                </div>

                <!-- Testimonial 4 -->
                <div class="swiper-slide h-auto">
                    <div class="card h-100 border-0 shadow-sm rounded-4 p-4 m-2 text-center">
                        <div class="mb-4">
                            <img src="https://i.pravatar.cc/150?u=4" alt="Client 4" class="rounded-circle shadow-sm" style="width: 80px; height: 80px; object-fit: cover; border: 3px solid white;">
                        </div>
                        <div class="mb-3 text-warning">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <p class="text-secondary italic mb-4">"The best insurance experience in Tanzania. Professional, transparent, and always reliable."</p>
                        <h5 class="fw-bold mb-0">Mary A.</h5>
                        <p class="text-primary small">Teacher</p>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
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

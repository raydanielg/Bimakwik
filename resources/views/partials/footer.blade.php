<footer class="footer-dark bg-dark text-white pt-5 pb-3">
    <div class="container">
        <div class="row gy-4">
            <!-- Company Info -->
            <div class="col-lg-4 col-md-6">
                <div class="mb-4">
                    <span class="badge rounded-pill px-3 py-2 mb-3 shadow-sm" style="background-color: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.1); font-size: 0.7rem; letter-spacing: 0.5px;">
                        <i class="bi bi-shield-check text-warning me-1"></i> TRUSTED INSURANCE PLATFORM
                    </span>
                    <h3 class="fw-bold mb-3 d-flex align-items-center">
                        <img src="{{ asset('logo.png') }}" alt="Logo" height="40" class="me-2 brightness-0 invert">
                        {{ config('app.name', 'BimaKwik') }}
                    </h3>
                    <p class="text-secondary small pe-lg-5" style="line-height: 1.8;">
                        BimaKwik helps individuals and businesses across Tanzania manage their insurance needs with accuracy, speed, and transparency. Built for modern digital coverage.
                    </p>
                </div>
                <div class="d-flex gap-2">
                    <a href="#" class="social-icon"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="social-icon"><i class="bi bi-twitter-x"></i></a>
                    <a href="#" class="social-icon"><i class="bi bi-linkedin"></i></a>
                    <a href="#" class="social-icon"><i class="bi bi-instagram"></i></a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-2 col-6 col-md-3">
                <h6 class="fw-bold mb-4 text-uppercase small letter-spacing-1">{{ __('site.quick_links') }}</h6>
                <ul class="list-unstyled footer-links">
                    <li><a href="{{ url('/') }}"><i class="bi bi-chevron-right me-2 text-warning"></i>{{ __('site.home') }}</a></li>
                    <li><a href="{{ route('pages.about') }}"><i class="bi bi-chevron-right me-2 text-warning"></i>{{ __('site.about_us') }}</a></li>
                    <li><a href="{{ route('pages.products') }}"><i class="bi bi-chevron-right me-2 text-warning"></i>{{ __('site.products') }}</a></li>
                    <li><a href="{{ route('pages.contact') }}"><i class="bi bi-chevron-right me-2 text-warning"></i>{{ __('site.contact_us') }}</a></li>
                </ul>
            </div>

            <!-- Resources -->
            <div class="col-lg-2 col-6 col-md-3">
                <h6 class="fw-bold mb-4 text-uppercase small letter-spacing-1">{{ __('site.resources') }}</h6>
                <ul class="list-unstyled footer-links">
                    <li><a href="{{ route('resources.guidelines') }}"><i class="bi bi-chevron-right me-2 text-success"></i>{{ __('site.downloads') }}</a></li>
                    <li><a href="{{ route('resources.news') }}"><i class="bi bi-chevron-right me-2 text-success"></i>{{ __('site.blog_news') }}</a></li>
                    <li><a href="{{ route('resources.news') }}"><i class="bi bi-chevron-right me-2 text-success"></i>{{ __('site.learning_center') }}</a></li>
                </ul>
            </div>

            <!-- Support -->
            <div class="col-lg-2 col-6 col-md-3">
                <h6 class="fw-bold mb-4 text-uppercase small letter-spacing-1">{{ __('site.get_help') }}</h6>
                <ul class="list-unstyled footer-links">
                    <li><a href="{{ route('support.help') }}"><i class="bi bi-chevron-right me-2 text-warning"></i>{{ __('site.get_help') }}</a></li>
                    <li><a href="{{ route('support.faqs') }}"><i class="bi bi-chevron-right me-2 text-warning"></i>{{ __('site.faqs') }}</a></li>
                    <li><a href="{{ route('register') }}"><i class="bi bi-chevron-right me-2 text-warning"></i>{{ __('site.get_started') }}</a></li>
                </ul>
            </div>

            <!-- Legal -->
            <div class="col-lg-2 col-6 col-md-3">
                <h6 class="fw-bold mb-4 text-uppercase small letter-spacing-1">{{ __('site.legal') }}</h6>
                <ul class="list-unstyled footer-links">
                    <li><a href="{{ route('legal.privacy') }}"><i class="bi bi-chevron-right me-2 text-warning"></i>{{ __('site.privacy_policy') }}</a></li>
                    <li><a href="{{ route('legal.terms') }}"><i class="bi bi-chevron-right me-2 text-warning"></i>{{ __('site.terms_conditions') }}</a></li>
                    <li><a href="{{ route('legal.cookies') }}"><i class="bi bi-chevron-right me-2 text-warning"></i>{{ __('site.cookie_policy') }}</a></li>
                </ul>
            </div>
        </div>

        <div class="row mt-5 pt-4 border-top border-secondary border-opacity-10 align-items-end">
            <!-- Contact Info -->
            <div class="col-lg-4">
                <h6 class="fw-bold mb-3 small text-uppercase letter-spacing-1">{{ __('site.contact_us') }}</h6>
                <div class="footer-contact">
                    <p class="mb-2"><i class="bi bi-geo-alt-fill text-warning me-2"></i> {{ __('site.visit_us') }}: United Republic of Tanzania</p>
                    <p class="mb-2"><i class="bi bi-envelope-fill text-warning me-2"></i> {{ __('site.email_us') }}: info@bimakwik.com</p>
                    <p class="mb-0"><i class="bi bi-telephone-fill text-warning me-2"></i> {{ __('site.call_us') }}: +255 762 883 065</p>
                </div>
            </div>

            <!-- Newsletter -->
            <div class="col-lg-8 mt-4 mt-lg-0">
                <h6 class="fw-bold mb-3 small text-uppercase letter-spacing-1">{{ __('site.newsletter') }}</h6>
                <p class="text-secondary small mb-3">{{ __('site.newsletter_desc') }}</p>
                <form action="{{ route('newsletter.subscribe') }}" method="POST" class="row g-2">
                    @csrf
                    <div class="col-sm-8 col-md-9">
                        <input type="email" name="email" class="form-control form-control-dark border-0 py-2 shadow-none" placeholder="{{ __('site.email_address') }}" required style="background-color: rgba(255, 255, 255, 0.05); color: white;">
                    </div>
                    <div class="col-sm-4 col-md-3">
                        <button type="submit" class="btn btn-primary w-100 py-2 fw-bold d-flex align-items-center justify-content-center">
                            <i class="bi bi-send-fill me-2"></i> {{ __('site.subscribe') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12 text-center text-secondary small">
                <p class="mb-0">
                    &copy; {{ date('Y') }} {{ config('app.name', 'BimaKwik') }}. {{ __('site.all_rights_reserved') }}. | 
                    <a href="{{ url('/') }}" class="text-secondary text-decoration-none hover-white">{{ __('site.home') }}</a> | 
                    <a href="{{ route('login') }}" class="text-secondary text-decoration-none hover-white">{{ __('site.portals') }}</a>
                </p>
            </div>
        </div>
    </div>
</footer>

<style>
    .footer-dark {
        background-color: #0b1120 !important; /* Very dark blue/black from image */
        font-family: 'Plus Jakarta Sans', 'Nunito', sans-serif;
    }
    .letter-spacing-1 {
        letter-spacing: 1px;
    }
    .footer-links a {
        color: #94a3b8;
        text-decoration: none;
        font-size: 0.9rem;
        display: inline-block;
        margin-bottom: 12px;
        transition: all 0.3s ease;
    }
    .footer-links a:hover {
        color: white;
        transform: translateX(5px);
    }
    .social-icon {
        width: 36px;
        height: 36px;
        background-color: rgba(255, 255, 255, 0.05);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        color: #94a3b8;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    .social-icon:hover {
        background-color: #0056b3;
        color: white;
        transform: translateY(-3px);
    }
    .footer-contact p {
        color: #94a3b8;
        font-size: 0.9rem;
    }
    .form-control-dark::placeholder {
        color: #64748b;
        font-size: 0.85rem;
    }
    .hover-white:hover {
        color: white !important;
    }
    .brightness-0 { filter: brightness(0); }
    .invert { filter: invert(1); }
</style>

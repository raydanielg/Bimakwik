<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'BimaKwik') }}</title>
    
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&family=Plus+Jakarta+Sans:ital,wght@0,400;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* Cookie Consent Styles */
        #cookie-consent-banner {
            position: fixed;
            bottom: 30px;
            left: 30px;
            right: 30px;
            z-index: 9999;
            display: none;
            background: #fff;
            box-shadow: 0 1rem 3rem rgba(0,0,0,0.175);
            border-radius: 1rem;
            border: 1px solid rgba(0,0,0,0.05);
            max-width: 500px;
        }
        @media (max-width: 768px) {
            #cookie-consent-banner {
                left: 15px;
                right: 15px;
                bottom: 15px;
            }
        }
        .hero-section {
            padding: 100px 0;
            background: linear-gradient(rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.9)), url('/serious-expert-expressing-support-colleague.jpg');
            background-size: cover;
            background-position: center;
        }
        .feature-icon {
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 24px;
        }
        .hover-lift {
            transition: transform 0.3s ease;
        }
        .hover-lift:hover {
            transform: translateY(-10px);
        }
        .btn-quote-custom {
            background-color: #d1d5db; /* Light gray base */
            color: #15803d; /* Dark green text */
            border: none;
            padding: 12px 25px;
            border-radius: 50px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 15px;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        .btn-quote-custom .icon-circle {
            background-color: rgba(0, 0, 0, 0.05);
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
        }
        .btn-quote-custom:hover {
            background-color: #c4c9d0;
            transform: scale(1.05);
            color: #15803d;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <div id="app" class="d-flex flex-column min-vh-100">
        @include('partials.header')

        <main class="flex-grow-1">
            @yield('content')
        </main>

        @include('partials.footer')
    </div>

    @include('partials.mobile_nav')

    <!-- Cookie Consent Banner -->
    <div id="cookie-consent-banner" class="p-4 animate__animated animate__fadeInUp">
        <div class="d-flex align-items-start">
            <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
                <i class="bi bi-cookie text-primary fs-4"></i>
            </div>
            <div>
                <h5 class="fw-bold mb-2">Cookie Consent</h5>
                <p class="text-secondary small mb-3">We use cookies to enhance your experience and analyze our traffic. Please choose your preference below.</p>
                <div class="d-flex gap-2">
                    <button class="btn btn-primary btn-sm rounded-pill px-4" onclick="acceptCookies()">Accept All</button>
                    <button class="btn btn-outline-secondary btn-sm rounded-pill px-4" onclick="declineCookies()">Reject All</button>
                    <a href="{{ route('legal.cookies') }}" class="btn btn-link btn-sm text-decoration-none text-primary">Learn More</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function acceptCookies() {
            localStorage.setItem('cookieConsent', 'accepted');
            hideBanner();
            if (typeof updateStatusDisplay === 'function') updateStatusDisplay();
        }

        function declineCookies() {
            localStorage.setItem('cookieConsent', 'declined');
            hideBanner();
            if (typeof updateStatusDisplay === 'function') updateStatusDisplay();
        }

        function hideBanner() {
            const banner = document.getElementById('cookie-consent-banner');
            banner.classList.replace('animate__fadeInUp', 'animate__fadeOutDown');
            setTimeout(() => {
                banner.style.display = 'none';
            }, 500);
        }

        document.addEventListener('DOMContentLoaded', function() {
            if (!localStorage.getItem('cookieConsent')) {
                setTimeout(() => {
                    document.getElementById('cookie-consent-banner').style.display = 'block';
                }, 2000);
            }
        });
    </script>

    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: "{{ session('success') }}",
            confirmButtonColor: '#0056b3',
            timer: 3000
        });
    </script>
    @endif

    @if($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: "{{ $errors->first() }}",
            confirmButtonColor: '#0056b3'
        });
    </script>
    @endif
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

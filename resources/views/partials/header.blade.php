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
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
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
                    <a class="nav-link fw-bold px-3" href="{{ route('pages.branches') }}">Branches</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold px-3" href="{{ route('pages.contact') }}">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
    .top-bar {
        background-color: #004a99 !important; /* Slightly darker premium blue */
        font-size: 0.85rem;
        font-family: 'Nunito', sans-serif;
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

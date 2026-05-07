<!-- Top Bar -->
<div class="top-bar py-2 shadow-sm border-bottom">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="top-info d-flex gap-4">
            <a href="mailto:info@bimacoinsurance.co.tz" class="text-white text-decoration-none d-flex align-items-center hover-opacity">
                <i class="bi bi-envelope-fill me-2 text-warning"></i> 
                <span class="d-none d-sm-inline">info@bimacoinsurance.co.tz</span>
            </a>
            <a href="tel:+255746179849" class="text-white text-decoration-none d-flex align-items-center hover-opacity">
                <i class="bi bi-telephone-fill me-2 text-warning"></i> 
                <span>+255 746 179 849</span>
            </a>
        </div>
        <div class="top-links d-flex align-items-center gap-3">
            <div class="dropdown">
                <a href="#" class="text-white text-decoration-none dropdown-toggle small d-flex align-items-center" data-bs-toggle="dropdown">
                    <i class="bi bi-globe2 me-1"></i> English
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                    <li><a class="dropdown-item small" href="#">Swahili</a></li>
                    <li><a class="dropdown-item small active" href="#">English</a></li>
                </ul>
            </div>
            <span class="text-white-50">|</span>
            <a href="#" class="text-white text-decoration-none small hover-underline">FAQs</a>
            <a href="#" class="btn btn-warning btn-sm ms-2 px-3 rounded-pill fw-bold text-dark shadow-sm">
                <i class="bi bi-file-earmark-text me-1"></i> Request Quote
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
                    <a class="nav-link px-3 fw-bold text-primary" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 fw-bold text-primary" href="#">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 fw-bold text-primary" href="#">Claims</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 fw-bold text-primary" href="#">CSR</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 fw-bold text-primary" href="#">Videos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 fw-bold text-primary" href="#">Branches</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 fw-bold text-dark" href="#">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 fw-bold text-primary" href="#">Blog</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
    .top-bar {
        background-color: #0056b3 !important; /* Blue from image */
        font-size: 0.85rem;
    }
    .navbar .nav-link {
        color: #0056b3 !important;
        font-family: 'Nunito', sans-serif;
        font-size: 1rem;
        transition: color 0.2s;
    }
    .navbar .nav-link:hover {
        color: #003d82 !important;
    }
    .navbar .nav-link.text-dark {
        color: #333 !important;
    }
    .bg-primary {
        background-color: #0056b3 !important;
    }
</style>

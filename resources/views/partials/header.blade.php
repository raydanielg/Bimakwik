<!-- Top Bar -->
<div class="top-bar bg-primary text-white py-2 shadow-sm">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="top-info d-flex gap-4 small">
            <span><i class="bi bi-envelope-fill me-2"></i> info@bimacoinsurance.co.tz</span>
            <span><i class="bi bi-telephone-fill me-2"></i> +255 746 179 849</span>
        </div>
        <div class="top-links d-flex align-items-center gap-3 small">
            <a href="#" class="text-white text-decoration-none border-end pe-3">Swahili</a>
            <a href="#" class="text-white text-decoration-none">FAQs</a>
            <a href="#" class="btn btn-dark btn-sm ms-2 px-3 rounded-1 fw-bold" style="background-color: #2b0a3d; border: none;">Request Quote</a>
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

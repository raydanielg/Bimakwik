@extends('layouts.landing')

@section('content')
<section class="py-5 bg-white">
    <div class="container py-5 mt-5">
        <div class="text-center mb-5 animate__animated animate__fadeIn">
            <span class="badge rounded-pill bg-warning-soft text-dark px-3 py-2 mb-3">LATEST UPDATES</span>
            <h1 class="display-4 fw-bold">News & Research</h1>
            <p class="text-secondary mx-auto" style="max-width: 600px;">Stay informed with the latest industry news and our in-depth insurance research.</p>
        </div>

        <div class="row g-4">
            <!-- News Section -->
            <div class="col-lg-8">
                <h3 class="fw-bold mb-4"><i class="bi bi-newspaper me-2 text-primary"></i> Latest News</h3>
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4 hover-lift">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="https://www.bimakwik.com/wp-content/uploads/2024/07/family.webp" class="img-fluid h-100 object-fit-cover" alt="News">
                        </div>
                        <div class="col-md-8 p-4">
                            <span class="text-primary small fw-bold">INDUSTRY NEWS • MAY 08, 2026</span>
                            <h4 class="fw-bold mt-2">BimaKwik Expands Digital Reach to Rural Tanzania</h4>
                            <p class="text-secondary small">We are proud to announce our new initiative to bring digital insurance awareness to rural communities...</p>
                            <a href="#" class="text-primary fw-bold text-decoration-none small">Read More <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Research Section -->
            <div class="col-lg-4">
                <h3 class="fw-bold mb-4"><i class="bi bi-graph-up me-2 text-success"></i> Research</h3>
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-3 hover-lift">
                    <h5 class="fw-bold text-success mb-2">2026 Insurance Trends</h5>
                    <p class="text-secondary small">An analysis of how digital platforms are changing the insurance landscape in East Africa.</p>
                    <a href="#" class="btn btn-sm btn-success rounded-pill px-3">Download PDF</a>
                </div>
                <div class="card border-0 shadow-sm rounded-4 p-4 hover-lift">
                    <h5 class="fw-bold text-success mb-2">Consumer Behavior Report</h5>
                    <p class="text-secondary small">Understanding what Tanzanian youth look for in insurance products.</p>
                    <a href="#" class="btn btn-sm btn-success rounded-pill px-3">Download PDF</a>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .bg-warning-soft { background-color: rgba(255, 193, 7, 0.2); }
    .object-fit-cover { object-fit: cover; }
</style>
@endsection

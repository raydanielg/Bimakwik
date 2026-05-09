@extends('layouts.landing')

@section('content')
<section class="py-5 bg-light">
    <div class="container py-5 mt-5">
        <div class="text-center mb-5 animate__animated animate__fadeIn">
            <h1 class="display-4 fw-bold">News & Research</h1>
            <p class="text-secondary mx-auto" style="max-width: 600px;">Stay updated with the latest trends, insights, and innovations in the insurance industry.</p>
        </div>

        <div class="row g-4">
            @foreach($posts as $post)
            <div class="col-lg-4 col-md-6 animate__animated animate__fadeInUp">
                <div class="card h-100 border-0 shadow-sm hover-lift overflow-hidden rounded-4">
                    <div class="position-relative">
                        <img src="{{ $post['image'] }}" class="card-img-top" alt="{{ $post['title'] }}" style="height: 220px; object-fit: cover;">
                        <span class="badge bg-primary position-absolute top-0 end-0 m-3 px-3 py-2 rounded-pill shadow-sm">
                            {{ $post['category'] }}
                        </span>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3 small text-muted">
                            <i class="bi bi-calendar3 me-2 text-primary"></i> {{ $post['date'] }}
                            <span class="mx-2">|</span>
                            <i class="bi bi-person me-1 text-primary"></i> {{ $post['author'] }}
                        </div>
                        <h4 class="card-title fw-bold mb-3 h5">{{ $post['title'] }}</h4>
                        <p class="card-text text-secondary small mb-4">{{ $post['excerpt'] }}</p>
                        <a href="{{ route('resources.news.detail', $post['id']) }}" class="btn btn-outline-primary rounded-pill px-4 fw-bold">
                            Read More <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Research Section -->
        <div class="row mt-5 pt-5">
            <div class="col-12 mb-4">
                <h3 class="fw-bold"><i class="bi bi-journal-text me-2 text-success"></i> Industry Research</h3>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 hover-lift">
                    <div class="d-flex align-items-center">
                        <div class="bg-success bg-opacity-10 p-3 rounded-4 me-4">
                            <i class="bi bi-file-earmark-pdf fs-2 text-success"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1">2026 Insurance Trends Report</h5>
                            <p class="text-secondary small mb-2">Analysis of digital transformation in East Africa.</p>
                            <a href="#" class="btn btn-sm btn-success rounded-pill px-3">Download PDF</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 hover-lift">
                    <div class="d-flex align-items-center">
                        <div class="bg-success bg-opacity-10 p-3 rounded-4 me-4">
                            <i class="bi bi-file-earmark-pdf fs-2 text-success"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1">Consumer Behavior Study</h5>
                            <p class="text-secondary small mb-2">Understanding what the youth look for in insurance.</p>
                            <a href="#" class="btn btn-sm btn-success rounded-pill px-3">Download PDF</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .hover-lift {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .hover-lift:hover {
        transform: translateY(-10px);
        box-shadow: 0 1rem 3rem rgba(0,0,0,.1) !important;
    }
</style>
@endsection

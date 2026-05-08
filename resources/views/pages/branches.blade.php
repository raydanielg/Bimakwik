@extends('layouts.landing')

@section('content')
<section class="py-5 bg-white">
    <div class="container py-5 mt-5">
        <div class="text-center mb-5 animate__animated animate__fadeIn">
            <h1 class="display-4 fw-bold">Our Branches</h1>
            <p class="text-secondary mx-auto" style="max-width: 600px;">Visit us at any of our offices across the country. We are closer to you than you think.</p>
        </div>

        <div class="row g-4">
            @forelse($branches as $branch)
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 h-100 hover-lift">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="feature-icon bg-primary text-white">
                            <i class="bi bi-geo-alt"></i>
                        </div>
                        <h4 class="fw-bold mb-0">{{ $branch->name }}</h4>
                    </div>
                    <div class="branch-info text-secondary small">
                        <p class="mb-2"><i class="bi bi-map me-2"></i> {{ $branch->location }}</p>
                        <p class="mb-2"><i class="bi bi-building me-2"></i> {{ $branch->address }}</p>
                        <p class="mb-2"><i class="bi bi-telephone me-2"></i> {{ $branch->phone }}</p>
                        @if($branch->email)
                        <p class="mb-0"><i class="bi bi-envelope me-2"></i> {{ $branch->email }}</p>
                        @endif
                    </div>
                    @if($branch->map_url)
                    <div class="mt-4">
                        <a href="{{ $branch->map_url }}" target="_blank" class="btn btn-sm btn-light rounded-pill px-4">View on Map</a>
                    </div>
                    @endif
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <p class="text-secondary">Our branches information will be available soon.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection

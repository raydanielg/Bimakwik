@extends('layouts.landing')

@section('content')
<section class="py-5 bg-white">
    <div class="container py-5 mt-5">
        <div class="text-center mb-5 animate__animated animate__fadeIn">
            <h1 class="display-4 fw-bold">Our Products</h1>
            <p class="text-secondary mx-auto" style="max-width: 600px;">Explore our range of insurance solutions tailored to protect what matters most to you.</p>
        </div>

        <div class="row g-4">
            @forelse($products as $product)
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 h-100 hover-lift text-center">
                    <div class="feature-icon-lg bg-primary text-white mx-auto mb-4">
                        <i class="bi {{ $product->icon ?? 'bi-shield' }}"></i>
                    </div>
                    <h3 class="fw-bold mb-3">{{ $product->name }}</h3>
                    <p class="text-secondary mb-4">{{ $product->description }}</p>
                    <a href="{{ route('quote.request') }}" class="btn btn-outline-primary rounded-pill px-4">Get a Quote</a>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <p class="text-secondary">Our products will be listed here soon.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<style>
    .feature-icon-lg {
        width: 80px;
        height: 80px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
    }
</style>
@endsection

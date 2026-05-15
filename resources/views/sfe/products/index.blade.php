@extends('layouts.dashboard')

@section('dashboard_title', 'Product Catalog')

@section('dashboard_content')
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-4 h-100">
            <div class="text-muted small text-uppercase">Products</div>
            <div class="fs-3 fw-bold">{{ $products->count() }}</div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card border-0 shadow-sm p-4 h-100">
            <h6 class="fw-bold mb-3">Insurance Product Catalog</h6>
            <p class="text-muted mb-0">Browse available products and positioning details for selling.</p>
        </div>
    </div>
</div>

<div class="row g-4">
    @forelse($products as $product)
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm p-4 h-100">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <h6 class="fw-bold mb-0">{{ $product->name }}</h6>
                    <span class="badge bg-success-soft text-success">Active</span>
                </div>
                <p class="text-muted small mb-3">{{ \Illuminate\Support\Str::limit($product->description, 120) }}</p>
                <div class="small text-muted">Slug: {{ $product->slug }}</div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="card border-0 shadow-sm p-4">
                <div class="text-muted">No active products found.</div>
            </div>
        </div>
    @endforelse
</div>
@endsection

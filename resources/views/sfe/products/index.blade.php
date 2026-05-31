@extends('layouts.dashboard')

@section('dashboard_title', __('sfe.product_catalog_title'))

@section('dashboard_content')
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-4 h-100">
            <div class="text-muted small text-uppercase">{{ __('sfe.products') }}</div>
            <div class="fs-3 fw-bold">{{ $products->count() }}</div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card border-0 shadow-sm p-4 h-100">
            <h6 class="fw-bold mb-3">{{ __('sfe.insurance_product_catalog') }}</h6>
            <p class="text-muted mb-0">{{ __('sfe.product_catalog_subtitle') }}</p>
        </div>
    </div>
</div>

<div class="row g-4">
    @forelse($products as $product)
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm p-4 h-100">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <h6 class="fw-bold mb-0">{{ $product->product_name }}</h6>
                    <span class="badge bg-success-soft text-success">{{ __('sfe.active') }}</span>
                </div>
                <p class="text-muted small mb-3">{{ \Illuminate\Support\Str::limit($product->description, 120) }}</p>
                <div class="small text-muted">{{ __('sfe.slug') }}: {{ $product->slug }}</div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="card border-0 shadow-sm p-4">
                <div class="text-muted">{{ __('sfe.no_active_products') }}</div>
            </div>
        </div>
    @endforelse
</div>
@endsection

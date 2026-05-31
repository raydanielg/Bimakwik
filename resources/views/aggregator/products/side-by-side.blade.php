@extends('layouts.dashboard')
@section('dashboard_title', 'Side-by-Side Comparison')
@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Side-by-Side Product View</h4>
        <p class="text-muted mb-0 small">Select up to 3 products to compare in detail</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('aggregator.products.compare') }}" class="btn btn-outline-primary btn-sm"><i class="bi bi-grid-3x3-gap me-1"></i>Matrix View</a>
        <a href="{{ route('aggregator.products.ai-compare') }}" class="btn btn-outline-success btn-sm"><i class="bi bi-magic me-1"></i>AI Compare</a>
    </div>
</div>

<div class="row g-4">
    @forelse($products->take(3) as $product)
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-primary text-white py-3 text-center">
                <h6 class="fw-bold mb-0">{{ $product->product_name }}</h6>
                <small class="opacity-75">{{ optional($product->productCategory)->name ?? 'Insurance' }}</small>
            </div>
            <div class="card-body p-4">
                <div class="text-center mb-4">
                    <div class="small text-muted">Starting From</div>
                    <div class="fw-bold fs-4 text-primary">TZS {{ number_format($product->min_premium ?? $product->premium ?? 0, 0) }}</div>
                    <div class="small text-muted">per year</div>
                </div>

                <ul class="list-unstyled mb-4">
                    <li class="mb-2 d-flex justify-content-between">
                        <span class="text-muted small">Coverage</span>
                        <span class="fw-bold small">TZS {{ number_format($product->coverage_amount ?? 0, 0) }}</span>
                    </li>
                    <li class="mb-2 d-flex justify-content-between">
                        <span class="text-muted small">Duration</span>
                        <span class="fw-bold small">{{ $product->duration_months ?? 12 }} months</span>
                    </li>
                </ul>

                @if($product->productBenefits->count())
                <div class="border-top pt-3">
                    <div class="small fw-bold text-muted mb-2">BENEFITS</div>
                    @foreach($product->productBenefits as $benefit)
                    <div class="d-flex align-items-center mb-1">
                        <i class="bi bi-check-circle-fill text-success me-2 small"></i>
                        <span class="small">{{ $benefit->name }}</span>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center py-5 text-muted">
                <i class="bi bi-layout-split fs-2 d-block mb-2 opacity-25"></i>No products available.
            </div>
        </div>
    </div>
    @endforelse
</div>

@if($products->count() > 3)
<div class="mt-4">
    <p class="text-muted small">Showing top 3 products. <a href="{{ route('aggregator.products.compare') }}">View full matrix</a> for all {{ $products->count() }} products.</p>
</div>
@endif
@endsection

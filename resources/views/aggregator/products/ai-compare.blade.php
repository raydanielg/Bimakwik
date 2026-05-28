@extends('layouts.dashboard')
@section('dashboard_title', 'AI Smart Compare')
@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">AI Smart Compare</h4>
        <p class="text-muted mb-0 small">AI-powered product recommendations based on value and coverage</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('aggregator.products.compare') }}" class="btn btn-outline-primary btn-sm"><i class="bi bi-grid-3x3-gap me-1"></i>Matrix View</a>
        <a href="{{ route('aggregator.products.side-by-side') }}" class="btn btn-outline-secondary btn-sm"><i class="bi bi-layout-split me-1"></i>Side-by-Side</a>
    </div>
</div>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-body p-4">
        <div class="d-flex align-items-center gap-3 mb-3">
            <div class="bg-success bg-opacity-10 text-success rounded-3 p-3" style="width:50px;height:50px;display:flex;align-items:center;justify-content:center;"><i class="bi bi-magic fs-4"></i></div>
            <div>
                <h6 class="fw-bold mb-1">AI Analysis Summary</h6>
                <p class="text-muted small mb-0">Based on {{ $products->count() }} active products, here are the key insights:</p>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-md-4">
                <div class="bg-primary bg-opacity-5 border border-primary border-opacity-25 rounded-3 p-3">
                    <div class="small text-muted mb-1">Best Value</div>
                    <div class="fw-bold">{{ optional($products->sortBy('min_premium')->first())->name ?? 'N/A' }}</div>
                    <div class="small text-success">Lowest premium entry point</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="bg-success bg-opacity-5 border border-success border-opacity-25 rounded-3 p-3">
                    <div class="small text-muted mb-1">Best Coverage</div>
                    <div class="fw-bold">{{ optional($products->sortByDesc('coverage_amount')->first())->name ?? 'N/A' }}</div>
                    <div class="small text-success">Highest coverage amount</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="bg-warning bg-opacity-5 border border-warning border-opacity-25 rounded-3 p-3">
                    <div class="small text-muted mb-1">Most Benefits</div>
                    <div class="fw-bold">{{ optional($products->sortByDesc(fn($p) => $p->productBenefits->count())->first())->name ?? 'N/A' }}</div>
                    <div class="small text-warning">Richest benefits package</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    @forelse($products as $product)
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <h6 class="fw-bold mb-0">{{ $product->name }}</h6>
                    @if($product->productBenefits->count() >= 3)
                    <span class="badge bg-warning-subtle text-warning small">Top Pick</span>
                    @endif
                </div>
                <p class="small text-muted mb-3">{{ Str::limit($product->description ?? 'No description.', 80) }}</p>
                <div class="d-flex justify-content-between mb-2">
                    <span class="small text-muted">Premium</span>
                    <span class="fw-bold text-primary">TZS {{ number_format($product->min_premium ?? $product->premium ?? 0, 0) }}</span>
                </div>
                <div class="d-flex justify-content-between mb-3">
                    <span class="small text-muted">Benefits</span>
                    <span class="fw-bold">{{ $product->productBenefits->count() }}</span>
                </div>
                @php
                    $score = min(100, ($product->productBenefits->count() * 15) + (($product->coverage_amount ?? 0) > 0 ? 40 : 0) + 10);
                @endphp
                <div class="mb-1 d-flex justify-content-between">
                    <small class="text-muted">AI Score</small>
                    <small class="fw-bold">{{ $score }}/100</small>
                </div>
                <div class="progress" style="height:6px;">
                    <div class="progress-bar bg-success" style="width:{{ $score }}%"></div>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center py-5 text-muted">
                <i class="bi bi-magic fs-2 d-block mb-2 opacity-25"></i>No products to compare.
            </div>
        </div>
    </div>
    @endforelse
</div>
@endsection

@extends('layouts.dashboard')
@section('dashboard_title', 'Product Recommendations')
@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">AI Product Recommendations</h4>
        <p class="text-muted mb-0 small">Top products to promote based on market trends</p>
    </div>
</div>

<div class="row g-4">
    @forelse($recommended as $product)
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3 me-3" style="width:50px;height:50px;display:flex;align-items:center;justify-content:center;">
                        <i class="bi bi-shield-check fs-4"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0">{{ $product->name }}</h6>
                        <small class="text-muted">{{ $product->category ?? 'Insurance' }}</small>
                    </div>
                </div>
                <p class="small text-muted mb-3">{{ Str::limit($product->description ?? 'No description available.', 100) }}</p>
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="small text-muted">Premium from</div>
                        <div class="fw-bold text-primary">TZS {{ number_format($product->min_premium ?? $product->premium ?? 0, 0) }}</div>
                    </div>
                    <span class="badge bg-success-subtle text-success">Recommended</span>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center py-5 text-muted">
                <i class="bi bi-lightbulb fs-2 d-block mb-2 opacity-25"></i>
                No recommendations available at this time.
            </div>
        </div>
    </div>
    @endforelse
</div>
@endsection

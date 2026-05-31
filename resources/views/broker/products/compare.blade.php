@extends('layouts.dashboard')
@section('dashboard_title', 'Product Comparison')
@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Product Comparison Matrix</h4>
        <p class="text-muted mb-0 small">Compare insurance products side by side</p>
    </div>
</div>

@if($products->count() > 0)
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Product</th>
                        <th>Category</th>
                        <th>Premium From</th>
                        <th>Coverage</th>
                        <th>Benefits</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td class="ps-4">
                            <div class="fw-bold">{{ $product->product_name }}</div>
                            <small class="text-muted">{{ Str::limit($product->description ?? '', 60) }}</small>
                        </td>
                        <td>{{ optional($product->productCategory)->name ?? 'General' }}</td>
                        <td class="fw-bold">TZS {{ number_format($product->min_premium ?? $product->premium ?? 0, 0) }}</td>
                        <td>TZS {{ number_format($product->coverage_amount ?? 0, 0) }}</td>
                        <td>
                            @if($product->productBenefits && $product->productBenefits->count())
                                @foreach($product->productBenefits->take(3) as $benefit)
                                    <span class="badge bg-light text-dark border me-1 mb-1 small">{{ $benefit->name }}</span>
                                @endforeach
                                @if($product->productBenefits->count() > 3)
                                    <span class="badge bg-secondary small">+{{ $product->productBenefits->count() - 3 }} more</span>
                                @endif
                            @else
                                <span class="text-muted small">—</span>
                            @endif
                        </td>
                        <td><span class="badge bg-success-subtle text-success">Active</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@else
<div class="card border-0 shadow-sm">
    <div class="card-body text-center py-5 text-muted">
        <i class="bi bi-grid fs-2 d-block mb-2 opacity-25"></i>
        No products available for comparison.
    </div>
</div>
@endif
@endsection

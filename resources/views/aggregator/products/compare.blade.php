@extends('layouts.dashboard')
@section('dashboard_title', 'Comparison Matrix')
@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Product Comparison Matrix</h4>
        <p class="text-muted mb-0 small">Full matrix overview of all active insurance products</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('aggregator.products.side-by-side') }}" class="btn btn-outline-primary btn-sm"><i class="bi bi-layout-split me-1"></i>Side-by-Side</a>
        <a href="{{ route('aggregator.products.ai-compare') }}" class="btn btn-outline-success btn-sm"><i class="bi bi-magic me-1"></i>AI Compare</a>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Product</th>
                        <th>Category</th>
                        <th>Min Premium</th>
                        <th>Coverage</th>
                        <th>Benefits</th>
                        <th>Policies Sold</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    <tr>
                        <td class="ps-4">
                            <div class="fw-bold">{{ $product->product_name }}</div>
                            <small class="text-muted">{{ Str::limit($product->description ?? '', 50) }}</small>
                        </td>
                        <td>{{ optional($product->productCategory)->name ?? 'General' }}</td>
                        <td class="fw-bold">TZS {{ number_format($product->min_premium ?? $product->premium ?? 0, 0) }}</td>
                        <td>TZS {{ number_format($product->coverage_amount ?? 0, 0) }}</td>
                        <td>
                            @foreach($product->productBenefits->take(3) as $b)
                                <span class="badge bg-light text-dark border me-1 small">{{ $b->name }}</span>
                            @endforeach
                            @if($product->productBenefits->count() > 3)
                                <span class="badge bg-secondary small">+{{ $product->productBenefits->count() - 3 }}</span>
                            @endif
                        </td>
                        <td><span class="fw-bold">{{ $product->customerPolicies_count ?? $product->policies_count ?? '—' }}</span></td>
                        <td><span class="badge bg-success-subtle text-success">Active</span></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="bi bi-grid fs-2 d-block mb-2 opacity-25"></i>No products available.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

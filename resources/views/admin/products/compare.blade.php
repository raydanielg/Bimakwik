@extends('layouts.dashboard')

@section('dashboard_title', 'Product Comparison Matrix')

@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Product Comparison Matrix</h4>
    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i>Back to Products
    </a>
</div>

<div class="card mb-4">
    <div class="card-body">
        <form method="GET" class="row g-3 align-items-end">
            <div class="col-md-9">
                <label class="form-label">Filter by Category</label>
                <select name="category" class="form-select">
                    <option value="">All Active Products</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected(request('category') == $category->id)>
                            {{ $category->category_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <button class="btn btn-primary w-100" type="submit">
                    <i class="bi bi-funnel me-2"></i>Filter
                </button>
            </div>
        </form>
    </div>
</div>

@if($products->isEmpty())
    <div class="alert alert-info" role="alert">
        <i class="bi bi-info-circle me-2"></i>
        No active products found for comparison. Please adjust your filters or create new products.
    </div>
@else
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover comparison-matrix">
                    <thead class="table-light">
                        <tr>
                            <th style="min-width: 200px;" class="bg-light">
                                <strong>Product Details</strong>
                            </th>
                            @foreach($products as $product)
                                <th style="min-width: 220px;">
                                    <div class="fw-bold">{{ $product->product_name }}</div>
                                    <small class="text-muted">{{ $product->product_code }}</small>
                                    @if($product->insurer)
                                        <div><small class="badge bg-info">{{ $product->insurer->name }}</small></div>
                                    @else
                                        <div><small class="badge bg-secondary">Platform</small></div>
                                    @endif
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Base Premium Row -->
                        <tr>
                            <td class="fw-bold bg-light">Base Premium</td>
                            @foreach($products as $product)
                                <td>
                                    <span class="badge bg-success">
                                        {{ $product->currency }} {{ number_format($product->base_premium, 2) }}
                                    </span>
                                </td>
                            @endforeach
                        </tr>

                        <!-- Age Range Row -->
                        <tr>
                            <td class="fw-bold bg-light">Age Range</td>
                            @foreach($products as $product)
                                <td>
                                    @if($product->min_age || $product->max_age)
                                        <span class="badge bg-warning text-dark">
                                            {{ $product->min_age ?? 'Any' }} - {{ $product->max_age ?? 'Any' }} years
                                        </span>
                                    @else
                                        <span class="text-muted">No age restrictions</span>
                                    @endif
                                </td>
                            @endforeach
                        </tr>

                        <!-- Category Row -->
                        <tr>
                            <td class="fw-bold bg-light">Category</td>
                            @foreach($products as $product)
                                <td>
                                    <span class="badge bg-primary">
                                        {{ $product->policyCategory->category_name ?? 'Uncategorized' }}
                                    </span>
                                </td>
                            @endforeach
                        </tr>

                        <!-- Benefits Row -->
                        <tr>
                            <td class="fw-bold bg-light">Benefits</td>
                            @foreach($products as $product)
                                <td>
                                    @if($product->benefits && count($product->benefits) > 0)
                                        <ul class="list-unstyled mb-0">
                                            @foreach($product->benefits as $benefit)
                                                <li>
                                                    <i class="bi bi-check-circle text-success me-1"></i>
                                                    <small>{{ $benefit }}</small>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <span class="text-muted">No benefits specified</span>
                                    @endif
                                </td>
                            @endforeach
                        </tr>

                        <!-- Exclusions Row -->
                        <tr>
                            <td class="fw-bold bg-light">Exclusions</td>
                            @foreach($products as $product)
                                <td>
                                    @if($product->exclusions && count($product->exclusions) > 0)
                                        <ul class="list-unstyled mb-0">
                                            @foreach($product->exclusions as $exclusion)
                                                <li>
                                                    <i class="bi bi-x-circle text-danger me-1"></i>
                                                    <small>{{ $exclusion }}</small>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <span class="text-muted">No exclusions</span>
                                    @endif
                                </td>
                            @endforeach
                        </tr>

                        <!-- Description Row -->
                        <tr>
                            <td class="fw-bold bg-light">Description</td>
                            @foreach($products as $product)
                                <td>
                                    <small class="text-muted">{{ Str::limit($product->description, 100) }}</small>
                                </td>
                            @endforeach
                        </tr>

                        <!-- Actions Row -->
                        <tr>
                            <td class="fw-bold bg-light">Actions</td>
                            @foreach($products as $product)
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('admin.products.show', $product) }}" class="btn btn-light" title="View">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-light" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                    </div>
                                </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Summary Stats -->
    <div class="row g-3 mt-4">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <h3 class="text-primary">{{ $products->count() }}</h3>
                    <small class="text-muted">Products Compared</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <h3 class="text-success">{{ $products->min('base_premium') ? '$' . number_format($products->min('base_premium'), 2) : 'N/A' }}</h3>
                    <small class="text-muted">Min Premium</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <h3 class="text-warning">{{ $products->max('base_premium') ? '$' . number_format($products->max('base_premium'), 2) : 'N/A' }}</h3>
                    <small class="text-muted">Max Premium</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <h3 class="text-info">{{ $products->avg('base_premium') ? '$' . number_format($products->avg('base_premium'), 2) : 'N/A' }}</h3>
                    <small class="text-muted">Avg Premium</small>
                </div>
            </div>
        </div>
    </div>
@endif

<style>
    .comparison-matrix th {
        vertical-align: middle;
        background-color: #f8f9fa;
    }

    .comparison-matrix td {
        vertical-align: top;
        padding: 12px;
    }

    .comparison-matrix .bg-light {
        background-color: #f0f0f0 !important;
    }

    .comparison-matrix ul li {
        margin-bottom: 4px;
        line-height: 1.4;
    }

    @media (max-width: 768px) {
        .comparison-matrix {
            font-size: 0.875rem;
        }

        .comparison-matrix th,
        .comparison-matrix td {
            padding: 8px 4px;
        }
    }
</style>
@endsection

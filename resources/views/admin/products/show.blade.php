@extends('layouts.dashboard')

@section('dashboard_title', $product->product_name)

@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1">{{ $product->product_name }}</h4>
        <div class="text-muted">{{ $product->product_code }}</div>
    </div>
    <div class="btn-group">
        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-2"></i>Back
        </a>
        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-primary">
            <i class="bi bi-pencil me-2"></i>Edit
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <div>
                        <div class="small text-muted">Category</div>
                        <div class="fw-bold">{{ $product->policyCategory->category_name ?? 'N/A' }}</div>
                    </div>
                    <span class="badge bg-{{ $product->is_active ? 'success' : 'secondary' }}">
                        {{ $product->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </div>

                <h6 class="fw-bold">Description</h6>
                <p>{{ $product->description }}</p>

                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <div class="p-3 bg-light rounded">
                            <div class="small text-muted">Base Premium</div>
                            <div class="fw-bold">{{ $product->currency }} {{ number_format($product->base_premium, 2) }}</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 bg-light rounded">
                            <div class="small text-muted">Age Range</div>
                            <div class="fw-bold">{{ $product->min_age ?? '-' }} - {{ $product->max_age ?? '-' }}</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 bg-light rounded">
                            <div class="small text-muted">Insurer</div>
                            <div class="fw-bold">{{ $product->insurer->name ?? 'Platform' }}</div>
                        </div>
                    </div>
                </div>

                <div class="row g-4">
                    <div class="col-md-6">
                        <h6 class="fw-bold">Benefits</h6>
                        <ul class="mb-0">
                            @forelse($product->benefits ?? [] as $benefit)
                                <li>{{ $benefit }}</li>
                            @empty
                                <li class="text-muted">No benefits recorded</li>
                            @endforelse
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h6 class="fw-bold">Exclusions</h6>
                        <ul class="mb-0">
                            @forelse($product->exclusions ?? [] as $exclusion)
                                <li>{{ $exclusion }}</li>
                            @empty
                                <li class="text-muted">No exclusions recorded</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h6 class="fw-bold mb-3">Actions</h6>
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-outline-primary">Edit Product</a>
                    <form method="POST" action="{{ route('admin.products.destroy', $product) }}" onsubmit="return confirm('Delete this product?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger w-100">Delete Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.dashboard')

@section('content')
<div class="container-fluid py-4">
    @include('agent._partials.page-header', [
        'title' => 'Available Products',
        'subtitle' => 'View insurance products available for sale',
        'icon' => 'bi-shield-fill'
    ])

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">All Products</h5>
                <div class="btn-group btn-group-sm">
                    <button class="btn btn-outline-secondary"><i class="bi bi-funnel me-1"></i> Filter</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if($products->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Product Name</th>
                                <th>Category</th>
                                <th>Premium Range</th>
                                <th>Commission</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px;">
                                                <i class="bi bi-shield-fill text-muted"></i>
                                            </div>
                                            <div>
                                                <div class="fw-bold">{{ $product->product_name ?? 'N/A' }}</div>
                                                <small class="text-muted">{{ $product->code ?? 'N/A' }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $product->category ?? 'N/A' }}</td>
                                    <td>TZS {{ number_format($product->min_premium ?? 0, 0) }} - {{ number_format($product->max_premium ?? 0, 0) }}</td>
                                    <td>{{ $product->commission_rate ?? 0 }}%</td>
                                    <td>
                                        @if($product->status === 'active')
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">{{ $product->status ?? 'Unknown' }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <button class="btn btn-outline-primary"><i class="bi bi-eye"></i></button>
                                            <button class="btn btn-outline-success"><i class="bi bi-cart-plus"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $products->links() }}
            @else
                @include('agent._partials.empty-state', [
                    'icon' => 'bi-shield-fill',
                    'title' => 'No Products Found',
                    'text' => 'There are no products available at this time.'
                ])
            @endif
        </div>
    </div>
</div>
@endsection

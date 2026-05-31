@extends('layouts.dashboard')

@section('dashboard_content')
@include('insurer._partials.page-header', [
    'pageTitle' => 'Insurance Products',
    'pageSubtitle' => 'Manage your insurance product catalog',
    'pageIcon' => 'box-seam',
    'pageAction' => '<a href="'.route('admin.products.create').'" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>New Product</a>'
])

<div class="row g-3 mb-4">
    <div class="col-md-3"><div class="card border-0 shadow-sm"><div class="card-body"><p class="text-muted small mb-1">Total Products</p><h3 class="fw-bold mb-0">{{ number_format($count) }}</h3></div></div></div>
    <div class="col-md-3"><div class="card border-0 shadow-sm"><div class="card-body"><p class="text-muted small mb-1">Approved</p><h3 class="fw-bold mb-0 text-success">{{ number_format($approvedCount) }}</h3></div></div></div>
    <div class="col-md-3"><div class="card border-0 shadow-sm"><div class="card-body"><p class="text-muted small mb-1">Pending Approval</p><h3 class="fw-bold mb-0 text-warning">{{ $count - $approvedCount }}</h3></div></div></div>
    <div class="col-md-3"><div class="card border-0 shadow-sm"><div class="card-body"><p class="text-muted small mb-1">Avg Premium</p><h3 class="fw-bold mb-0">TZS 250K</h3></div></div></div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        @if($products->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Product</th>
                        <th>Category</th>
                        <th>Premium</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td class="fw-semibold">{{ $product->product_name ?? 'Untitled' }}</td>
                        <td><span class="badge bg-secondary bg-opacity-10 text-secondary">{{ $product->category ?? 'General' }}</span></td>
                        <td>TZS {{ number_format(product->premium_amount ?? 0) }}</td>
                        <td><span class="badge bg-{{ ($product->status ?? 'active') == 'active' ? 'success' : 'warning' }} bg-opacity-10 text-{{ ($product->status ?? 'active') == 'active' ? 'success' : 'warning' }}">{{ ucfirst($product->status ?? 'active') }}</span></td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></button>
                            <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-3">{{ $products->links() }}</div>
        @else
        @include('insurer._partials.empty-state', ['emptyIcon' => 'box-seam', 'emptyTitle' => 'No products yet', 'emptyText' => 'Create your first insurance product to get started'])
        @endif
    </div>
</div>
@endsection

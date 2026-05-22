@extends('layouts.dashboard')

@section('dashboard_content')
<div class="container-fluid py-4">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">Bancassurance Products</h1>
            <p class="text-muted mb-0">Manage insurance products available through bank channels</p>
        </div>
        <button class="btn btn-primary" onclick="addProduct()">
            <i class="bi bi-plus-lg me-2"></i>Add Product
        </button>
    </div>

    <!-- Stats Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-primary bg-opacity-10 rounded-3 p-3">
                                <i class="bi bi-box text-primary fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Total Products</h6>
                            <h4 class="mb-0 fw-bold">{{ $products->total() }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-success bg-opacity-10 rounded-3 p-3">
                                <i class="bi bi-check-circle text-success fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Active</h6>
                            <h4 class="mb-0 fw-bold">{{ $products->where('status', 'active')->count() }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-info bg-opacity-10 rounded-3 p-3">
                                <i class="bi bi-bank text-info fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Partner Banks</h6>
                            <h4 class="mb-0 fw-bold">{{ $products->max('banks') }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-warning bg-opacity-10 rounded-3 p-3">
                                <i class="bi bi-percent text-warning fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Avg Commission</h6>
                            <h4 class="mb-0 fw-bold">6.4%</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Products Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-semibold">Product Catalog</h5>
                <div class="input-group" style="width: 300px;">
                    <span class="input-group-text bg-light border-0">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" class="form-control border-0 bg-light" placeholder="Search products...">
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th class="border-0 py-3 px-4">Product Name</th>
                            <th class="border-0 py-3">Category</th>
                            <th class="border-0 py-3">Premium Range</th>
                            <th class="border-0 py-3">Commission Rate</th>
                            <th class="border-0 py-3">Partner Banks</th>
                            <th class="border-0 py-3">Status</th>
                            <th class="border-0 py-3 text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                        <tr>
                            <td class="py-3 px-4">
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                        <i class="bi bi-shield-check text-primary"></i>
                                    </div>
                                    <div>
                                        <div class="fw-semibold">{{ $product['name'] }}</div>
                                        <small class="text-muted">ID: #{{ $product['id'] }}</small>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3">
                                <span class="badge bg-secondary bg-opacity-10 text-secondary">{{ $product['category'] }}</span>
                            </td>
                            <td class="py-3">
                                <span class="fw-semibold">TZS {{ $product['premium_range'] }}</span>
                            </td>
                            <td class="py-3">
                                <span class="badge bg-success bg-opacity-10 text-success fw-bold">{{ $product['commission_rate'] }}</span>
                            </td>
                            <td class="py-3">
                                <span class="fw-semibold">{{ $product['banks'] }} banks</span>
                            </td>
                            <td class="py-3">
                                @if($product['status'] == 'active')
                                    <span class="badge bg-success bg-opacity-10 text-success">
                                        <i class="bi bi-check-circle me-1"></i>Active
                                    </span>
                                @else
                                    <span class="badge bg-warning bg-opacity-10 text-warning">
                                        <i class="bi bi-clock me-1"></i>Pending
                                    </span>
                                @endif
                            </td>
                            <td class="py-3 text-end">
                                <div class="btn-group btn-group-sm">
                                    <button class="btn btn-outline-primary" onclick="viewProduct({{ $product['id'] }})" title="View Details">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button class="btn btn-outline-success" onclick="viewBanks({{ $product['id'] }})" title="View Banks">
                                        <i class="bi bi-bank"></i>
                                    </button>
                                    <button class="btn btn-outline-secondary" onclick="editProduct({{ $product['id'] }})" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <i class="bi bi-inbox fs-1 text-muted d-block mb-3"></i>
                                <p class="text-muted mb-0">No products found</p>
                                <small class="text-muted">Add your first product to get started</small>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($products->hasPages())
        <div class="card-footer bg-white border-0 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }} products</small>
                <div>
                    {{ $products->links() }}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
function addProduct() {
    Swal.fire({
        title: 'Add New Product',
        html: `
            <div class="text-start">
                <div class="mb-3">
                    <label class="form-label">Product Name</label>
                    <input type="text" id="productName" class="form-control" placeholder="Enter product name">
                </div>
                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <select id="category" class="form-select">
                        <option>General</option>
                        <option>Health</option>
                        <option>Life</option>
                        <option>Motor</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Commission Rate (%)</label>
                    <input type="number" id="commission" class="form-control" placeholder="Enter commission rate">
                </div>
            </div>
        `,
        showCancelButton: true,
        confirmButtonText: 'Add Product',
        preConfirm: () => {
            return {
                name: document.getElementById('productName').value,
                category: document.getElementById('category').value,
                commission: document.getElementById('commission').value
            };
        }
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire('Success!', 'Product added successfully', 'success');
        }
    });
}

function viewProduct(id) {
    Swal.fire({
        title: 'Product Details',
        text: 'Viewing product details for ID: ' + id,
        icon: 'info'
    });
}

function viewBanks(id) {
    Swal.fire({
        title: 'Partner Banks',
        text: 'Viewing partner banks for product ID: ' + id,
        icon: 'info'
    });
}

function editProduct(id) {
    Swal.fire({
        title: 'Edit Product',
        text: 'Edit product details for ID: ' + id,
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Save Changes'
    });
}
</script>
@endpush
@endsection

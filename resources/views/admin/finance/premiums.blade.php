@extends('layouts.dashboard')

@section('dashboard_content')
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="fw-bold mb-1">Premium Collections</h2>
                <p class="text-muted small mb-0">Track and manage insurance premium payments</p>
            </div>
            <button class="btn btn-primary rounded-pill px-4" onclick="window.print()">
                <i class="bi bi-printer me-2"></i>Export Report
            </button>
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Total Collected</p>
                        <h3 class="fw-bold mb-0">TZS 128.5M</h3>
                    </div>
                    <div class="bg-success bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-cash-stack text-success fs-4"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <span class="badge bg-success bg-opacity-10 text-success">
                        <i class="bi bi-arrow-up"></i> 18.2% this month
                    </span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Pending Payments</p>
                        <h3 class="fw-bold mb-0">TZS 12.3M</h3>
                    </div>
                    <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-clock-history text-warning fs-4"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <span class="badge bg-warning bg-opacity-10 text-warning">
                        45 policies overdue
                    </span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Today's Collections</p>
                        <h3 class="fw-bold mb-0">TZS 4.2M</h3>
                    </div>
                    <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-calendar-check text-primary fs-4"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <span class="badge bg-primary bg-opacity-10 text-primary">
                        89 transactions
                    </span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Collection Rate</p>
                        <h3 class="fw-bold mb-0">94.2%</h3>
                    </div>
                    <div class="bg-info bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-graph-up-arrow text-info fs-4"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <span class="badge bg-info bg-opacity-10 text-info">
                        Above target (90%)
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filter Section -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-3">
                <label class="form-label small fw-semibold">Date Range</label>
                <select class="form-select">
                    <option>Last 7 days</option>
                    <option>Last 30 days</option>
                    <option>Last 3 months</option>
                    <option>Custom range</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-semibold">Payment Status</label>
                <select class="form-select">
                    <option>All Status</option>
                    <option>Paid</option>
                    <option>Pending</option>
                    <option>Overdue</option>
                    <option>Failed</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-semibold">Product Type</label>
                <select class="form-select">
                    <option>All Products</option>
                    <option>Motor Insurance</option>
                    <option>Health Insurance</option>
                    <option>Life Insurance</option>
                    <option>General Insurance</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-semibold">&nbsp;</label>
                <button class="btn btn-primary w-100">
                    <i class="bi bi-funnel me-2"></i>Apply Filters
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Premiums Table -->
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-bottom py-3">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h5 class="mb-0 fw-bold">Recent Premium Collections</h5>
            </div>
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-text bg-light border-0">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" class="form-control border-0 bg-light" placeholder="Search by policy or customer...">
                </div>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="border-0 py-3">Policy No.</th>
                        <th class="border-0 py-3">Customer</th>
                        <th class="border-0 py-3">Product</th>
                        <th class="border-0 py-3">Premium Amount</th>
                        <th class="border-0 py-3">Payment Method</th>
                        <th class="border-0 py-3">Status</th>
                        <th class="border-0 py-3">Date</th>
                        <th class="border-0 py-3 text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse([
                        ['policy' => 'POL-2024-001234', 'customer' => 'John Mwangi', 'product' => 'Motor Insurance', 'amount' => '450,000', 'method' => 'M-Pesa', 'status' => 'paid', 'date' => '2 hours ago'],
                        ['policy' => 'POL-2024-001235', 'customer' => 'Sarah Kimani', 'product' => 'Health Insurance', 'amount' => '280,000', 'method' => 'Bank Transfer', 'status' => 'paid', 'date' => '5 hours ago'],
                        ['policy' => 'POL-2024-001236', 'customer' => 'David Omondi', 'product' => 'Life Insurance', 'amount' => '120,000', 'method' => 'Card', 'status' => 'pending', 'date' => '1 day ago'],
                        ['policy' => 'POL-2024-001237', 'customer' => 'Grace Muthoni', 'product' => 'Motor Insurance', 'amount' => '380,000', 'method' => 'M-Pesa', 'status' => 'paid', 'date' => '1 day ago'],
                        ['policy' => 'POL-2024-001238', 'customer' => 'Peter Kamau', 'product' => 'General Insurance', 'amount' => '650,000', 'method' => 'Bank Transfer', 'status' => 'overdue', 'date' => '3 days ago'],
                    ] as $premium)
                    <tr>
                        <td class="py-3">
                            <span class="fw-semibold text-primary">{{ $premium['policy'] }}</span>
                        </td>
                        <td class="py-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-secondary bg-opacity-10 rounded-circle p-2 me-2">
                                    <i class="bi bi-person text-secondary"></i>
                                </div>
                                <span>{{ $premium['customer'] }}</span>
                            </div>
                        </td>
                        <td class="py-3">
                            <span class="badge bg-primary bg-opacity-10 text-primary">
                                {{ $premium['product'] }}
                            </span>
                        </td>
                        <td class="py-3">
                            <span class="fw-semibold">TZS {{ $premium['amount'] }}</span>
                        </td>
                        <td class="py-3">
                            <span class="badge bg-info bg-opacity-10 text-info">
                                <i class="bi bi-{{ $premium['method'] == 'M-Pesa' ? 'phone' : ($premium['method'] == 'Card' ? 'credit-card' : 'bank') }}"></i>
                                {{ $premium['method'] }}
                            </span>
                        </td>
                        <td class="py-3">
                            @if($premium['status'] == 'paid')
                                <span class="badge bg-success bg-opacity-10 text-success">
                                    <i class="bi bi-check-circle"></i> Paid
                                </span>
                            @elseif($premium['status'] == 'pending')
                                <span class="badge bg-warning bg-opacity-10 text-warning">
                                    <i class="bi bi-clock"></i> Pending
                                </span>
                            @else
                                <span class="badge bg-danger bg-opacity-10 text-danger">
                                    <i class="bi bi-exclamation-circle"></i> Overdue
                                </span>
                            @endif
                        </td>
                        <td class="py-3">
                            <small class="text-muted">{{ $premium['date'] }}</small>
                        </td>
                        <td class="py-3 text-end">
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-primary" title="View Receipt">
                                    <i class="bi bi-receipt"></i>
                                </button>
                                <button class="btn btn-outline-info" title="Download">
                                    <i class="bi bi-download"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-5">
                            <i class="bi bi-inbox fs-1 text-muted d-block mb-3"></i>
                            <p class="text-muted">No premium collections found</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white border-top py-3">
        <div class="d-flex justify-content-between align-items-center">
            <small class="text-muted">Showing 1 to 5 of 156 collections</small>
            <nav>
                <ul class="pagination pagination-sm mb-0">
                    <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>
@endsection

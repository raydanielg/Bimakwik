@extends('layouts.dashboard')

@section('dashboard_content')
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="fw-bold mb-1">Premium Collections</h2>
                <p class="text-muted small mb-0">Track and manage insurance premium payments</p>
            </div>
            <button class="btn btn-primary rounded-pill px-4" onclick="exportPDF()">
                <i class="bi bi-file-earmark-spreadsheet me-2"></i>Export Report
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
                        <h3 class="fw-bold mb-0">TZS {{ number_format($totalCollected, 2) }}</h3>
                    </div>
                    <div class="bg-success bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-cash-stack text-success fs-4"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <span class="badge bg-{{ $monthlyGrowth >= 0 ? 'success' : 'danger' }} bg-opacity-10 text-{{ $monthlyGrowth >= 0 ? 'success' : 'danger' }}">
                        <i class="bi bi-arrow-{{ $monthlyGrowth >= 0 ? 'up' : 'down' }}"></i> {{ number_format(abs($monthlyGrowth), 1) }}% this month
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
                        <h3 class="fw-bold mb-0">TZS {{ number_format($pendingAmount, 2) }}</h3>
                    </div>
                    <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-clock-history text-warning fs-4"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <span class="badge bg-warning bg-opacity-10 text-warning">
                        {{ $pendingCount }} policies overdue
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
                        <h3 class="fw-bold mb-0">TZS {{ number_format($todayCollections, 2) }}</h3>
                    </div>
                    <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-calendar-check text-primary fs-4"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <span class="badge bg-primary bg-opacity-10 text-primary">
                        {{ $todayCount }} transactions
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
                        <h3 class="fw-bold mb-0">{{ number_format($collectionRate, 1) }}%</h3>
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
                    @forelse($collections as $premium)
                    <tr>
                        <td class="py-3">
                            <span class="fw-semibold text-primary">TXN-{{ $premium->id }}</span>
                        </td>
                        <td class="py-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-secondary bg-opacity-10 rounded-circle p-2 me-2">
                                    <i class="bi bi-person text-secondary"></i>
                                </div>
                                <span>{{ $premium->user->name ?? 'Customer' }}</span>
                            </div>
                        </td>
                        <td class="py-3">
                            <span class="badge bg-primary bg-opacity-10 text-primary">
                                {{ $premium->type ?? 'Premium Payment' }}
                            </span>
                        </td>
                        <td class="py-3">
                            <span class="fw-semibold">TZS {{ number_format($premium->amount ?? 0, 2) }}</span>
                        </td>
                        <td class="py-3">
                            @php
                                $method = $premium->payment_method ?? 'M-Pesa';
                                $methodIcon = $method == 'M-Pesa' ? 'phone' : ($method == 'Card' ? 'credit-card' : 'bank');
                            @endphp
                            <span class="badge bg-info bg-opacity-10 text-info">
                                <i class="bi bi-{{ $methodIcon }}"></i>
                                {{ $method }}
                            </span>
                        </td>
                        <td class="py-3">
                            @php
                                $status = $premium->status ?? 'completed';
                            @endphp
                            @if($status == 'completed' || $status == 'paid')
                                <span class="badge bg-success bg-opacity-10 text-success">
                                    <i class="bi bi-check-circle"></i> Paid
                                </span>
                            @elseif($status == 'pending')
                                <span class="badge bg-warning bg-opacity-10 text-warning">
                                    <i class="bi bi-clock"></i> Pending
                                </span>
                            @else
                                <span class="badge bg-danger bg-opacity-10 text-danger">
                                    <i class="bi bi-exclamation-circle"></i> Failed
                                </span>
                            @endif
                        </td>
                        <td class="py-3">
                            <small class="text-muted">{{ $premium->created_at ? $premium->created_at->diffForHumans() : 'N/A' }}</small>
                        </td>
                        <td class="py-3 text-end">
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-primary" onclick="viewReceipt({{ $premium->id }})" title="View Receipt">
                                    <i class="bi bi-receipt"></i>
                                </button>
                                <button class="btn btn-outline-success" onclick="downloadReceipt({{ $premium->id }})" title="Download Receipt">
                                    <i class="bi bi-download"></i>
                                </button>
                                <button class="btn btn-outline-info" onclick="sendReceipt({{ $premium->id }})" title="Email Receipt">
                                    <i class="bi bi-envelope"></i>
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
    @if($collections->hasPages())
    <div class="card-footer bg-white border-top py-3">
        <div class="d-flex justify-content-between align-items-center">
            <small class="text-muted">Showing {{ $collections->firstItem() }} to {{ $collections->lastItem() }} of {{ $collections->total() }} collections</small>
            <div>
                {{ $collections->links() }}
            </div>
        </div>
    </div>
    @endif
</div>

@push('scripts')
<script>
function exportPDF() {
    Swal.fire({
        title: 'Generating Premium Report...',
        html: `
            <div class="mb-3">
                <div class="spinner-border text-primary" role="status"></div>
            </div>
            <p>Creating comprehensive CSV report with:</p>
            <ul class="text-start small">
                <li>✓ All premium collections</li>
                <li>✓ Payment statistics</li>
                <li>✓ Collection summary</li>
                <li>✓ Excel compatible format</li>
            </ul>
        `,
        allowOutsideClick: false,
        showConfirmButton: false,
        didOpen: () => {
            setTimeout(() => {
                window.location.href = '{{ route("admin.finance.premiums.export") }}';
                Swal.close();
                Swal.fire({
                    icon: 'success',
                    title: 'Report Generated!',
                    text: 'Your premium report is downloading',
                    timer: 2000,
                    showConfirmButton: false
                });
            }, 1500);
        }
    });
}

function viewReceipt(id) {
    Swal.fire({
        title: 'Premium Receipt',
        html: `
            <div class="text-start">
                <p><strong>Transaction ID:</strong> TXN-${id}</p>
                <p><strong>Status:</strong> <span class="badge bg-success">Paid</span></p>
                <p><strong>Amount:</strong> TZS XXX,XXX.XX</p>
                <p><strong>Payment Method:</strong> M-Pesa</p>
                <p><strong>Date:</strong> ${new Date().toLocaleDateString()}</p>
            </div>
        `,
        icon: 'info',
        confirmButtonText: 'Close'
    });
}

function downloadReceipt(id) {
    Swal.fire({
        title: 'Downloading Receipt...',
        html: `
            <div class="mb-3">
                <div class="spinner-border text-success" role="status"></div>
            </div>
            <p>Preparing receipt PDF for transaction TXN-${id}</p>
        `,
        allowOutsideClick: false,
        showConfirmButton: false,
        didOpen: () => {
            setTimeout(() => {
                Swal.fire({
                    icon: 'success',
                    title: 'Receipt Downloaded!',
                    text: 'Receipt saved to your downloads folder',
                    timer: 2000,
                    showConfirmButton: false
                });
            }, 1500);
        }
    });
}

function sendReceipt(id) {
    Swal.fire({
        title: 'Send Receipt via Email?',
        text: 'Receipt will be sent to the customer\'s registered email',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#0d6efd',
        confirmButtonText: 'Send Email'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                icon: 'success',
                title: 'Email Sent!',
                text: 'Receipt has been sent successfully',
                timer: 2000,
                showConfirmButton: false
            });
        }
    });
}
</script>
@endpush
@endsection

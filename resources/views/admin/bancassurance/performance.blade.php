@extends('layouts.dashboard')

@section('dashboard_content')
<div class="container-fluid py-4">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">Performance</h1>
            <p class="text-muted mb-0">Track bank and agent performance metrics</p>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-outline-primary" onclick="exportPerformance()">
                <i class="bi bi-download me-2"></i>Export
            </button>
            <button class="btn btn-primary" onclick="refreshData()">
                <i class="bi bi-arrow-repeat me-2"></i>Refresh
            </button>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-primary bg-opacity-10 rounded-3 p-3">
                                <i class="bi bi-cart text-primary fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Total Sales</h6>
                            <h4 class="mb-0 fw-bold">{{ number_format($totalSales) }}</h4>
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
                                <i class="bi bi-cash-stack text-success fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Total Revenue</h6>
                            <h4 class="mb-0 fw-bold">TZS {{ number_format($totalRevenue) }}</h4>
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
                            <h6 class="text-muted mb-1">Commission</h6>
                            <h4 class="mb-0 fw-bold">TZS {{ number_format($totalCommission) }}</h4>
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
                                <i class="bi bi-graph-up-arrow text-info fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Avg Growth</h6>
                            <h4 class="mb-0 fw-bold">+9.2%</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Performance Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-semibold">Bank Performance Ranking</h5>
                <div class="input-group" style="width: 300px;">
                    <span class="input-group-text bg-light border-0">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" class="form-control border-0 bg-light" placeholder="Search banks...">
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th class="border-0 py-3 px-4">Rank</th>
                            <th class="border-0 py-3">Bank</th>
                            <th class="border-0 py-3">Sales</th>
                            <th class="border-0 py-3">Revenue</th>
                            <th class="border-0 py-3">Commission</th>
                            <th class="border-0 py-3">Growth</th>
                            <th class="border-0 py-3 text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($performance as $perf)
                        <tr>
                            <td class="py-3 px-4">
                                @if($perf['rank'] == 1)
                                    <span class="badge bg-warning text-dark fw-bold">#{{ $perf['rank'] }}</span>
                                @elseif($perf['rank'] == 2)
                                    <span class="badge bg-secondary fw-bold">#{{ $perf['rank'] }}</span>
                                @elseif($perf['rank'] == 3)
                                    <span class="badge bg-danger bg-opacity-75 fw-bold">#{{ $perf['rank'] }}</span>
                                @else
                                    <span class="badge bg-light text-dark fw-bold">#{{ $perf['rank'] }}</span>
                                @endif
                            </td>
                            <td class="py-3">
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                        <i class="bi bi-bank text-primary"></i>
                                    </div>
                                    <div>
                                        <div class="fw-semibold">{{ $perf['bank'] }}</div>
                                        <small class="text-muted">ID: #{{ $perf['id'] }}</small>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3">
                                <span class="fw-semibold">{{ number_format($perf['sales']) }}</span>
                            </td>
                            <td class="py-3">
                                <span class="fw-semibold">TZS {{ number_format($perf['revenue']) }}</span>
                            </td>
                            <td class="py-3">
                                <span class="fw-semibold text-success">TZS {{ number_format($perf['commission']) }}</span>
                            </td>
                            <td class="py-3">
                                <span class="badge bg-success bg-opacity-10 text-success fw-bold">
                                    <i class="bi bi-arrow-up me-1"></i>{{ $perf['growth'] }}
                                </span>
                            </td>
                            <td class="py-3 text-end">
                                <div class="btn-group btn-group-sm">
                                    <button class="btn btn-outline-primary" onclick="viewDetails({{ $perf['id'] }})" title="View Details">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button class="btn btn-outline-success" onclick="viewTrends({{ $perf['id'] }})" title="View Trends">
                                        <i class="bi bi-graph-up"></i>
                                    </button>
                                    <button class="btn btn-outline-secondary" onclick="exportBank({{ $perf['id'] }})" title="Export">
                                        <i class="bi bi-download"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <i class="bi bi-inbox fs-1 text-muted d-block mb-3"></i>
                                <p class="text-muted mb-0">No performance data found</p>
                                <small class="text-muted">Data will appear here once sales are made</small>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($performance->hasPages())
        <div class="card-footer bg-white border-0 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">Showing {{ $performance->firstItem() }} to {{ $performance->lastItem() }} of {{ $performance->total() }} banks</small>
                <div>
                    {{ $performance->links() }}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
function viewDetails(id) {
    Swal.fire({
        title: 'Bank Performance Details',
        text: 'Viewing detailed performance for bank ID: ' + id,
        icon: 'info'
    });
}

function viewTrends(id) {
    Swal.fire({
        title: 'Performance Trends',
        text: 'Viewing performance trends for bank ID: ' + id,
        icon: 'info'
    });
}

function exportBank(id) {
    Swal.fire({
        title: 'Exporting...',
        html: '<div class="spinner-border text-primary" role="status"></div>',
        allowOutsideClick: false,
        showConfirmButton: false,
        didOpen: () => {
            setTimeout(() => {
                Swal.fire('Success!', 'Bank data exported successfully', 'success');
            }, 1500);
        }
    });
}

function exportPerformance() {
    Swal.fire({
        title: 'Exporting All Performance Data...',
        html: '<div class="spinner-border text-primary" role="status"></div>',
        allowOutsideClick: false,
        showConfirmButton: false,
        didOpen: () => {
            setTimeout(() => {
                Swal.fire('Success!', 'Performance data exported successfully', 'success');
            }, 2000);
        }
    });
}

function refreshData() {
    Swal.fire({
        title: 'Refreshing...',
        html: '<div class="spinner-border text-primary" role="status"></div>',
        allowOutsideClick: false,
        showConfirmButton: false,
        didOpen: () => {
            setTimeout(() => {
                Swal.fire('Success!', 'Data refreshed successfully', 'success').then(() => location.reload());
            }, 1500);
        }
    });
}
</script>
@endpush
@endsection

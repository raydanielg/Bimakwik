@extends('layouts.dashboard')

@section('dashboard_content')
<!-- Header Stats -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Total Users</p>
                        <h3 class="fw-bold mb-0 stat-count">{{ number_format($totalUsers) }}</h3>
                    </div>
                    <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-people text-primary fs-4"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <span class="badge bg-{{ $usersGrowth >= 0 ? 'success' : 'danger' }} bg-opacity-10 text-{{ $usersGrowth >= 0 ? 'success' : 'danger' }}">
                        <i class="bi bi-arrow-{{ $usersGrowth >= 0 ? 'up' : 'down' }}"></i> {{ number_format(abs($usersGrowth), 1) }}%
                    </span>
                    <small class="text-muted ms-2">vs last month</small>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Total Revenue</p>
                        <h3 class="fw-bold mb-0">TZS {{ number_format($totalRevenue / 1000000, 1) }}M</h3>
                    </div>
                    <div class="bg-success bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-cash-stack text-success fs-4"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <span class="badge bg-{{ $revenueGrowth >= 0 ? 'success' : 'danger' }} bg-opacity-10 text-{{ $revenueGrowth >= 0 ? 'success' : 'danger' }}">
                        <i class="bi bi-arrow-{{ $revenueGrowth >= 0 ? 'up' : 'down' }}"></i> {{ number_format(abs($revenueGrowth), 1) }}%
                    </span>
                    <small class="text-muted ms-2">vs last month</small>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Active Policies</p>
                        <h3 class="fw-bold mb-0">{{ number_format($activePolicies) }}</h3>
                    </div>
                    <div class="bg-info bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-shield-check text-info fs-4"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <small class="text-muted">{{ number_format($totalPolicies) }} total policies</small>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Pending Claims</p>
                        <h3 class="fw-bold mb-0">{{ number_format($pendingClaims) }}</h3>
                    </div>
                    <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-exclamation-octagon text-warning fs-4"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <small class="text-muted">{{ number_format($totalClaims) }} total claims</small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Charts Row -->
<div class="row g-3 mb-4">
    <!-- Revenue Chart -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold">Revenue & User Growth</h5>
                    <span class="badge bg-primary bg-opacity-10 text-primary">Last 12 Months</span>
                </div>
            </div>
            <div class="card-body">
                <canvas id="revenueChart" height="80"></canvas>
            </div>
        </div>
    </div>
    
    <!-- User Distribution Chart -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3">
                <h5 class="mb-0 fw-bold">User Distribution</h5>
            </div>
            <div class="card-body">
                <canvas id="userDistributionChart" height="200"></canvas>
                <div class="mt-4">
                    @foreach($usersByRole as $index => $role)
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="small">
                            <i class="bi bi-circle-fill me-2" style="color: {{ ['#0d6efd', '#198754', '#ffc107', '#dc3545', '#0dcaf0'][$index % 5] }}; font-size: 0.5rem;"></i>
                            {{ ucfirst($role->name) }}
                        </span>
                        <span class="fw-bold">{{ number_format($role->count) }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Additional Stats Row -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3">
                <h5 class="mb-0 fw-bold">Claims Overview</h5>
            </div>
            <div class="card-body">
                <canvas id="claimsChart" height="150"></canvas>
                <div class="mt-3">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="small"><i class="bi bi-circle-fill text-warning me-2" style="font-size: 0.5rem;"></i>Pending</span>
                        <span class="fw-bold">{{ number_format($pendingClaims) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="small"><i class="bi bi-circle-fill text-success me-2" style="font-size: 0.5rem;"></i>Approved</span>
                        <span class="fw-bold">{{ number_format($approvedClaims) }}</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="small"><i class="bi bi-circle-fill text-danger me-2" style="font-size: 0.5rem;"></i>Rejected</span>
                        <span class="fw-bold">{{ number_format($rejectedClaims) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3">
                <h5 class="mb-0 fw-bold">Financial Summary</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="small text-muted">Wallet Balance</span>
                        <span class="fw-bold text-success">TZS {{ number_format($totalWalletBalance / 1000000, 1) }}M</span>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-success" style="width: 75%"></div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="small text-muted">Total Commissions</span>
                        <span class="fw-bold text-primary">TZS {{ number_format($totalCommissions / 1000000, 1) }}M</span>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-primary" style="width: 60%"></div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="small text-muted">Pending Commissions</span>
                        <span class="fw-bold text-warning">TZS {{ number_format($pendingCommissions / 1000000, 1) }}M</span>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-warning" style="width: 40%"></div>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <small class="text-muted">{{ number_format($activeWallets) }} active wallets</small>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3">
                <h5 class="mb-0 fw-bold">Recent Activity</h5>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    @forelse($recentUsers->take(5) as $user)
                    <div class="list-group-item px-0 py-2 border-0">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-2">
                                <i class="bi bi-person text-primary"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="fw-semibold small">{{ $user->name }}</div>
                                <small class="text-muted">{{ $user->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                    </div>
                    @empty
                    <p class="text-muted small text-center py-3">No recent users</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
// Revenue & User Growth Chart
const revenueCtx = document.getElementById('revenueChart').getContext('2d');
new Chart(revenueCtx, {
    type: 'line',
    data: {
        labels: {!! json_encode($monthlyRevenue->pluck('month')->map(function($m) { return date('M Y', strtotime($m)); })) !!},
        datasets: [{
            label: 'Revenue (TZS)',
            data: {!! json_encode($monthlyRevenue->pluck('total')) !!},
            borderColor: '#0d6efd',
            backgroundColor: 'rgba(13, 110, 253, 0.1)',
            tension: 0.4,
            fill: true
        }, {
            label: 'New Users',
            data: {!! json_encode($monthlyUsers->pluck('total')) !!},
            borderColor: '#198754',
            backgroundColor: 'rgba(25, 135, 84, 0.1)',
            tension: 0.4,
            fill: true
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
            legend: {
                display: true,
                position: 'top'
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value) {
                        return 'TZS ' + (value / 1000000).toFixed(1) + 'M';
                    }
                }
            }
        }
    }
});

// User Distribution Pie Chart
const userDistCtx = document.getElementById('userDistributionChart').getContext('2d');
new Chart(userDistCtx, {
    type: 'doughnut',
    data: {
        labels: {!! json_encode($usersByRole->pluck('name')->map(function($n) { return ucfirst($n); })) !!},
        datasets: [{
            data: {!! json_encode($usersByRole->pluck('count')) !!},
            backgroundColor: ['#0d6efd', '#198754', '#ffc107', '#dc3545', '#0dcaf0'],
            borderWidth: 0
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
            legend: {
                display: false
            }
        }
    }
});

// Claims Doughnut Chart
const claimsCtx = document.getElementById('claimsChart').getContext('2d');
new Chart(claimsCtx, {
    type: 'doughnut',
    data: {
        labels: ['Pending', 'Approved', 'Rejected'],
        datasets: [{
            data: [{{ $pendingClaims }}, {{ $approvedClaims }}, {{ $rejectedClaims }}],
            backgroundColor: ['#ffc107', '#198754', '#dc3545'],
            borderWidth: 0
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
            legend: {
                display: false
            }
        }
    }
});
</script>
@endpush
@endsection

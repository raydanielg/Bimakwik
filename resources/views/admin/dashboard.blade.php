@extends('layouts.dashboard')

@section('dashboard_content')
<!-- Period Filter -->
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h4 class="fw-bold mb-1" style="color: #1e293b;">Admin Dashboard</h4>
        <small class="text-muted">Real-time overview of the Bima Kwik platform</small>
    </div>
    <div class="d-flex gap-2">
        <a href="?period=7d" class="btn btn-sm {{ $period == '7d' ? 'btn-primary' : 'btn-outline-secondary' }} rounded-pill px-3">7D</a>
        <a href="?period=30d" class="btn btn-sm {{ $period == '30d' ? 'btn-primary' : 'btn-outline-secondary' }} rounded-pill px-3">30D</a>
        <a href="?period=90d" class="btn btn-sm {{ $period == '90d' ? 'btn-primary' : 'btn-outline-secondary' }} rounded-pill px-3">90D</a>
        <a href="?period=1y" class="btn btn-sm {{ $period == '1y' ? 'btn-primary' : 'btn-outline-secondary' }} rounded-pill px-3">1Y</a>
        <button class="btn btn-outline-secondary btn-sm rounded-pill px-3" onclick="location.reload()"><i class="bi bi-arrow-clockwise"></i></button>
    </div>
</div>

<!-- Row 1: Key Stats -->
<div class="row g-3 mb-4">
    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <small class="text-muted fw-semibold text-uppercase tracking-wide" style="font-size: 0.65rem; letter-spacing: 0.5px;">Total Users</small>
                    <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                        <i class="bi bi-people text-primary"></i>
                    </div>
                </div>
                <h3 class="fw-bold mb-0" style="color: #1e293b;">{{ number_format($totalUsers) }}</h3>
                <div class="mt-2 d-flex align-items-center gap-2">
                    <span class="badge bg-{{ $usersGrowth >= 0 ? 'success' : 'danger' }} bg-opacity-10 text-{{ $usersGrowth >= 0 ? 'success' : 'danger' }}" style="font-size: 0.7rem;">
                        <i class="bi bi-arrow-{{ $usersGrowth >= 0 ? 'up' : 'down' }}"></i> {{ number_format(abs($usersGrowth), 1) }}%
                    </span>
                    <small class="text-muted" style="font-size: 0.7rem;">vs prev</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <small class="text-muted fw-semibold text-uppercase tracking-wide" style="font-size: 0.65rem; letter-spacing: 0.5px;">Revenue</small>
                    <div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                        <i class="bi bi-cash-stack text-success"></i>
                    </div>
                </div>
                <h3 class="fw-bold mb-0" style="color: #1e293b;">TZS {{ number_format($totalRevenue / 1000000, 1) }}M</h3>
                <div class="mt-2 d-flex align-items-center gap-2">
                    <span class="badge bg-{{ $revenueGrowth >= 0 ? 'success' : 'danger' }} bg-opacity-10 text-{{ $revenueGrowth >= 0 ? 'success' : 'danger' }}" style="font-size: 0.7rem;">
                        <i class="bi bi-arrow-{{ $revenueGrowth >= 0 ? 'up' : 'down' }}"></i> {{ number_format(abs($revenueGrowth), 1) }}%
                    </span>
                    <small class="text-muted" style="font-size: 0.7rem;">vs prev</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <small class="text-muted fw-semibold text-uppercase tracking-wide" style="font-size: 0.65rem; letter-spacing: 0.5px;">Active Policies</small>
                    <div class="bg-info bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                        <i class="bi bi-shield-check text-info"></i>
                    </div>
                </div>
                <h3 class="fw-bold mb-0" style="color: #1e293b;">{{ number_format($activePolicies) }}</h3>
                <div class="mt-2">
                    <small class="text-muted" style="font-size: 0.7rem;">{{ number_format($totalPolicies) }} total &middot; {{ number_format($policiesSoldPeriod) }} new</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <small class="text-muted fw-semibold text-uppercase tracking-wide" style="font-size: 0.65rem; letter-spacing: 0.5px;">Claims</small>
                    <div class="bg-warning bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                        <i class="bi bi-exclamation-octagon text-warning"></i>
                    </div>
                </div>
                <h3 class="fw-bold mb-0" style="color: #1e293b;">{{ number_format($totalClaims) }}</h3>
                <div class="mt-2 d-flex align-items-center gap-2">
                    <span class="badge bg-warning bg-opacity-10 text-warning" style="font-size: 0.7rem;">{{ number_format($pendingClaims) }} pending</span>
                    <span class="badge bg-{{ $claimsGrowth >= 0 ? 'success' : 'danger' }} bg-opacity-10 text-{{ $claimsGrowth >= 0 ? 'success' : 'danger' }}" style="font-size: 0.7rem;">
                        <i class="bi bi-arrow-{{ $claimsGrowth >= 0 ? 'up' : 'down' }}"></i> {{ number_format(abs($claimsGrowth), 1) }}%
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <small class="text-muted fw-semibold text-uppercase tracking-wide" style="font-size: 0.65rem; letter-spacing: 0.5px;">Products</small>
                    <div class="bg-purple bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                        <i class="bi bi-box-seam text-purple" style="color: #6f42c1;"></i>
                    </div>
                </div>
                <h3 class="fw-bold mb-0" style="color: #1e293b;">{{ number_format($totalProducts) }}</h3>
                <div class="mt-2">
                    <small class="text-muted" style="font-size: 0.7rem;">{{ number_format($activeProducts) }} active</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <small class="text-muted fw-semibold text-uppercase tracking-wide" style="font-size: 0.65rem; letter-spacing: 0.5px;">Wallet Balance</small>
                    <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                        <i class="bi bi-wallet2 text-primary"></i>
                    </div>
                </div>
                <h3 class="fw-bold mb-0" style="color: #1e293b;">TZS {{ number_format($totalWalletBalance / 1000000, 1) }}M</h3>
                <div class="mt-2">
                    <small class="text-muted" style="font-size: 0.7rem;">{{ number_format($activeWallets) }} active wallets</small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Row 2: Charts -->
<div class="row g-3 mb-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold"><i class="bi bi-graph-up me-2 text-primary"></i>Platform Growth Overview</h5>
                <div class="d-flex gap-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="chartMetric" id="chRevenue" value="revenue" checked>
                        <label class="form-check-label small" for="chRevenue">Revenue</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="chartMetric" id="chUsers" value="users">
                        <label class="form-check-label small" for="chUsers">Users</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="chartMetric" id="chPolicies" value="policies">
                        <label class="form-check-label small" for="chPolicies">Policies</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="chartMetric" id="chClaims" value="claims">
                        <label class="form-check-label small" for="chClaims">Claims</label>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <canvas id="mainChart" height="100"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-bottom py-3">
                <h5 class="mb-0 fw-bold"><i class="bi bi-people me-2 text-primary"></i>User Distribution</h5>
            </div>
            <div class="card-body d-flex flex-column">
                <canvas id="userDistChart" height="180"></canvas>
                <div class="mt-3 overflow-auto" style="max-height: 160px;">
                    @foreach($usersByRole as $i => $role)
                    <div class="d-flex justify-content-between align-items-center mb-1 py-1 border-bottom border-light">
                        <span class="small">
                            <i class="bi bi-circle-fill me-2" style="color: {{ $pieColors[$i % count($pieColors)] }}; font-size: 0.45rem;"></i>
                            {{ ucfirst(str_replace(['-','_'], ' ', $role->name)) }}
                        </span>
                        <span class="fw-semibold small">{{ number_format($role->count) }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Row 3: More Stats -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-bottom py-3">
                <h5 class="mb-0 fw-bold small"><i class="bi bi-shield-check me-2 text-success"></i>Claims Overview</h5>
            </div>
            <div class="card-body">
                <canvas id="claimsDonut" height="120"></canvas>
                <div class="mt-3 d-flex justify-content-around text-center">
                    <div>
                        <div class="fw-bold text-warning">{{ number_format($pendingClaims) }}</div>
                        <small class="text-muted">Pending</small>
                    </div>
                    <div>
                        <div class="fw-bold text-success">{{ number_format($approvedClaims) }}</div>
                        <small class="text-muted">Approved</small>
                    </div>
                    <div>
                        <div class="fw-bold text-danger">{{ number_format($rejectedClaims) }}</div>
                        <small class="text-muted">Rejected</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-bottom py-3">
                <h5 class="mb-0 fw-bold small"><i class="bi bi-cash-coin me-2 text-warning"></i>Commissions</h5>
            </div>
            <div class="card-body d-flex flex-column justify-content-center">
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-1">
                        <small class="text-muted">Total</small>
                        <span class="fw-semibold">TZS {{ number_format($totalCommissions / 1000000, 1) }}M</span>
                    </div>
                    <div class="progress" style="height: 6px;">
                        <div class="progress-bar bg-primary" style="width: 100%"></div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-1">
                        <small class="text-muted">Paid</small>
                        <span class="fw-semibold text-success">TZS {{ number_format($paidCommissions / 1000000, 1) }}M</span>
                    </div>
                    <div class="progress" style="height: 6px;">
                        <div class="progress-bar bg-success" style="width: {{ $totalCommissions > 0 ? ($paidCommissions / $totalCommissions) * 100 : 0 }}%"></div>
                    </div>
                </div>
                <div>
                    <div class="d-flex justify-content-between mb-1">
                        <small class="text-muted">Pending</small>
                        <span class="fw-semibold text-warning">TZS {{ number_format($pendingCommissions / 1000000, 1) }}M</span>
                    </div>
                    <div class="progress" style="height: 6px;">
                        <div class="progress-bar bg-warning" style="width: {{ $totalCommissions > 0 ? ($pendingCommissions / $totalCommissions) * 100 : 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-bottom py-3">
                <h5 class="mb-0 fw-bold small"><i class="bi bi-person-vcard me-2 text-info"></i>KYC & Support</h5>
            </div>
            <div class="card-body d-flex flex-column justify-content-center">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span><i class="bi bi-person-vcard text-info me-2"></i>KYC Submissions</span>
                    <span class="fw-bold">{{ number_format($totalKyc) }}</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span><i class="bi bi-clock text-warning me-2"></i>Pending KYC</span>
                    <span class="fw-bold text-warning">{{ number_format($pendingKyc) }}</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span><i class="bi bi-ticket text-danger me-2"></i>Open Tickets</span>
                    <span class="fw-bold text-danger">{{ number_format($openTickets) }}</span>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-bell text-secondary me-2"></i>Unread Notifications</span>
                    <span class="fw-bold">{{ number_format($unreadNotifications) }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-bottom py-3">
                <h5 class="mb-0 fw-bold small"><i class="bi bi-activity me-2 text-secondary"></i>System Health</h5>
            </div>
            <div class="card-body d-flex flex-column justify-content-center">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span><i class="bi bi-arrow-repeat text-success me-2"></i>Renewals ({{ $period }})</span>
                    <span class="fw-bold">{{ number_format($renewalsCount) }}</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span><i class="bi bi-x-circle text-danger me-2"></i>Cancellations</span>
                    <span class="fw-bold text-danger">{{ number_format($cancellationsCount) }}</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span><i class="bi bi-cash text-primary me-2"></i>Financing Requests</span>
                    <span class="fw-bold">{{ number_format($financingRequests) }}</span>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-gear text-secondary me-2"></i>Active Workflows</span>
                    <span class="fw-bold">{{ number_format($workflowsRunning) }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Row 4: Payment Methods & Recent Activity -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-bottom py-3">
                <h5 class="mb-0 fw-bold small"><i class="bi bi-credit-card me-2 text-primary"></i>Payment Methods</h5>
            </div>
            <div class="card-body">
                <canvas id="paymentChart" height="140"></canvas>
                <div class="mt-3">
                    @foreach($paymentMethods as $pm)
                    <div class="d-flex justify-content-between align-items-center mb-1 py-1 border-bottom border-light">
                        <span class="small text-capitalize">{{ $pm->payment_method ?? 'Unknown' }}</span>
                        <span class="fw-semibold small">{{ number_format($pm->count) }} (TZS {{ number_format($pm->total / 1000000, 1) }}M)</span>
                    </div>
                    @endforeach
                    @if($paymentMethods->isEmpty())
                    <p class="text-muted small text-center py-3">No payment data yet</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-bottom py-3">
                <h5 class="mb-0 fw-bold small"><i class="bi bi-clock-history me-2 text-primary"></i>Recent Activity</h5>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush" style="max-height: 290px; overflow-y: auto;">
                    @forelse($recentUsers as $user)
                    <div class="list-group-item px-3 py-2 border-0 border-bottom border-light">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px; min-width: 32px;">
                                <i class="bi bi-person text-primary" style="font-size: 0.85rem;"></i>
                            </div>
                            <div class="flex-grow-1 min-width-0">
                                <div class="fw-semibold small text-truncate">{{ $user->name }}</div>
                                <small class="text-muted" style="font-size: 0.65rem;">New user &middot; {{ $user->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @forelse($recentPolicies as $policy)
                    <div class="list-group-item px-3 py-2 border-0 border-bottom border-light">
                        <div class="d-flex align-items-center">
                            <div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px; min-width: 32px;">
                                <i class="bi bi-shield-check text-success" style="font-size: 0.85rem;"></i>
                            </div>
                            <div class="flex-grow-1 min-width-0">
                                <div class="fw-semibold small text-truncate">Policy #{{ $policy->id }}</div>
                                <small class="text-muted" style="font-size: 0.65rem;">{{ $policy->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @forelse($recentClaims as $claim)
                    <div class="list-group-item px-3 py-2 border-0 border-bottom border-light">
                        <div class="d-flex align-items-center">
                            <div class="bg-warning bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px; min-width: 32px;">
                                <i class="bi bi-exclamation-octagon text-warning" style="font-size: 0.85rem;"></i>
                            </div>
                            <div class="flex-grow-1 min-width-0">
                                <div class="fw-semibold small text-truncate">Claim #{{ $claim->id }}</div>
                                <small class="text-muted" style="font-size: 0.65rem;">{{ $claim->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @if($recentUsers->isEmpty() && $recentPolicies->isEmpty() && $recentClaims->isEmpty())
                    <p class="text-muted small text-center py-4">No recent activity</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-bottom py-3">
                <h5 class="mb-0 fw-bold small"><i class="bi bi-building me-2 text-primary"></i>Top Insurers</h5>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    @forelse($topInsurers as $ti)
                    <div class="list-group-item px-3 py-2 border-0 border-bottom border-light">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="small fw-semibold">Insurer #{{ $ti->insurer_id }}</span>
                            <span class="badge bg-primary bg-opacity-10 text-primary" style="font-size: 0.7rem;">{{ number_format($ti->total_policies) }} policies</span>
                        </div>
                        <small class="text-muted" style="font-size: 0.65rem;">TZS {{ number_format($ti->total_premium / 1000000, 1) }}M total premium</small>
                    </div>
                    @empty
                    <p class="text-muted small text-center py-4">No insurer data yet</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Row 5: Recent Transactions Table -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold small"><i class="bi bi-list-ul me-2 text-primary"></i>Recent Transactions</h5>
        <a href="{{ route('payment.transactions.index') }}" class="btn btn-sm btn-outline-primary rounded-pill">View All</a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0" style="font-size: 0.8rem;">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">#</th>
                        <th>User</th>
                        <th>Amount</th>
                        <th>Method</th>
                        <th>Status</th>
                        <th class="pe-3">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentTransactions as $txn)
                    <tr>
                        <td class="ps-3 fw-semibold">{{ $txn->transaction_id ?? 'TXN-'.$txn->id }}</td>
                        <td>{{ $txn->user->name ?? 'N/A' }}</td>
                        <td class="fw-semibold">TZS {{ number_format($txn->amount, 0) }}</td>
                        <td><span class="badge bg-light text-dark text-capitalize">{{ $txn->payment_method ?? 'N/A' }}</span></td>
                        <td>
                            <span class="badge bg-{{ $txn->status == 'completed' ? 'success' : ($txn->status == 'pending' ? 'warning' : 'danger') }} bg-opacity-10 text-{{ $txn->status == 'completed' ? 'success' : ($txn->status == 'pending' ? 'warning' : 'danger') }}">
                                {{ ucfirst($txn->status) }}
                            </span>
                        </td>
                        <td class="pe-3 text-muted">{{ $txn->created_at->diffForHumans() }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">No transactions yet</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Row 6: Quick Stats Footer -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm bg-primary bg-opacity-10 border-primary border-opacity-25">
            <div class="card-body text-center py-3">
                <div class="fw-bold text-primary fs-4">{{ number_format($newUsersPeriod) }}</div>
                <small class="text-muted">New Users ({{ $period }})</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm bg-success bg-opacity-10 border-success border-opacity-25">
            <div class="card-body text-center py-3">
                <div class="fw-bold text-success fs-4">TZS {{ number_format($revenuePeriod / 1000000, 1) }}M</div>
                <small class="text-muted">Revenue ({{ $period }})</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm bg-warning bg-opacity-10 border-warning border-opacity-25">
            <div class="card-body text-center py-3">
                <div class="fw-bold text-warning fs-4">{{ number_format($loginAttempts) }}</div>
                <small class="text-muted">Logins (7d) &middot; {{ number_format($failedLogins) }} failed</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm bg-info bg-opacity-10 border-info border-opacity-25">
            <div class="card-body text-center py-3">
                <div class="fw-bold text-info fs-4">{{ number_format($activeLoans) }}</div>
                <small class="text-muted">Active Premium Loans</small>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
// Main multi-metric chart
const mainCtx = document.getElementById('mainChart').getContext('2d');
const mainChart = new Chart(mainCtx, {
    type: 'line',
    data: {
        labels: {!! json_encode($monthLabels) !!},
        datasets: [{
            label: 'Revenue (TZS)',
            data: {!! json_encode($revenueData) !!},
            borderColor: '#0d6efd',
            backgroundColor: 'rgba(13, 110, 253, 0.08)',
            tension: 0.4,
            fill: true,
            yAxisID: 'y'
        }, {
            label: 'New Users',
            data: {!! json_encode($userData) !!},
            borderColor: '#198754',
            backgroundColor: 'rgba(25, 135, 84, 0.08)',
            tension: 0.4,
            fill: true,
            yAxisID: 'y1'
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true,
        interaction: { mode: 'index', intersect: false },
        plugins: {
            legend: { display: true, position: 'top', labels: { boxWidth: 12, padding: 15, font: { size: 11 } } }
        },
        scales: {
            y: {
                type: 'linear', display: true, position: 'left',
                ticks: { callback: function(v) { return 'TZS ' + (v/1000000).toFixed(1) + 'M'; }, font: { size: 10 } },
                grid: { color: 'rgba(0,0,0,0.04)' }
            },
            y1: {
                type: 'linear', display: true, position: 'right',
                ticks: { font: { size: 10 } },
                grid: { drawOnChartArea: false }
            },
            x: { ticks: { font: { size: 10 } } }
        }
    }
});

// Chart metric toggle
document.querySelectorAll('input[name="chartMetric"]').forEach(radio => {
    radio.addEventListener('change', function() {
        let data, label, color;
        switch(this.value) {
            case 'revenue':
                data = {!! json_encode($revenueData) !!}; label = 'Revenue (TZS)'; color = '#0d6efd'; break;
            case 'users':
                data = {!! json_encode($userData) !!}; label = 'New Users'; color = '#198754'; break;
            case 'policies':
                data = {!! json_encode($policyData) !!}; label = 'Policies Sold'; color = '#ffc107'; break;
            case 'claims':
                data = {!! json_encode($claimData) !!}; label = 'Claims Filed'; color = '#dc3545'; break;
        }
        mainChart.data.datasets[0].data = data;
        mainChart.data.datasets[0].label = label;
        mainChart.data.datasets[0].borderColor = color;
        mainChart.data.datasets[0].backgroundColor = color.replace(')', ', 0.08)').replace('rgb', 'rgba');
        mainChart.update();
    });
});

// User Distribution Doughnut
const userDistCtx = document.getElementById('userDistChart').getContext('2d');
new Chart(userDistCtx, {
    type: 'doughnut',
    data: {
        labels: {!! json_encode($usersByRole->pluck('name')->map(function($n) { return ucfirst(str_replace(['-','_'], ' ', $n)); })) !!},
        datasets: [{
            data: {!! json_encode($usersByRole->pluck('count')) !!},
            backgroundColor: {!! json_encode(array_slice($pieColors, 0, count($usersByRole))) !!},
            borderWidth: 0
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true,
        cutout: '70%',
        plugins: { legend: { display: false } }
    }
});

// Claims Doughnut
const claimsCtx = document.getElementById('claimsDonut').getContext('2d');
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
        cutout: '70%',
        plugins: { legend: { display: false } }
    }
});

// Payment Methods
@if($paymentMethods->isNotEmpty())
const payCtx = document.getElementById('paymentChart').getContext('2d');
new Chart(payCtx, {
    type: 'doughnut',
    data: {
        labels: {!! json_encode($paymentMethods->pluck('payment_method')->map(function($m) { return ucfirst($m ?? 'Unknown'); })) !!},
        datasets: [{
            data: {!! json_encode($paymentMethods->pluck('count')) !!},
            backgroundColor: ['#0d6efd', '#198754', '#ffc107', '#dc3545', '#6f42c1', '#0dcaf0'],
            borderWidth: 0
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true,
        cutout: '65%',
        plugins: { legend: { display: false } }
    }
});
@endif
</script>
@endpush
@endsection

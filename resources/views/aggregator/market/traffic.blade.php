@extends('layouts.dashboard')
@section('dashboard_title', 'Traffic Metrics')
@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Traffic Metrics</h4>
        <p class="text-muted mb-0 small">Referral link clicks and visitor analytics</p>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4 d-flex align-items-center gap-3">
                <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3" style="width:50px;height:50px;display:flex;align-items:center;justify-content:center;"><i class="bi bi-cursor-fill fs-4"></i></div>
                <div>
                    <div class="text-muted small">Total Clicks</div>
                    <div class="fw-bold fs-5">{{ number_format($totalClicks) }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4 d-flex align-items-center gap-3">
                <div class="bg-success bg-opacity-10 text-success rounded-3 p-3" style="width:50px;height:50px;display:flex;align-items:center;justify-content:center;"><i class="bi bi-link-45deg fs-4"></i></div>
                <div>
                    <div class="text-muted small">Active Links</div>
                    <div class="fw-bold fs-5">{{ $totalLinks }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4 d-flex align-items-center gap-3">
                <div class="bg-info bg-opacity-10 text-info rounded-3 p-3" style="width:50px;height:50px;display:flex;align-items:center;justify-content:center;"><i class="bi bi-calendar-month fs-4"></i></div>
                <div>
                    <div class="text-muted small">Clicks This Month</div>
                    <div class="fw-bold fs-5">{{ number_format($clicksThisMonth) }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-white border-0 py-3">
        <h6 class="fw-bold mb-0"><i class="bi bi-graph-up text-primary me-2"></i>Daily Clicks (Last 14 Days)</h6>
    </div>
    <div class="card-body">
        <canvas id="trafficChart" height="120"></canvas>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-0 py-3">
        <h6 class="fw-bold mb-0">Recent Clicks</h6>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">IP Address</th>
                        <th>User Agent</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentClicks as $click)
                    <tr>
                        <td class="ps-4"><code class="small">{{ $click->ip_address ?? '—' }}</code></td>
                        <td class="text-muted small">{{ Str::limit($click->user_agent ?? '—', 60) }}</td>
                        <td class="text-muted small">{{ $click->created_at?->format('M d, Y H:i') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center py-5 text-muted">
                            <i class="bi bi-activity fs-2 d-block mb-2 opacity-25"></i>
                            No click data yet. Share your referral links to start tracking.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
new Chart(document.getElementById('trafficChart').getContext('2d'), {
    type: 'bar',
    data: {
        labels: {!! json_encode($labels) !!},
        datasets: [{
            label: 'Clicks',
            data: {!! json_encode($dailyData) !!},
            backgroundColor: 'rgba(13,110,253,0.7)',
            borderRadius: 4,
        }]
    },
    options: { responsive: true, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } } }
});
</script>
@endpush
@endsection

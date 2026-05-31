@extends('layouts.dashboard')
@section('dashboard_title', 'AI Market Insights')
@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">AI Market Insights</h4>
        <p class="text-muted mb-0 small">Intelligent market analysis and trends</p>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4 d-flex align-items-center gap-3">
                <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3" style="width:50px;height:50px;display:flex;align-items:center;justify-content:center;"><i class="bi bi-shield-check fs-4"></i></div>
                <div>
                    <div class="text-muted small">Total Market Policies</div>
                    <div class="fw-bold fs-5">{{ number_format($totalPolicies) }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4 d-flex align-items-center gap-3">
                <div class="bg-success bg-opacity-10 text-success rounded-3 p-3" style="width:50px;height:50px;display:flex;align-items:center;justify-content:center;"><i class="bi bi-briefcase fs-4"></i></div>
                <div>
                    <div class="text-muted small">Active Brokers</div>
                    <div class="fw-bold fs-5">{{ $totalBrokers }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-0 py-3">
                <h6 class="fw-bold mb-0"><i class="bi bi-bar-chart-fill text-primary me-2"></i>Top Products by Market Share</h6>
            </div>
            <div class="card-body">
                @forelse($topProducts as $product)
                @php $maxCount = $topProducts->first()->customer_policies_count ?: 1; @endphp
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-2 me-3 flex-shrink-0" style="width:38px;height:38px;display:flex;align-items:center;justify-content:center;"><i class="bi bi-shield-fill small"></i></div>
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="fw-bold small">{{ $product->product_name }}</span>
                            <span class="small text-muted">{{ $product->customer_policies_count }} policies</span>
                        </div>
                        <div class="progress" style="height:6px;">
                            <div class="progress-bar bg-primary" style="width:{{ ($product->customer_policies_count / $maxCount) * 100 }}%"></div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-4 text-muted"><i class="bi bi-bar-chart fs-2 d-block mb-2 opacity-25"></i>No data available.</div>
                @endforelse
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-0 py-3">
                <h6 class="fw-bold mb-0"><i class="bi bi-graph-up text-success me-2"></i>Commission Trend (6 Months)</h6>
            </div>
            <div class="card-body">
                <canvas id="commChart" height="200"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-0 py-3">
        <h6 class="fw-bold mb-0"><i class="bi bi-lightbulb text-warning me-2"></i>AI Recommendations</h6>
    </div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-4">
                <div class="border rounded-3 p-3 border-primary border-opacity-25 bg-primary bg-opacity-5">
                    <i class="bi bi-arrow-up-circle text-primary fs-4 mb-2 d-block"></i>
                    <h6 class="fw-bold">Expand Distribution</h6>
                    <p class="small text-muted mb-0">Onboard more brokers in underserved regions to capture untapped market segments.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="border rounded-3 p-3 border-warning border-opacity-25 bg-warning bg-opacity-5">
                    <i class="bi bi-graph-up text-warning fs-4 mb-2 d-block"></i>
                    <h6 class="fw-bold">Product Gap</h6>
                    <p class="small text-muted mb-0">Micro-insurance and health products show highest demand growth — consider promoting these.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="border rounded-3 p-3 border-success border-opacity-25 bg-success bg-opacity-5">
                    <i class="bi bi-people text-success fs-4 mb-2 d-block"></i>
                    <h6 class="fw-bold">Lead Quality</h6>
                    <p class="small text-muted mb-0">Focus referral campaigns on high-intent customers — they convert 3x more than broad traffic.</p>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
new Chart(document.getElementById('commChart').getContext('2d'), {
    type: 'line',
    data: {
        labels: {!! json_encode($labels) !!},
        datasets: [{ label: 'Commission (TZS)', data: {!! json_encode($monthlyData) !!}, borderColor: '#198754', backgroundColor: 'rgba(25,135,84,0.1)', tension: 0.4, fill: true }]
    },
    options: { responsive: true, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true } } }
});
</script>
@endpush
@endsection

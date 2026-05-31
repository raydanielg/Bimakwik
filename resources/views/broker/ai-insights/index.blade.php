@extends('layouts.dashboard')
@section('dashboard_title', 'AI Sales Insights')
@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">AI Sales Insights</h4>
        <p class="text-muted mb-0 small">Intelligent analysis of your sales performance</p>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-0 py-3">
                <h6 class="fw-bold mb-0"><i class="bi bi-bar-chart-fill text-primary me-2"></i>Top Products by Policies</h6>
            </div>
            <div class="card-body">
                @forelse($topProducts as $product)
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-2 me-3" style="width:40px;height:40px;display:flex;align-items:center;justify-content:center;">
                        <i class="bi bi-shield-fill"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="fw-bold small">{{ $product->product_name }}</span>
                            <span class="small text-muted">{{ $product->policies_count }} policies</span>
                        </div>
                        @php $maxCount = $topProducts->first()->policies_count ?: 1; @endphp
                        <div class="progress" style="height:6px;">
                            <div class="progress-bar bg-primary" style="width:{{ ($product->policies_count / $maxCount) * 100 }}%"></div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-4 text-muted">
                    <i class="bi bi-bar-chart fs-2 d-block mb-2 opacity-25"></i>
                    No product data available yet.
                </div>
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
                <canvas id="commissionChart" height="200"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 py-3">
                <h6 class="fw-bold mb-0"><i class="bi bi-lightbulb text-warning me-2"></i>AI Recommendations</h6>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="border rounded-3 p-3 h-100 border-primary border-opacity-25 bg-primary bg-opacity-5">
                            <i class="bi bi-arrow-up-circle text-primary fs-4 mb-2 d-block"></i>
                            <h6 class="fw-bold">Upsell Opportunity</h6>
                            <p class="small text-muted mb-0">Focus on customers with single policies — offer bundled products to increase premium value.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="border rounded-3 p-3 h-100 border-warning border-opacity-25 bg-warning bg-opacity-5">
                            <i class="bi bi-clock text-warning fs-4 mb-2 d-block"></i>
                            <h6 class="fw-bold">Renewal Reminder</h6>
                            <p class="small text-muted mb-0">Policies expiring within 30 days need immediate attention to maintain your commission stream.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="border rounded-3 p-3 h-100 border-success border-opacity-25 bg-success bg-opacity-5">
                            <i class="bi bi-people text-success fs-4 mb-2 d-block"></i>
                            <h6 class="fw-bold">Customer Retention</h6>
                            <p class="small text-muted mb-0">Reach out to inactive customers — re-engagement campaigns boost retention by up to 25%.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('commissionChart').getContext('2d');
new Chart(ctx, {
    type: 'line',
    data: {
        labels: {!! json_encode($labels) !!},
        datasets: [{
            label: 'Commission (TZS)',
            data: {!! json_encode($monthlyCommissions) !!},
            borderColor: '#198754',
            backgroundColor: 'rgba(25,135,84,0.1)',
            tension: 0.4,
            fill: true,
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: { y: { beginAtZero: true } }
    }
});
</script>
@endpush
@endsection

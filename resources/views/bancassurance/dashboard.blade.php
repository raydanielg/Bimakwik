@extends('layouts.dashboard')

@section('dashboard_title', 'Bancassurance Dashboard')

@section('dashboard_content')
<!-- Quick Stats -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <small class="text-muted">Total Sales</small>
                        <h5 class="fw-bold mb-0">TZS {{ number_format($totalSales / 1000000, 1) }}M</h5>
                    </div>
                    <div class="bg-primary bg-opacity-10 rounded-circle p-2">
                        <i class="bi bi-cash-stack text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <small class="text-muted">My Commission</small>
                        <h5 class="fw-bold mb-0">TZS {{ number_format($totalCommission / 1000000, 1) }}M</h5>
                    </div>
                    <div class="bg-success bg-opacity-10 rounded-circle p-2">
                        <i class="bi bi-wallet text-success"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <small class="text-muted">Policies Sold</small>
                        <h5 class="fw-bold mb-0">{{ $policiesSold }}</h5>
                    </div>
                    <div class="bg-info bg-opacity-10 rounded-circle p-2">
                        <i class="bi bi-file-earmark-text text-info"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <small class="text-muted">Pending Renewals</small>
                        <h5 class="fw-bold mb-0">{{ $pendingRenewals }}</h5>
                    </div>
                    <div class="bg-warning bg-opacity-10 rounded-circle p-2">
                        <i class="bi bi-clock-history text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Sales Trend Chart -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h6 class="fw-bold mb-0">Sales Trend</h6>
                        <small class="text-muted">Track your sales performance over time</small>
                    </div>
                    <div class="btn-group btn-group-sm">
                        <button class="btn btn-outline-primary active" onclick="updateChartPeriod('weekly')">Weekly</button>
                        <button class="btn btn-outline-primary" onclick="updateChartPeriod('monthly')">Monthly</button>
                        <button class="btn btn-outline-primary" onclick="updateChartPeriod('yearly')">Yearly</button>
                    </div>
                </div>
                <div style="height: 350px; position: relative;">
                    <canvas id="salesTrendChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity -->
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-3">Recent Activity</h6>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Activity</th>
                                <th>Customer</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Motor Insurance Sale</td>
                                <td>Hamis Juma</td>
                                <td>TZS 450,000</td>
                                <td>Today, 09:15 AM</td>
                                <td><span class="badge bg-success">Completed</span></td>
                            </tr>
                            <tr>
                                <td>Life Insurance Sale</td>
                                <td>Sarah Peter</td>
                                <td>TZS 280,000</td>
                                <td>Yesterday</td>
                                <td><span class="badge bg-warning">Pending</span></td>
                            </tr>
                            <tr>
                                <td>Health Insurance Sale</td>
                                <td>David Omondi</td>
                                <td>TZS 120,000</td>
                                <td>2 days ago</td>
                                <td><span class="badge bg-success">Completed</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
let salesTrendChart;

// Initialize Sales Trend Chart
window.addEventListener('load', function() {
    setTimeout(function() {
        if (typeof Chart === 'undefined') {
            console.error('Chart.js is not loaded');
            return;
        }

        const canvas = document.getElementById('salesTrendChart');
        if (!canvas) {
            console.error('Canvas element not found');
            return;
        }

        try {
            const ctx = canvas.getContext('2d');
            
            // Create gradient fill
            const gradient = ctx.createLinearGradient(0, 0, 0, 350);
            gradient.addColorStop(0, 'rgba(13, 110, 253, 0.3)');
            gradient.addColorStop(1, 'rgba(13, 110, 253, 0.0)');

            salesTrendChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($weeklyLabels) !!},
                    datasets: [{
                        label: 'Sales (Millions TZS)',
                        data: {!! json_encode($weeklySales) !!},
                        borderColor: '#0d6efd',
                        backgroundColor: gradient,
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#0d6efd',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 3,
                        pointRadius: 6,
                        pointHoverRadius: 8,
                        pointHoverBackgroundColor: '#0d6efd',
                        pointHoverBorderColor: '#fff',
                        pointHoverBorderWidth: 3
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        intersect: false,
                        mode: 'index'
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                            align: 'end',
                            labels: {
                                font: {
                                    size: 13,
                                    weight: '500'
                                },
                                usePointStyle: true,
                                padding: 20
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            titleFont: {
                                size: 14,
                                weight: 'bold'
                            },
                            bodyFont: {
                                size: 13
                            },
                            padding: 12,
                            cornerRadius: 8,
                            displayColors: true,
                            callbacks: {
                                label: function(context) {
                                    return 'Sales: TZS ' + context.parsed.y + 'M';
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)',
                                drawBorder: false
                            },
                            ticks: {
                                font: {
                                    size: 12
                                },
                                callback: function(value) {
                                    return 'TZS ' + value + 'M';
                                },
                                padding: 10
                            },
                            border: {
                                display: false
                            }
                        },
                        x: {
                            grid: {
                                display: false,
                                drawBorder: false
                            },
                            ticks: {
                                font: {
                                    size: 12,
                                    weight: '500'
                                },
                                padding: 10
                            },
                            border: {
                                display: false
                            }
                        }
                    }
                }
            });
        } catch (error) {
            console.error('Error creating line chart:', error);
        }
    }, 500);
});

// Update chart based on period
function updateChartPeriod(period) {
    // Update active button
    const buttons = document.querySelectorAll('.btn-group .btn');
    buttons.forEach(btn => btn.classList.remove('active'));
    event.target.classList.add('active');

    // Update chart data based on period
    let labels, data;
    
    if (period === 'weekly') {
        labels = {!! json_encode($weeklyLabels) !!};
        data = {!! json_encode($weeklySales) !!};
    } else if (period === 'monthly') {
        labels = {!! json_encode($monthlyLabels) !!};
        data = {!! json_encode($monthlySales) !!};
    } else if (period === 'yearly') {
        labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        data = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    }

    salesTrendChart.data.labels = labels;
    salesTrendChart.data.datasets[0].data = data;
    salesTrendChart.update('active');
}
</script>
@endpush
@endsection

@extends('layouts.dashboard')

@section('dashboard_title', 'Performance')

@push('styles')
<style>
    .modal-backdrop {
        background-color: rgba(0, 0, 0, 0.5);
    }
    .modal-content {
        border: none;
        border-radius: 12px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
    }
    .modal-header {
        border-bottom: 1px solid #e9ecef;
        padding: 1.5rem;
    }
    .modal-body {
        padding: 1.5rem;
    }
    .modal-footer {
        border-top: 1px solid #e9ecef;
        padding: 1.5rem;
    }
    .form-label {
        font-weight: 500;
        color: #495057;
        margin-bottom: 0.5rem;
    }
    .form-control, .form-select {
        border: 1px solid #dee2e6;
        padding: 0.75rem;
        border-radius: 8px;
    }
    .form-control:focus, .form-select:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15);
    }
    
    /* Chart Containers */
    .chart-container {
        position: relative;
        height: 300px;
        margin-bottom: 1rem;
        background: #fff;
        border-radius: 8px;
        padding: 10px;
    }
    
    .chart-container canvas {
        max-height: 100%;
        max-width: 100%;
    }
    
    /* Progress Bar Styles */
    .progress {
        height: 25px;
        border-radius: 12px;
        background-color: #e9ecef;
    }
    
    .progress-bar {
        font-weight: 600;
        font-size: 0.85rem;
        line-height: 25px;
    }
    
    /* Card Hover Effects */
    .card {
        transition: transform 0.2s, box-shadow 0.2s;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }
</style>
@endpush

@section('dashboard_content')
<!-- Header -->
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h5 class="fw-bold mb-1"><i class="bi bi-graph-up me-2"></i>Performance</h5>
                <p class="text-muted small mb-0">Track performance metrics and analytics</p>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-outline-primary btn-sm" onclick="exportData()">
                    <i class="bi bi-download me-2"></i>Export
                </button>
                <div class="dropdown">
                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="bi bi-calendar me-2"></i><span id="currentPeriod">This Month</span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#" onclick="changePeriod('This Month')">This Month</a></li>
                        <li><a class="dropdown-item" href="#" onclick="changePeriod('Last Month')">Last Month</a></li>
                        <li><a class="dropdown-item" href="#" onclick="changePeriod('Last 3 Months')">Last 3 Months</a></li>
                        <li><a class="dropdown-item" href="#" onclick="changePeriod('Last 6 Months')">Last 6 Months</a></li>
                        <li><a class="dropdown-item" href="#" onclick="changePeriod('This Year')">This Year</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#" onclick="changePeriod('Custom Range')">Custom Range</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Performance Stats -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <small class="text-muted">Total Revenue</small>
                        <h5 class="fw-bold mb-0">TZS 45.8M</h5>
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
                        <small class="text-muted">Growth</small>
                        <h5 class="fw-bold mb-0">+18.2%</h5>
                    </div>
                    <div class="bg-success bg-opacity-10 rounded-circle p-2">
                        <i class="bi bi-arrow-up text-success"></i>
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
                        <small class="text-muted">Conversion Rate</small>
                        <h5 class="fw-bold mb-0">68.7%</h5>
                    </div>
                    <div class="bg-info bg-opacity-10 rounded-circle p-2">
                        <i class="bi bi-graph-up text-info"></i>
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
                        <small class="text-muted">Target Achievement</small>
                        <h5 class="fw-bold mb-0">92%</h5>
                    </div>
                    <div class="bg-warning bg-opacity-10 rounded-circle p-2">
                        <i class="bi bi-trophy text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Charts Section -->
<div class="row g-3 mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold mb-0">Analytics Charts</h6>
                    <div class="btn-group btn-group-sm">
                        <button class="btn btn-outline-primary active" onclick="switchChart('pie')">
                            <i class="bi bi-pie-chart me-1"></i>Sales by Product
                        </button>
                        <button class="btn btn-outline-primary" onclick="switchChart('doughnut')">
                            <i class="bi bi-pie-chart-fill me-1"></i>Revenue Distribution
                        </button>
                    </div>
                </div>
                <div class="chart-container" id="pieChartContainer">
                    <h6 class="fw-bold mb-3 text-center">Sales by Product Type</h6>
                    <canvas id="pieChart"></canvas>
                </div>
                <div class="chart-container" id="doughnutChartContainer" style="display: none;">
                    <h6 class="fw-bold mb-3 text-center">Revenue Distribution</h6>
                    <canvas id="doughnutChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Progress Bars Section -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body p-4">
        <h6 class="fw-bold mb-3">Target Achievement by Branch</h6>
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="d-flex justify-content-between mb-1">
                    <span class="fw-semibold">Branch A</span>
                    <span class="text-primary fw-bold">95%</span>
                </div>
                <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 95%">95%</div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="d-flex justify-content-between mb-1">
                    <span class="fw-semibold">Branch B</span>
                    <span class="text-primary fw-bold">90%</span>
                </div>
                <div class="progress">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: 90%">90%</div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="d-flex justify-content-between mb-1">
                    <span class="fw-semibold">Branch C</span>
                    <span class="text-primary fw-bold">88%</span>
                </div>
                <div class="progress">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 88%">88%</div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="d-flex justify-content-between mb-1">
                    <span class="fw-semibold">Branch D</span>
                    <span class="text-primary fw-bold">82%</span>
                </div>
                <div class="progress">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 82%">82%</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Performance Table -->
<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="fw-bold mb-0">Branch Performance</h6>
            <div class="input-group" style="width: 250px;">
                <span class="input-group-text bg-light border-0">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text" class="form-control border-0 bg-light" placeholder="Search branches...">
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Branch</th>
                        <th>Sales</th>
                        <th>Policies</th>
                        <th>Commission</th>
                        <th>Conversion</th>
                        <th>Target</th>
                        <th>Rank</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Branch A</strong></td>
                        <td>TZS 18.5M</td>
                        <td>62</td>
                        <td>TZS 1.85M</td>
                        <td>72.3%</td>
                        <td><span class="badge bg-success">95%</span></td>
                        <td><span class="badge bg-primary">#1</span></td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary edit-branch-btn" data-branch="Branch A" data-sales="18.5" data-policies="62" data-commission="1.85" data-conversion="72.3" data-target="95" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Branch B</strong></td>
                        <td>TZS 15.2M</td>
                        <td>48</td>
                        <td>TZS 1.52M</td>
                        <td>68.5%</td>
                        <td><span class="badge bg-success">90%</span></td>
                        <td><span class="badge bg-secondary">#2</span></td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary edit-branch-btn" data-branch="Branch B" data-sales="15.2" data-policies="48" data-commission="1.52" data-conversion="68.5" data-target="90" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Branch C</strong></td>
                        <td>TZS 12.1M</td>
                        <td>46</td>
                        <td>TZS 1.21M</td>
                        <td>65.2%</td>
                        <td><span class="badge bg-warning">88%</span></td>
                        <td><span class="badge bg-secondary">#3</span></td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary edit-branch-btn" data-branch="Branch C" data-sales="12.1" data-policies="46" data-commission="1.21" data-conversion="65.2" data-target="88" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Edit Branch Performance Modal -->
<div class="modal fade" id="editBranchModal" tabindex="-1" aria-labelledby="editBranchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="editBranchModalLabel">
                    <i class="bi bi-pencil me-2"></i>Edit Branch Performance
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editBranchForm">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="branchName" class="form-label">Branch Name</label>
                            <input type="text" class="form-control" id="branchName" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="branchSales" class="form-label">Sales (Millions TZS)</label>
                            <input type="number" class="form-control" id="branchSales" step="0.1" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="branchPolicies" class="form-label">Policies</label>
                            <input type="number" class="form-control" id="branchPolicies" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="branchCommission" class="form-label">Commission (Millions TZS)</label>
                            <input type="number" class="form-control" id="branchCommission" step="0.01" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="branchConversion" class="form-label">Conversion Rate (%)</label>
                            <input type="number" class="form-control" id="branchConversion" step="0.1" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="branchTarget" class="form-label">Target Achievement (%)</label>
                            <input type="number" class="form-control" id="branchTarget" step="1" required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="saveBranchPerformance()">
                    <i class="bi bi-check-lg me-2"></i>Save Changes
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Custom Date Range Modal -->
<div class="modal fade" id="customDateRangeModal" tabindex="-1" aria-labelledby="customDateRangeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="customDateRangeModalLabel">
                    <i class="bi bi-calendar-range me-2"></i>Custom Date Range
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="customDateRangeForm">
                    <div class="mb-3">
                        <label for="startDate" class="form-label">Start Date</label>
                        <input type="date" class="form-control" id="startDate" required>
                    </div>
                    <div class="mb-3">
                        <label for="endDate" class="form-label">End Date</label>
                        <input type="date" class="form-control" id="endDate" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="applyCustomRange()">
                    <i class="bi bi-check-lg me-2"></i>Apply
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
let pieChart, doughnutChart;
let currentEditingBranch = null;

// Initialize Charts
function initCharts() {
    // Check if Chart.js is loaded
    if (typeof Chart === 'undefined') {
        console.error('Chart.js is not loaded');
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Chart library failed to load. Please refresh the page.',
            confirmButtonColor: '#dc3545'
        });
        return;
    }

    // Check if canvas elements exist
    const pieCanvas = document.getElementById('pieChart');
    const doughnutCanvas = document.getElementById('doughnutChart');
    
    if (!pieCanvas || !doughnutCanvas) {
        console.error('Canvas elements not found');
        return;
    }

    // Pie Chart - Sales by Product Type
    try {
        const pieCtx = pieCanvas.getContext('2d');
        pieChart = new Chart(pieCtx, {
            type: 'pie',
            data: {
                labels: ['Motor', 'Life', 'Health', 'Home', 'Travel', 'Business'],
                datasets: [{
                    data: [35, 25, 20, 10, 5, 5],
                    backgroundColor: [
                        '#0d6efd',
                        '#198754',
                        '#0dcaf0',
                        '#ffc107',
                        '#dc3545',
                        '#6c757d'
                    ],
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            usePointStyle: true,
                            font: {
                                size: 12
                            }
                        }
                    }
                }
            }
        });
    } catch (error) {
        console.error('Error creating pie chart:', error);
    }

    // Doughnut Chart - Revenue Distribution
    try {
        const doughnutCtx = doughnutCanvas.getContext('2d');
        doughnutChart = new Chart(doughnutCtx, {
            type: 'doughnut',
            data: {
                labels: ['Branch A', 'Branch B', 'Branch C', 'Branch D'],
                datasets: [{
                    data: [40, 30, 20, 10],
                    backgroundColor: [
                        '#0d6efd',
                        '#198754',
                        '#ffc107',
                        '#0dcaf0'
                    ],
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            usePointStyle: true,
                            font: {
                                size: 12
                            }
                        }
                    }
                },
                cutout: '60%'
            }
        });
    } catch (error) {
        console.error('Error creating doughnut chart:', error);
    }
}

// Change Period Filter
function changePeriod(period) {
    document.getElementById('currentPeriod').textContent = period;
    
    if (period === 'Custom Range') {
        const modal = new bootstrap.Modal(document.getElementById('customDateRangeModal'));
        modal.show();
    } else {
        // Update charts with new data based on period
        updateChartsForPeriod(period);
        
        Swal.fire({
            icon: 'success',
            title: 'Period Updated',
            text: `Showing data for ${period}`,
            timer: 1500,
            showConfirmButton: false,
            confirmButtonColor: '#0d6efd'
        });
    }
}

// Update Charts for Period
function updateChartsForPeriod(period) {
    // Simulate data changes based on period
    const multiplier = period === 'Last Month' ? 0.9 : 
                      period === 'Last 3 Months' ? 0.85 :
                      period === 'Last 6 Months' ? 0.8 :
                      period === 'This Year' ? 0.75 : 1;
    
    pieChart.data.datasets[0].data = pieChart.data.datasets[0].data.map(v => v * multiplier);
    pieChart.update();
    
    doughnutChart.data.datasets[0].data = doughnutChart.data.datasets[0].data.map(v => v * multiplier);
    doughnutChart.update();
}

// Apply Custom Date Range
function applyCustomRange() {
    const startDate = document.getElementById('startDate').value;
    const endDate = document.getElementById('endDate').value;
    
    if (!startDate || !endDate) {
        Swal.fire({
            icon: 'error',
            title: 'Validation Error',
            text: 'Please select both start and end dates',
            confirmButtonColor: '#dc3545'
        });
        return;
    }
    
    const modal = bootstrap.Modal.getInstance(document.getElementById('customDateRangeModal'));
    modal.hide();
    
    document.getElementById('currentPeriod').textContent = `${startDate} to ${endDate}`;
    
    updateChartsForPeriod('Custom Range');
    
    Swal.fire({
        icon: 'success',
        title: 'Date Range Applied',
        text: `Showing data from ${startDate} to ${endDate}`,
        timer: 1500,
        showConfirmButton: false,
        confirmButtonColor: '#0d6efd'
    });
}

// Export Data
function exportData() {
    Swal.fire({
        title: 'Exporting...',
        text: 'Please wait while we export the data',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
    
    setTimeout(() => {
        Swal.fire({
            icon: 'success',
            title: 'Exported!',
            text: 'Performance data has been exported successfully',
            confirmButtonColor: '#0d6efd'
        });
    }, 1500);
}

// Edit Branch Performance
function editBranch(branch) {
    currentEditingBranch = branch;
    
    const btn = document.querySelector(`[data-branch="${branch}"]`);
    document.getElementById('branchName').value = branch;
    document.getElementById('branchSales').value = btn.getAttribute('data-sales');
    document.getElementById('branchPolicies').value = btn.getAttribute('data-policies');
    document.getElementById('branchCommission').value = btn.getAttribute('data-commission');
    document.getElementById('branchConversion').value = btn.getAttribute('data-conversion');
    document.getElementById('branchTarget').value = btn.getAttribute('data-target');
    
    const modal = new bootstrap.Modal(document.getElementById('editBranchModal'));
    modal.show();
}

// Save Branch Performance
function saveBranchPerformance() {
    const sales = document.getElementById('branchSales').value;
    const policies = document.getElementById('branchPolicies').value;
    const commission = document.getElementById('branchCommission').value;
    const conversion = document.getElementById('branchConversion').value;
    const target = document.getElementById('branchTarget').value;
    
    if (!sales || !policies || !commission || !conversion || !target) {
        Swal.fire({
            icon: 'error',
            title: 'Validation Error',
            text: 'Please fill in all fields',
            confirmButtonColor: '#dc3545'
        });
        return;
    }
    
    Swal.fire({
        title: 'Saving...',
        text: 'Please wait while we save the changes',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
    
    setTimeout(() => {
        const modal = bootstrap.Modal.getInstance(document.getElementById('editBranchModal'));
        modal.hide();
        
        // Update table row
        const btn = document.querySelector(`[data-branch="${currentEditingBranch}"]`);
        const row = btn.closest('tr');
        row.children[1].textContent = `TZS ${sales}M`;
        row.children[2].textContent = policies;
        row.children[3].textContent = `TZS ${commission}M`;
        row.children[4].textContent = `${conversion}%`;
        
        // Update target badge
        const targetBadge = row.children[5].querySelector('.badge');
        targetBadge.textContent = `${target}%`;
        targetBadge.className = `badge ${target >= 90 ? 'bg-success' : target >= 80 ? 'bg-warning' : 'bg-danger'}`;
        
        // Update button data attributes
        btn.setAttribute('data-sales', sales);
        btn.setAttribute('data-policies', policies);
        btn.setAttribute('data-commission', commission);
        btn.setAttribute('data-conversion', conversion);
        btn.setAttribute('data-target', target);
        
        Swal.fire({
            icon: 'success',
            title: 'Saved!',
            text: `${currentEditingBranch} performance has been updated successfully`,
            confirmButtonColor: '#0d6efd'
        });
    }, 1500);
}

// Attach Event Listeners
function attachEventListeners() {
    document.querySelectorAll('.edit-branch-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const branch = this.getAttribute('data-branch');
            editBranch(branch);
        });
    });
}

// Initialize on page load
window.addEventListener('load', function() {
    // Small delay to ensure Chart.js is fully loaded
    setTimeout(function() {
        initCharts();
        attachEventListeners();
    }, 500);
});
</script>
@endpush
@endsection

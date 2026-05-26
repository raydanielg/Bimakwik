@extends('layouts.dashboard')

@section('content')
<div class="container-fluid py-4">
    @include('insurer._partials.page-header', [
        'title' => 'Partner Performance',
        'subtitle' => 'Track performance metrics for brokers and agents',
        'icon' => 'bi-graph-up-arrow'
    ])

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-file-earmark-text-fill text-primary fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Total Policies</h6>
                            <h4 class="mb-0 fw-bold">0</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-success bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-currency-dollar text-success fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Total Premium</h6>
                            <h4 class="mb-0 fw-bold">TZS 0</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-warning bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-percent text-warning fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Avg Conversion</h6>
                            <h4 class="mb-0 fw-bold">0%</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-info bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-trophy-fill text-info fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Top Performer</h6>
                            <h4 class="mb-0 fw-bold">-</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0">Top 5 Brokers</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Rank</th>
                                    <th>Name</th>
                                    <th>Policies</th>
                                    <th>Premium</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><span class="badge bg-warning text-dark">1</span></td>
                                    <td>-</td>
                                    <td>0</td>
                                    <td>TZS 0</td>
                                </tr>
                                <tr>
                                    <td><span class="badge bg-secondary">2</span></td>
                                    <td>-</td>
                                    <td>0</td>
                                    <td>TZS 0</td>
                                </tr>
                                <tr>
                                    <td><span class="badge bg-secondary">3</span></td>
                                    <td>-</td>
                                    <td>0</td>
                                    <td>TZS 0</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0">Top 5 Agents</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Rank</th>
                                    <th>Name</th>
                                    <th>Policies</th>
                                    <th>Premium</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><span class="badge bg-warning text-dark">1</span></td>
                                    <td>-</td>
                                    <td>0</td>
                                    <td>TZS 0</td>
                                </tr>
                                <tr>
                                    <td><span class="badge bg-secondary">2</span></td>
                                    <td>-</td>
                                    <td>0</td>
                                    <td>TZS 0</td>
                                </tr>
                                <tr>
                                    <td><span class="badge bg-secondary">3</span></td>
                                    <td>-</td>
                                    <td>0</td>
                                    <td>TZS 0</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Performance Details</h5>
                <div class="btn-group btn-group-sm">
                    <button class="btn btn-outline-primary"><i class="bi bi-download me-1"></i> Export</button>
                    <button class="btn btn-outline-secondary"><i class="bi bi-funnel me-1"></i> Filter</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            @include('insurer._partials.empty-state', [
                'icon' => 'bi-graph-up-arrow',
                'title' => 'No Performance Data',
                'text' => 'Performance data will appear once policies are sold through partners.'
            ])
        </div>
    </div>
</div>
@endsection

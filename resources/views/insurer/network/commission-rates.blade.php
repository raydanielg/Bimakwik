@extends('layouts.dashboard')

@section('content')
<div class="container-fluid py-4">
    @include('insurer._partials.page-header', [
        'title' => 'Commission Rates',
        'subtitle' => 'Configure commission rates for brokers and agents',
        'icon' => 'bi-percent'
    ])

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-briefcase-fill text-primary fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Broker Commission</h6>
                            <h4 class="mb-0 fw-bold">15%</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-success bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-person-badge-fill text-success fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">SFE Commission</h6>
                            <h4 class="mb-0 fw-bold">10%</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-info bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-bank-fill text-info fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Bancassurance</h6>
                            <h4 class="mb-0 fw-bold">12%</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white border-0 py-3">
            <h5 class="mb-0">Commission Configuration</h5>
        </div>
        <div class="card-body">
            <form>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Partner Type</label>
                        <select class="form-select">
                            <option>Broker</option>
                            <option>SFE</option>
                            <option>Bancassurance</option>
                            <option>Aggregator</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Product Category</label>
                        <select class="form-select">
                            <option>All Products</option>
                            <option>Motor Insurance</option>
                            <option>Health Insurance</option>
                            <option>Life Insurance</option>
                            <option>Property Insurance</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">First Year Rate (%)</label>
                        <input type="number" class="form-control" placeholder="e.g. 15" step="0.1">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Renewal Rate (%)</label>
                        <input type="number" class="form-control" placeholder="e.g. 10" step="0.1">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Status</label>
                        <select class="form-select">
                            <option>Active</option>
                            <option>Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> Save Configuration
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3">
            <h5 class="mb-0">Existing Commission Rates</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Partner Type</th>
                            <th>Product Category</th>
                            <th>First Year</th>
                            <th>Renewal</th>
                            <th>Effective Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class="badge bg-primary">Broker</span></td>
                            <td>All Products</td>
                            <td>15%</td>
                            <td>10%</td>
                            <td>Jan 1, 2024</td>
                            <td><span class="badge bg-success">Active</span></td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <button class="btn btn-outline-primary"><i class="bi bi-pencil"></i></button>
                                    <button class="btn btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="badge bg-success">SFE</span></td>
                            <td>All Products</td>
                            <td>10%</td>
                            <td>8%</td>
                            <td>Jan 1, 2024</td>
                            <td><span class="badge bg-success">Active</span></td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <button class="btn btn-outline-primary"><i class="bi bi-pencil"></i></button>
                                    <button class="btn btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="badge bg-info">Bancassurance</span></td>
                            <td>All Products</td>
                            <td>12%</td>
                            <td>9%</td>
                            <td>Jan 1, 2024</td>
                            <td><span class="badge bg-success">Active</span></td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <button class="btn btn-outline-primary"><i class="bi bi-pencil"></i></button>
                                    <button class="btn btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

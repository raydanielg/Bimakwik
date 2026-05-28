@extends('layouts.dashboard')

@section('dashboard_content')
<div class="container-fluid py-4">
    @include('aggregator._partials.page-header', [
        'title' => 'Brokers',
        'subtitle' => 'Manage all insurance brokers',
        'icon' => 'bi-briefcase-fill'
    ])

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-people-fill text-primary fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Total Brokers</h6>
                            <h4 class="mb-0 fw-bold">{{ $brokers->total() ?? 0 }}</h4>
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
                            <i class="bi bi-check-circle-fill text-success fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Active</h6>
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
                        <div class="bg-info bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-file-earmark-text-fill text-info fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Policies Sold</h6>
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
                        <div class="bg-warning bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-currency-dollar text-warning fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Commissions</h6>
                            <h4 class="mb-0 fw-bold">TZS 0</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">All Brokers</h5>
                <button class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-lg me-1"></i> Add Broker
                </button>
            </div>
        </div>
        <div class="card-body">
            @if($brokers->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Name</th>
                                <th>Company</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Region</th>
                                <th>Policies</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($brokers as $broker)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px;">
                                                <i class="bi bi-person-fill text-muted"></i>
                                            </div>
                                            <div>
                                                <div class="fw-bold">{{ $broker->name ?? 'N/A' }}</div>
                                                <small class="text-muted">ID: {{ $broker->id ?? '-' }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $broker->brokerProfile->company_name ?? 'N/A' }}</td>
                                    <td>{{ $broker->email ?? 'N/A' }}</td>
                                    <td>{{ $broker->phone ?? 'N/A' }}</td>
                                    <td>{{ $broker->brokerProfile->region ?? 'N/A' }}</td>
                                    <td>{{ $broker->policies_count ?? 0 }}</td>
                                    <td>
                                        @if($broker->status === 'active')
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <button class="btn btn-outline-primary"><i class="bi bi-eye"></i></button>
                                            <button class="btn btn-outline-secondary"><i class="bi bi-pencil"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $brokers->links() }}
            @else
                @include('aggregator._partials.empty-state', [
                    'icon' => 'bi-briefcase-fill',
                    'title' => 'No Brokers Found',
                    'text' => 'There are no brokers registered yet.'
                ])
            @endif
        </div>
    </div>
</div>
@endsection


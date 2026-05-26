@extends('layouts.dashboard')

@section('content')
<div class="container-fluid py-4">
    @include('aggregator._partials.page-header', [
        'title' => 'Agents',
        'subtitle' => 'Manage SFEs and Bancassurance agents',
        'icon' => 'bi-person-badge-fill'
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
                            <h6 class="mb-0 text-muted">Total Agents</h6>
                            <h4 class="mb-0 fw-bold">{{ $agents->total() ?? 0 }}</h4>
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
                <h5 class="mb-0">All Agents</h5>
                <button class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-lg me-1"></i> Add Agent
                </button>
            </div>
        </div>
        <div class="card-body">
            @if($agents->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Region</th>
                                <th>Policies</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($agents as $agent)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px;">
                                                <i class="bi bi-person-fill text-muted"></i>
                                            </div>
                                            <div>
                                                <div class="fw-bold">{{ $agent->name ?? 'N/A' }}</div>
                                                <small class="text-muted">ID: {{ $agent->id ?? '-' }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if($agent->hasRole('sfe'))
                                            <span class="badge bg-primary">SFE</span>
                                        @elseif($agent->hasRole('bancassurance'))
                                            <span class="badge bg-info">Bancassurance</span>
                                        @else
                                            <span class="badge bg-secondary">Unknown</span>
                                        @endif
                                    </td>
                                    <td>{{ $agent->email ?? 'N/A' }}</td>
                                    <td>{{ $agent->phone ?? 'N/A' }}</td>
                                    <td>{{ $agent->agentProfile->region ?? 'N/A' }}</td>
                                    <td>{{ $agent->policies_count ?? 0 }}</td>
                                    <td>
                                        @if($agent->status === 'active')
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
                {{ $agents->links() }}
            @else
                @include('aggregator._partials.empty-state', [
                    'icon' => 'bi-person-badge-fill',
                    'title' => 'No Agents Found',
                    'text' => 'There are no agents registered yet.'
                ])
            @endif
        </div>
    </div>
</div>
@endsection

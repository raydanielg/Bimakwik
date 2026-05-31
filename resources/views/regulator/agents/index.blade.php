@extends('layouts.dashboard')

@section('content')
<div class="container-fluid py-4">
    @include('regulator._partials.page-header', [
        'title' => 'Registered Agents',
        'subtitle' => 'View and manage registered insurance agents (SFE/Bancassurance)',
        'icon' => 'bi-people'
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
                        <div class="bg-warning bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-clock-fill text-warning fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Pending Review</h6>
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
                        <div class="bg-danger bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-x-circle-fill text-danger fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Suspended</h6>
                            <h4 class="mb-0 fw-bold">0</h4>
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
                    <i class="bi bi-plus-lg me-1"></i> Register New Agent
                </button>
            </div>
        </div>
        <div class="card-body">
            @if($agents->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Agent Name</th>
                                <th>Type</th>
                                <th>Email</th>
                                <th>Policies</th>
                                <th>Registration Date</th>
                                <th>License Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($agents as $agent)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px;">
                                                <i class="bi bi-person text-muted"></i>
                                            </div>
                                            <div>
                                                <div class="fw-bold">{{ $agent->name ?? 'N/A' }}</div>
                                                <small class="text-muted">ID: {{ $agent->id ?? '-' }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $agent->roles->first()->name ?? 'N/A' }}</td>
                                    <td>{{ $agent->email ?? 'N/A' }}</td>
                                    <td>{{ $agent->customer_policies_count ?? 0 }}</td>
                                    <td>{{ $agent->created_at?->format('M d, Y') ?? 'N/A' }}</td>
                                    <td>
                                        <span class="badge bg-success">Active</span>
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
                @include('regulator._partials.empty-state', [
                    'icon' => 'bi-people',
                    'title' => 'No Agents Found',
                    'text' => 'No agents have been registered yet.'
                ])
            @endif
        </div>
    </div>
</div>
@endsection

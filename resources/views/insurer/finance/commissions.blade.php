@extends('layouts.dashboard')

@section('content')
<div class="container-fluid py-4">
    @include('insurer._partials.page-header', [
        'title' => 'Commission Payable',
        'subtitle' => 'Manage broker and agent commission payments',
        'icon' => 'bi-cash-coin'
    ])

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-briefcase-fill text-primary fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Broker Commissions</h6>
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
                        <div class="bg-success bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-person-badge-fill text-success fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Agent Commissions</h6>
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
                            <i class="bi bi-clock-fill text-warning fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Pending Payment</h6>
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
                        <div class="bg-info bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-check-circle-fill text-info fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Paid This Month</h6>
                            <h4 class="mb-0 fw-bold">TZS 0</h4>
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
                    <h5 class="mb-0">Broker Commissions</h5>
                </div>
                <div class="card-body">
                    @if($brokerComm->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Broker</th>
                                        <th>Policy</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($brokerComm as $comm)
                                        <tr>
                                            <td>{{ $comm->broker->name ?? 'N/A' }}</td>
                                            <td>{{ $comm->policy_number ?? 'N/A' }}</td>
                                            <td class="fw-bold">TZS {{ number_format($comm->amount ?? 0, 0) }}</td>
                                            <td>
                                                @if($comm->status === 'paid')
                                                    <span class="badge bg-success">Paid</span>
                                                @elseif($comm->status === 'pending')
                                                    <span class="badge bg-warning">Pending</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ $comm->status ?? 'Unknown' }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $brokerComm->links() }}
                    @else
                        @include('insurer._partials.empty-state', [
                            'icon' => 'bi-briefcase-fill',
                            'title' => 'No Broker Commissions',
                            'text' => 'No broker commissions recorded yet.'
                        ])
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0">Agent Commissions</h5>
                </div>
                <div class="card-body">
                    @if($agentComm->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Agent</th>
                                        <th>Policy</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($agentComm as $comm)
                                        <tr>
                                            <td>{{ $comm->agent->name ?? 'N/A' }}</td>
                                            <td>{{ $comm->policy_number ?? 'N/A' }}</td>
                                            <td class="fw-bold">TZS {{ number_format($comm->amount ?? 0, 0) }}</td>
                                            <td>
                                                @if($comm->status === 'paid')
                                                    <span class="badge bg-success">Paid</span>
                                                @elseif($comm->status === 'pending')
                                                    <span class="badge bg-warning">Pending</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ $comm->status ?? 'Unknown' }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $agentComm->links() }}
                    @else
                        @include('insurer._partials.empty-state', [
                            'icon' => 'bi-person-badge-fill',
                            'title' => 'No Agent Commissions',
                            'text' => 'No agent commissions recorded yet.'
                        ])
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

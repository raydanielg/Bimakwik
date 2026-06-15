@extends('layouts.dashboard')

@section('dashboard_content')
<div class="container-fluid py-4">
    @include('broker._partials.page-header', [
        'title' => 'Customers',
        'subtitle' => 'Manage customer accounts',
        'icon' => 'bi-people-fill'
    ])

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">All Customers</h5>
                <button class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-lg me-1"></i> Add Customer
                </button>
            </div>
        </div>
        <div class="card-body">
            @if($customers->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Region</th>
                                <th>Policies</th>
                                <th>KYC Status</th>
                                <th>Joined</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($customers as $customer)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px;">
                                                <i class="bi bi-person-fill text-muted"></i>
                                            </div>
                                            <div>
                                                <div class="fw-bold">{{ $customer->name ?? 'N/A' }}</div>
                                                <small class="text-muted">ID: {{ $customer->id ?? '-' }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $customer->email ?? 'N/A' }}</td>
                                    <td>{{ $customer->phone ?? 'N/A' }}</td>
                                    <td>{{ $customer->customerProfile?->region ?? 'N/A' }}</td>
                                    <td>{{ $customer->customer_policies_count ?? 0 }}</td>
                                    <td>
                                        @if($customer->customerProfile?->kyc_status === 'verified')
                                            <span class="badge bg-success">Verified</span>
                                        @elseif($customer->customerProfile?->kyc_status === 'pending')
                                            <span class="badge bg-warning">Pending</span>
                                        @else
                                            <span class="badge bg-secondary">Not Started</span>
                                        @endif
                                    </td>
                                    <td>{{ $customer->created_at?->format('M d, Y') ?? 'N/A' }}</td>
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
                {{ $customers->links() }}
            @else
                @include('broker._partials.empty-state', [
                    'icon' => 'bi-people-fill',
                    'title' => 'No Customers Found',
                    'text' => 'There are no customers registered yet.'
                ])
            @endif
        </div>
    </div>
</div>
@endsection


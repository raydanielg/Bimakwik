@extends('layouts.dashboard')

@section('content')
<div class="container-fluid py-4">
    @include('service-provider._partials.page-header', [
        'title' => 'All Customers',
        'subtitle' => 'View and manage all customers',
        'action' => '<a href="{{ route('service-provider.customer.verify') }}" class="btn btn-primary"><i class="bi bi-search me-1"></i> Verify Customer</a>'
    ])

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Customer List</h5>
                <div class="btn-group btn-group-sm">
                    <button class="btn btn-outline-primary"><i class="bi bi-download me-1"></i> Export</button>
                    <button class="btn btn-outline-secondary"><i class="bi bi-funnel me-1"></i> Filter</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if($customers->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Name</th>
                                <th>NIN</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Policies</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($customers as $customer)
                                <tr>
                                    <td class="fw-bold">{{ $customer->name ?? 'N/A' }}</td>
                                    <td>{{ $customer->nin ?? 'N/A' }}</td>
                                    <td>{{ $customer->phone ?? 'N/A' }}</td>
                                    <td>{{ $customer->email ?? 'N/A' }}</td>
                                    <td><span class="badge bg-primary">{{ $customer->policies->count() ?? 0 }}</span></td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('service-provider.customer.show', $customer->id) }}" class="btn btn-outline-primary"><i class="bi bi-eye"></i></a>
                                            <a href="{{ route('service-provider.customer.kyc', $customer->id) }}" class="btn btn-outline-secondary"><i class="bi bi-file-earmark-text"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $customers->links() }}
            @else
                @include('service-provider._partials.empty-state', [
                    'icon' => 'bi-people',
                    'title' => 'No Customers Found',
                    'text' => 'No customers have been registered yet.'
                ])
            @endif
        </div>
    </div>
</div>
@endsection

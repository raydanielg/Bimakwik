@extends('layouts.dashboard')

@section('content')
<div class="container-fluid py-4">
    @include('payment._partials.page-header', [
        'title' => 'Payment Gateways',
        'subtitle' => 'Manage payment gateway configurations',
        'action' => '<a href="{{ route('payment.gateways.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i> Add Gateway</a>'
    ])

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3">
            <h5 class="mb-0">All Payment Gateways</h5>
        </div>
        <div class="card-body">
            @if($gateways->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Type</th>
                                <th>Environment</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($gateways as $gateway)
                                <tr>
                                    <td class="fw-bold">{{ $gateway->name ?? 'N/A' }}</td>
                                    <td><code>{{ $gateway->code ?? 'N/A' }}</code></td>
                                    <td>{{ $gateway->type ?? 'N/A' }}</td>
                                    <td>
                                        @if($gateway->environment === 'production')
                                            <span class="badge bg-danger">Production</span>
                                        @else
                                            <span class="badge bg-warning">Sandbox</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($gateway->is_active ?? false)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('payment.gateways.show', $gateway->id) }}" class="btn btn-outline-primary"><i class="bi bi-eye"></i></a>
                                            <a href="{{ route('payment.gateways.edit', $gateway->id) }}" class="btn btn-outline-secondary"><i class="bi bi-pencil"></i></a>
                                            <form action="{{ route('payment.gateways.toggle', $gateway->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-warning"><i class="bi bi-power"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $gateways->links() }}
            @else
                @include('payment._partials.empty-state', [
                    'icon' => 'bi-credit-card',
                    'title' => 'No Gateways Found',
                    'text' => 'No payment gateways have been configured yet.'
                ])
            @endif
        </div>
    </div>
</div>
@endsection

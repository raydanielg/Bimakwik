@extends('layouts.dashboard')

@section('content')
<div class="container-fluid py-4">
    @include('payment._partials.page-header', [
        'title' => 'Payment Webhooks',
        'subtitle' => 'View and manage payment webhook logs',
    ])

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Webhook Logs</h5>
                <div class="btn-group btn-group-sm">
                    <button class="btn btn-outline-primary"><i class="bi bi-download me-1"></i> Export</button>
                    <button class="btn btn-outline-secondary"><i class="bi bi-funnel me-1"></i> Filter</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if($webhooks->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Event Type</th>
                                <th>Gateway</th>
                                <th>Processed</th>
                                <th>Processed At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($webhooks as $webhook)
                                <tr>
                                    <td><span class="badge bg-primary">{{ $webhook->event_type ?? 'N/A' }}</span></td>
                                    <td>{{ $webhook->paymentGateway->name ?? 'N/A' }}</td>
                                    <td>
                                        @if($webhook->processed ?? false)
                                            <span class="badge bg-success">Processed</span>
                                        @else
                                            <span class="badge bg-warning">Pending</span>
                                        @endif
                                    </td>
                                    <td>{{ $webhook->processed_at?->format('M d, Y H:i') ?? 'N/A' }}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('payment.webhooks.show', $webhook->id) }}" class="btn btn-outline-primary"><i class="bi bi-eye"></i></a>
                                            @if(!($webhook->processed ?? false))
                                                <a href="{{ route('payment.webhooks.retry', $webhook->id) }}" class="btn btn-outline-warning"><i class="bi bi-arrow-clockwise"></i></a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $webhooks->links() }}
            @else
                @include('payment._partials.empty-state', [
                    'icon' => 'bi-link-45deg',
                    'title' => 'No Webhooks Found',
                    'text' => 'No webhook events have been recorded yet.'
                ])
            @endif
        </div>
    </div>
</div>
@endsection

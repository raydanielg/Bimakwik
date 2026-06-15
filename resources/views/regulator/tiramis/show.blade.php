@extends('layouts.dashboard')

@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">TIRAMIS Report #{{ $report->report_number }}</h4>
        <small class="text-muted">Regulatory view of TIRA MIS submission</small>
    </div>
    <div>
        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
            <i class="bi bi-arrow-left me-1"></i> Back
        </a>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-borderless mb-0">
                    <tr>
                        <td class="text-muted" style="width: 140px;">Report Number</td>
                        <td class="fw-semibold"><code>{{ $report->report_number }}</code></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Company Code</td>
                        <td><span class="badge bg-primary bg-opacity-10 text-primary">{{ $report->company_code ?? '—' }}</span></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Sales Code</td>
                        <td><span class="badge bg-info bg-opacity-10 text-info">{{ $report->sales_code ?? '—' }}</span></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Report Type</td>
                        <td>{{ ucfirst($report->report_type) }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Status</td>
                        <td>
                            @switch($report->status)
                                @case('sent') <span class="badge bg-success">Sent</span> @break
                                @case('failed') <span class="badge bg-danger">Failed</span> @break
                                @case('pending') <span class="badge bg-warning text-dark">Pending</span> @break
                                @default <span class="badge bg-secondary">{{ $report->status }}</span>
                            @endswitch
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-borderless mb-0">
                    <tr>
                        <td class="text-muted" style="width: 140px;">Claim #</td>
                        <td>{{ $report->claim?->claim_number ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Sent At</td>
                        <td>{{ $report->sent_at?->format('d M Y H:i:s') ?? 'Not sent' }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Response Code</td>
                        <td><code>{{ $report->response_code ?? '—' }}</code></td>
                    </tr>
                    @if($report->response_message)
                    <tr>
                        <td class="text-muted">Response</td>
                        <td>{{ $report->response_message }}</td>
                    </tr>
                    @endif
                    <tr>
                        <td class="text-muted">Submitted</td>
                        <td>{{ $report->created_at->format('d M Y H:i:s') }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

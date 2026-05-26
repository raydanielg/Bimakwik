@extends('layouts.dashboard')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Service Provider Dashboard</h2>
            <p class="text-muted mb-0">Welcome back! Here's your overview.</p>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-file-earmark-text fs-4"></i>
                        </div>
                        <div class="text-success small fw-bold"><i class="bi bi-graph-up"></i> +12%</div>
                    </div>
                    <h6 class="text-uppercase small fw-bold text-muted mb-1">Bills Submitted</h6>
                    <h4 class="fw-bold mb-0">{{ $totalBills }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="bg-warning bg-opacity-10 text-warning rounded-3 p-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-clock fs-4"></i>
                        </div>
                        <div class="text-warning small fw-bold">Pending</div>
                    </div>
                    <h6 class="text-uppercase small fw-bold text-muted mb-1">Pending Approval</h6>
                    <h4 class="fw-bold mb-0">{{ $pendingBills }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="bg-success bg-opacity-10 text-success rounded-3 p-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-check-circle fs-4"></i>
                        </div>
                        <div class="text-success small fw-bold"><i class="bi bi-arrow-up"></i> +8%</div>
                    </div>
                    <h6 class="text-uppercase small fw-bold text-muted mb-1">Paid Amount</h6>
                    <h4 class="fw-bold mb-0">TZS {{ number_format($paidAmount, 0) }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="bg-danger bg-opacity-10 text-danger rounded-3 p-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-x-octagon fs-4"></i>
                        </div>
                        <div class="text-danger small fw-bold">Rejected</div>
                    </div>
                    <h6 class="text-uppercase small fw-bold text-muted mb-1">Rejected Bills</h6>
                    <h4 class="fw-bold mb-0">{{ $rejectedBills }}</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm p-4 h-100">
                <h6 class="fw-bold mb-4"><i class="bi bi-person-vcard me-2 text-primary"></i> Quick Customer Verification</h6>
                <form>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Policy Number</label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Enter policy number to verify">
                            <button class="btn btn-primary" type="button">Verify</button>
                        </div>
                    </div>
                    <div class="p-3 bg-light rounded-3 border border-dashed text-center small text-muted">
                        Enter a valid policy number to verify customer coverage and claim eligibility.
                    </div>
                </form>
            </div>
        </div>
        
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm p-4 h-100">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h6 class="fw-bold mb-0">Recent Bill Submissions</h6>
                    <a href="#" class="btn btn-sm btn-link text-decoration-none">View All</a>
                </div>
                @if($recentBills->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle small">
                            <thead>
                                <tr>
                                    <th>Patient/Policy</th>
                                    <th>Bill No</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentBills as $bill)
                                    <tr>
                                        <td>{{ $bill->customer->name ?? 'N/A' }}</td>
                                        <td>#{{ $bill->bill_number ?? $bill->id }}</td>
                                        <td>TZS {{ number_format($bill->amount ?? 0, 0) }}</td>
                                        <td>
                                            @if($bill->status === 'pending')
                                                <span class="badge bg-warning">Pending</span>
                                            @elseif($bill->status === 'paid')
                                                <span class="badge bg-success">Approved</span>
                                            @elseif($bill->status === 'rejected')
                                                <span class="badge bg-danger">Rejected</span>
                                            @else
                                                <span class="badge bg-secondary">{{ $bill->status ?? 'Unknown' }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="bi bi-inbox text-muted fs-1"></i>
                        <p class="text-muted mb-0">No recent bills found</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

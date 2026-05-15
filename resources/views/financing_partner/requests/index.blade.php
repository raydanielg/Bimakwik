@extends('layouts.dashboard')

@section('dashboard_title', 'Loan Requests')

@section('dashboard_content')
<div class="card border-0 shadow-sm p-4 mb-4">
    <div class="d-flex flex-wrap justify-content-between align-items-start gap-3">
        <div>
            <h5 class="fw-bold mb-2">Financing Requests Queue</h5>
            <p class="text-muted mb-0">Review and process premium financing applications submitted for approval.</p>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-primary btn-sm" type="button">Create New</button>
            <button class="btn btn-outline-secondary btn-sm" type="button">Export</button>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm p-4 h-100">
            <h6 class="fw-bold mb-3">Overview</h6>
            <p class="text-muted mb-0">This section is now connected to its controller action and ready for database-backed logic and workflow integration.</p>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm p-4 h-100">
            <h6 class="fw-bold mb-3">Next Steps</h6>
            <ul class="mb-0 ps-3 text-muted">
                <li>Wire model queries and filters</li>
                <li>Add form validation and actions</li>
                <li>Attach permission checks</li>
            </ul>
        </div>
    </div>
</div>
@endsection

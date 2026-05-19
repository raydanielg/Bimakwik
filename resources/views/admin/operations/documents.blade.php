@extends('layouts.dashboard')

@section('dashboard_content')
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="fw-bold mb-1">Document Vault</h2>
                <p class="text-muted small mb-0">Secure document storage and management</p>
            </div>
            <button class="btn btn-primary rounded-pill px-4">
                <i class="bi bi-cloud-upload me-2"></i>Upload Document
            </button>
        </div>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Total Documents</p>
                        <h3 class="fw-bold mb-0">2,456</h3>
                    </div>
                    <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-file-earmark-pdf text-primary fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Storage Used</p>
                        <h3 class="fw-bold mb-0">45.2 GB</h3>
                    </div>
                    <div class="bg-info bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-hdd text-info fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Uploaded Today</p>
                        <h3 class="fw-bold mb-0">89</h3>
                    </div>
                    <div class="bg-success bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-upload text-success fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Pending Review</p>
                        <h3 class="fw-bold mb-0">24</h3>
                    </div>
                    <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-clock-history text-warning fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-bottom py-3">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h5 class="mb-0 fw-bold">Recent Documents</h5>
            </div>
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-text bg-light border-0">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" class="form-control border-0 bg-light" placeholder="Search documents...">
                </div>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="border-0 py-3">Document</th>
                        <th class="border-0 py-3">Type</th>
                        <th class="border-0 py-3">Size</th>
                        <th class="border-0 py-3">Uploaded By</th>
                        <th class="border-0 py-3">Date</th>
                        <th class="border-0 py-3 text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse([
                        ['name' => 'Policy_Document_001234.pdf', 'type' => 'Policy', 'size' => '2.4 MB', 'user' => 'Admin User', 'date' => '2 hours ago'],
                        ['name' => 'Claim_Evidence_002.jpg', 'type' => 'Claim', 'size' => '1.8 MB', 'user' => 'John Doe', 'date' => '5 hours ago'],
                        ['name' => 'ID_Verification_123.pdf', 'type' => 'KYC', 'size' => '890 KB', 'user' => 'Sarah K', 'date' => '1 day ago'],
                    ] as $doc)
                    <tr>
                        <td class="py-3">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-file-earmark-pdf text-danger fs-4 me-2"></i>
                                <span class="fw-semibold">{{ $doc['name'] }}</span>
                            </div>
                        </td>
                        <td class="py-3">
                            <span class="badge bg-primary bg-opacity-10 text-primary">{{ $doc['type'] }}</span>
                        </td>
                        <td class="py-3">{{ $doc['size'] }}</td>
                        <td class="py-3">{{ $doc['user'] }}</td>
                        <td class="py-3"><small class="text-muted">{{ $doc['date'] }}</small></td>
                        <td class="py-3 text-end">
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-primary" title="View">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-outline-success" title="Download">
                                    <i class="bi bi-download"></i>
                                </button>
                                <button class="btn btn-outline-danger" title="Delete" onclick="confirmDelete('doc-form')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <i class="bi bi-inbox fs-1 text-muted d-block mb-3"></i>
                            <p class="text-muted">No documents found</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

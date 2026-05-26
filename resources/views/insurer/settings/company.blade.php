@extends('layouts.dashboard')

@section('content')
<div class="container-fluid py-4">
    @include('insurer._partials.page-header', [
        'title' => 'Company Profile',
        'subtitle' => 'Manage company information and settings',
        'icon' => 'bi-building-fill'
    ])

    <div class="row">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0">Company Information</h5>
                </div>
                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Company Name</label>
                                <input type="text" class="form-control" value="{{ $user->name ?? '' }}" placeholder="Enter company name">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Registration Number</label>
                                <input type="text" class="form-control" placeholder="Enter registration number">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Email Address</label>
                                <input type="email" class="form-control" value="{{ $user->email ?? '' }}" placeholder="Enter email address">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Phone Number</label>
                                <input type="text" class="form-control" placeholder="Enter phone number">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-semibold">Address</label>
                                <textarea class="form-control" rows="2" placeholder="Enter company address"></textarea>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-semibold">City</label>
                                <input type="text" class="form-control" placeholder="Enter city">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-semibold">Region</label>
                                <input type="text" class="form-control" placeholder="Enter region">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-semibold">Postal Code</label>
                                <input type="text" class="form-control" placeholder="Enter postal code">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Tax ID (TIN)</label>
                                <input type="text" class="form-control" placeholder="Enter tax ID">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Insurance License Number</label>
                                <input type="text" class="form-control" placeholder="Enter license number">
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-1"></i> Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0">Social Media & Contact</h5>
                </div>
                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Website URL</label>
                                <input type="url" class="form-control" placeholder="https://example.com">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Support Email</label>
                                <input type="email" class="form-control" placeholder="support@example.com">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-semibold">Facebook</label>
                                <input type="text" class="form-control" placeholder="Facebook handle">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-semibold">Twitter/X</label>
                                <input type="text" class="form-control" placeholder="Twitter handle">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-semibold">LinkedIn</label>
                                <input type="text" class="form-control" placeholder="LinkedIn handle">
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-1"></i> Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0">Company Logo</h5>
                </div>
                <div class="card-body text-center">
                    <div class="bg-light rounded d-flex align-items-center justify-content-center mb-3" style="height: 150px;">
                        <i class="bi bi-building text-muted fs-1"></i>
                    </div>
                    <input type="file" class="form-control mb-3" accept="image/*">
                    <button class="btn btn-primary btn-sm">
                        <i class="bi bi-upload me-1"></i> Upload Logo
                    </button>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0">Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <button class="btn btn-outline-primary">
                            <i class="bi bi-download me-2"></i> Download Certificate
                        </button>
                        <button class="btn btn-outline-secondary">
                            <i class="bi bi-file-earmark-text me-2"></i> View License
                        </button>
                        <button class="btn btn-outline-info">
                            <i class="bi bi-shield-check me-2"></i> Verify Compliance
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

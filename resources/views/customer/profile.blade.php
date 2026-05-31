@extends('layouts.dashboard')

@section('content')
@php
    $customer = $customer ?? null;
    $kycDocuments = $kycDocuments ?? collect();
@endphp
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="fw-bold">{{ __('customer.profile_title') }}</h4>
            <p class="text-muted small">{{ __('customer.profile_subtitle') }}</p>
        </div>
    </div>

    <div class="row g-4">
        <!-- Personal Info Card -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4 border-bottom pb-2">{{ __('customer.personal_info') }}</h5>
                    <form action="{{ route('customer.profile.update') }}" method="POST"
                          data-ajax="true"
                          data-success-msg="Profile updated successfully!">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Full Name</label>
                                <input type="text" name="name" class="form-control rounded-3" value="{{ $customer->full_name ?? auth()->user()->name }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Email Address</label>
                                <input type="email" class="form-control rounded-3" value="{{ auth()->user()->email }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Phone Number</label>
                                <input type="text" name="phone_number" class="form-control rounded-3"
                                    value="{{ $customer->emergency_contact_phone ?? '' }}" placeholder="+255 000 000 000">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Gender</label>
                                <select name="gender" class="form-select rounded-3">
                                    <option value="">Select</option>
                                    <option value="male"   {{ ($customer->gender ?? '') == 'male'   ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ ($customer->gender ?? '') == 'female' ? 'selected' : '' }}>Female</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Date of Birth</label>
                                <input type="date" name="date_of_birth" class="form-control rounded-3"
                                    value="{{ $customer->date_of_birth ?? '' }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">ID / NIDA Number</label>
                                <input type="text" name="id_number" class="form-control rounded-3"
                                    value="{{ $customer->id_number ?? '' }}" placeholder="e.g. 12345678901234567890">
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold">Residential Address</label>
                                <textarea name="address" class="form-control rounded-3" rows="3">{{ $customer->residential_address ?? '' }}</textarea>
                            </div>
                        </div>
                        <div class="mt-4 text-end">
                            <button type="submit" class="btn btn-primary px-4 rounded-pill">
                                <i class="bi bi-check2 me-1"></i>Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- KYC Documents -->
            <div class="card border-0 shadow-sm rounded-4 mt-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4 border-bottom pb-2">{{ __('customer.kyc_verification') }}</h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="p-3 border rounded-3 bg-light">
                                <h6 class="fw-bold small mb-2">{{ __('customer.nida_id') }}</h6>
                                <p class="small text-muted mb-3">{{ __('customer.upload_nida_hint') }}</p>
                                <input type="file" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 border rounded-3 bg-light">
                                <h6 class="fw-bold small mb-2">{{ __('customer.passport_photo') }}</h6>
                                <p class="small text-muted mb-3">{{ __('customer.upload_passport_hint') }}</p>
                                <input type="file" class="form-control form-control-sm">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status Sidebar -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 text-center p-4">
                <div class="mb-3">
                    <div class="bg-warning bg-opacity-10 rounded-circle p-4 d-inline-block">
                        <i class="bi bi-shield-lock text-warning fs-1"></i>
                    </div>
                </div>
                <h5 class="fw-bold">{{ __('customer.account_status') }}</h5>
                <span class="badge bg-warning bg-opacity-10 text-warning px-3 rounded-pill mb-3">{{ __('customer.pending_verification') }}</span>
                <p class="small text-muted mb-0">
                    {{ __('customer.status_help_text') }}
                </p>
            </div>

            <div class="card border-0 shadow-sm rounded-4 mt-4 p-4 bg-primary text-white">
                <h6 class="fw-bold mb-3"><i class="bi bi-lightbulb me-2"></i> {{ __('customer.security_tip') }}</h6>
                <p class="small mb-0 opacity-75">
                    {{ __('customer.security_tip_text') }}
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

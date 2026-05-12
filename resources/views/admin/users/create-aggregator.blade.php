@extends('layouts.dashboard')

@section('dashboard_title', 'Create New Aggregator')

@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Create New Aggregator</h4>
    <a href="{{ route('admin.users.aggregators') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i>Back to Aggregators
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0">Aggregator Information</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.users.aggregators.store') }}">
                    @csrf
                    
                    <!-- Company Information -->
                    <div class="mb-4">
                        <h6 class="text-primary mb-3">Company Details</h6>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="company_name" class="form-label">Company Name *</label>
                                <input type="text" class="form-control @error('company_name') is-invalid @enderror" 
                                       id="company_name" name="company_name" value="{{ old('company_name') }}" 
                                       placeholder="Enter company name" required>
                                @error('company_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="business_license" class="form-label">Business License Number *</label>
                                <input type="text" class="form-control @error('business_license') is-invalid @enderror" 
                                       id="business_license" name="business_license" value="{{ old('business_license') }}" 
                                       placeholder="Enter license number" required>
                                @error('business_license')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="website" class="form-label">Website</label>
                                <input type="url" class="form-control @error('website') is-invalid @enderror" 
                                       id="website" name="website" value="{{ old('website') }}" 
                                       placeholder="https://example.com">
                                @error('website')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="physical_address" class="form-label">Physical Address *</label>
                                <textarea class="form-control @error('physical_address') is-invalid @enderror" 
                                          id="physical_address" name="physical_address" rows="3" 
                                          placeholder="Enter full physical address" required>{{ old('physical_address') }}</textarea>
                                @error('physical_address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Contact Information -->
                    <div class="mb-4">
                        <h6 class="text-primary mb-3">Contact Person Details</h6>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="contact_person" class="form-label">Contact Person Name *</label>
                                <input type="text" class="form-control @error('contact_person') is-invalid @enderror" 
                                       id="contact_person" name="contact_person" value="{{ old('contact_person') }}" 
                                       placeholder="Enter contact person name" required>
                                @error('contact_person')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">Phone Number *</label>
                                <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                                       id="phone" name="phone" value="{{ old('phone') }}" 
                                       placeholder="+255 123 456 789" required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="email" class="form-label">Email Address *</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email') }}" 
                                       placeholder="contact@company.com" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Account Information -->
                    <div class="mb-4">
                        <h6 class="text-primary mb-3">Account Setup</h6>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">Password *</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                       id="password" name="password" placeholder="Enter password" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password *</label>
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" 
                                       id="password_confirmation" name="password_confirmation" placeholder="Confirm password" required>
                                @error('password_confirmation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="commission_rate" class="form-label">Commission Rate (%) *</label>
                                <input type="number" class="form-control @error('commission_rate') is-invalid @enderror" 
                                       id="commission_rate" name="commission_rate" value="{{ old('commission_rate', 10) }}" 
                                       min="0" max="100" step="0.1" placeholder="10.0" required>
                                @error('commission_rate')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Set the commission rate for this aggregator (0-100%)</small>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.users.aggregators') }}" class="btn btn-outline-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle me-2"></i>Create Aggregator
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Help Card -->
        <div class="card">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0"><i class="bi bi-info-circle me-2"></i>Information</h6>
            </div>
            <div class="card-body">
                <h6 class="fw-bold mb-3">Aggregator Account</h6>
                <p class="text-muted small mb-3">
                    Creating an aggregator account will allow the company to manage insurance products, 
                    compare policies, and earn commissions from sales.
                </p>
                
                <h6 class="fw-bold mb-3">Requirements</h6>
                <ul class="small text-muted">
                    <li>Valid business license</li>
                    <li>Physical business address</li>
                    <li>Active contact person</li>
                    <li>Valid email address</li>
                    <li>Phone number for verification</li>
                </ul>
                
                <div class="alert alert-info small">
                    <i class="bi bi-shield-check me-2"></i>
                    All aggregators are automatically approved but can be reviewed and suspended if needed.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

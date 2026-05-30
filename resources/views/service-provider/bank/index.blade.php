@extends('layouts.dashboard')

@section('content')
<div class="container-fluid py-4">
    @include('service-provider._partials.page-header', [
        'title' => 'Bank Details',
        'subtitle' => 'Manage payment bank information'
    ])

    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm p-4">
                <h6 class="fw-bold mb-4">Bank Information</h6>
                <form action="{{ route('service-provider.bank.update') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Bank Name</label>
                            <input type="text" name="bank_name" class="form-control" placeholder="Enter bank name" value="{{ $bankDetails->bank_name ?? old('bank_name') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Account Name</label>
                            <input type="text" name="account_name" class="form-control" placeholder="Enter account name" value="{{ $bankDetails->account_name ?? old('account_name') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Account Number</label>
                            <input type="text" name="account_number" class="form-control" placeholder="Enter account number" value="{{ $bankDetails->account_number ?? old('account_number') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Branch</label>
                            <input type="text" name="branch" class="form-control" placeholder="Enter branch name" value="{{ $bankDetails->branch ?? old('branch') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Swift Code</label>
                            <input type="text" name="swift_code" class="form-control" placeholder="Enter swift code" value="{{ $bankDetails->swift_code ?? old('swift_code') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Tax ID (TIN)</label>
                            <input type="text" name="tax_id" class="form-control" placeholder="Enter tax ID" value="{{ $bankDetails->tax_id ?? old('tax_id') }}">
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
        
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm p-4 h-100">
                <h6 class="fw-bold mb-4">Payment Settings</h6>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Payment Method</label>
                    <select name="payment_method" class="form-select">
                        <option value="bank_transfer" {{ ($bankDetails->payment_method ?? '') === 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                        <option value="mobile_money" {{ ($bankDetails->payment_method ?? '') === 'mobile_money' ? 'selected' : '' }}>Mobile Money</option>
                        <option value="check" {{ ($bankDetails->payment_method ?? '') === 'check' ? 'selected' : '' }}>Check</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Minimum Payment Amount</label>
                    <input type="text" name="minimum_payment_amount" class="form-control" placeholder="Enter minimum amount" value="{{ $bankDetails->minimum_payment_amount ?? old('minimum_payment_amount') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Payment Frequency</label>
                    <select name="payment_frequency" class="form-select">
                        <option value="daily" {{ ($bankDetails->payment_frequency ?? '') === 'daily' ? 'selected' : '' }}>Daily</option>
                        <option value="weekly" {{ ($bankDetails->payment_frequency ?? '') === 'weekly' ? 'selected' : '' }}>Weekly</option>
                        <option value="monthly" {{ ($bankDetails->payment_frequency ?? '') === 'monthly' ? 'selected' : '' }}>Monthly</option>
                    </select>
                </div>
                <div class="alert alert-info small">
                    <i class="bi bi-info-circle me-1"></i>
                    Payments will be processed according to your selected frequency.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

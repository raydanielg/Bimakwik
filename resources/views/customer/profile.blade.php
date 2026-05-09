@extends('layouts.dashboard')

@section('dashboard_content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="fw-bold">{{ app()->getLocale() == 'sw' ? 'Wasifu wangu & KYC' : 'My Profile & KYC' }}</h4>
            <p class="text-muted small">{{ app()->getLocale() == 'sw' ? 'Simamia taarifa zako na hali ya uhakiki.' : 'Manage your personal information and verification status.' }}</p>
        </div>
    </div>

    <div class="row g-4">
        <!-- Personal Info Card -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4 border-bottom pb-2">{{ app()->getLocale() == 'sw' ? 'Taarifa Binafsi' : 'Personal Information' }}</h5>
                    <form action="#" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">{{ app()->getLocale() == 'sw' ? 'Jina Kamili' : 'Full Name' }}</label>
                                <input type="text" class="form-control rounded-3" value="{{ auth()->user()->name }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">{{ app()->getLocale() == 'sw' ? 'Barua Pepe' : 'Email Address' }}</label>
                                <input type="email" class="form-control rounded-3" value="{{ auth()->user()->email }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">{{ app()->getLocale() == 'sw' ? 'Namba ya Simu' : 'Phone Number' }}</label>
                                <input type="text" class="form-control rounded-3" placeholder="+255 000 000 000">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">{{ app()->getLocale() == 'sw' ? 'Jinsia' : 'Gender' }}</label>
                                <select class="form-select rounded-3">
                                    <option selected>{{ app()->getLocale() == 'sw' ? 'Chagua...' : 'Select...' }}</option>
                                    <option value="male">{{ app()->getLocale() == 'sw' ? 'Mume' : 'Male' }}</option>
                                    <option value="female">{{ app()->getLocale() == 'sw' ? 'Mke' : 'Female' }}</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold">{{ app()->getLocale() == 'sw' ? 'Anwani' : 'Address' }}</label>
                                <textarea class="form-control rounded-3" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="mt-4 text-end">
                            <button type="submit" class="btn btn-primary px-4 rounded-pill">{{ app()->getLocale() == 'sw' ? 'Hifadhi Mabadiliko' : 'Save Changes' }}</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- KYC Documents -->
            <div class="card border-0 shadow-sm rounded-4 mt-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4 border-bottom pb-2">{{ app()->getLocale() == 'sw' ? 'Nyaraka za KYC' : 'KYC Verification' }}</h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="p-3 border rounded-3 bg-light">
                                <h6 class="fw-bold small mb-2">{{ app()->getLocale() == 'sw' ? 'Kitambulisho cha NIDA' : 'NIDA ID' }}</h6>
                                <p class="small text-muted mb-3">{{ app()->getLocale() == 'sw' ? 'Pakia picha ya kitambulisho chako cha taifa.' : 'Upload a clear photo of your National ID.' }}</p>
                                <input type="file" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 border rounded-3 bg-light">
                                <h6 class="fw-bold small mb-2">{{ app()->getLocale() == 'sw' ? 'Picha ya Pasipoti' : 'Passport Photo' }}</h6>
                                <p class="small text-muted mb-3">{{ app()->getLocale() == 'sw' ? 'Pakia picha yako ya hivi karibuni.' : 'Upload a recent passport-sized photo.' }}</p>
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
                <h5 class="fw-bold">{{ app()->getLocale() == 'sw' ? 'Hali ya Akaunti' : 'Account Status' }}</h5>
                <span class="badge bg-warning bg-opacity-10 text-warning px-3 rounded-pill mb-3">{{ app()->getLocale() == 'sw' ? 'Inasubiri Uhakiki' : 'Pending Verification' }}</span>
                <p class="small text-muted mb-0">
                    {{ app()->getLocale() == 'sw' ? 'Tafadhali kamilisha upakiaji wa nyaraka zako ili kuanza kutumia huduma zote.' : 'Please complete your document upload to unlock all platform features.' }}
                </p>
            </div>

            <div class="card border-0 shadow-sm rounded-4 mt-4 p-4 bg-primary text-white">
                <h6 class="fw-bold mb-3"><i class="bi bi-lightbulb me-2"></i> {{ app()->getLocale() == 'sw' ? 'Kidokezo cha Usalama' : 'Security Tip' }}</h6>
                <p class="small mb-0 opacity-75">
                    {{ app()->getLocale() == 'sw' ? 'Usishiriki nenosiri lako au namba ya siri (PIN) na mtu yeyote. Bima Kwik haitauliza siri zako.' : 'Never share your password or PIN with anyone. Bima Kwik will never ask for your credentials via phone or email.' }}
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

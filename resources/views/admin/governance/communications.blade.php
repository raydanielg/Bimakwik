@extends('layouts.dashboard')

@section('dashboard_content')
<div class="row mb-4">
    <div class="col-12">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="fw-bold mb-1">Communications</h2>
                <p class="text-muted small mb-0">Send notifications and messages to users</p>
            </div>
            <button class="btn btn-primary rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#sendMessageModal">
                <i class="bi bi-send me-2"></i>Send Message
            </button>
        </div>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <p class="text-muted small mb-1">Messages Sent Today</p>
                <h3 class="fw-bold mb-0">1,245</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <p class="text-muted small mb-1">Delivery Rate</p>
                <h3 class="fw-bold mb-0">98.5%</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <p class="text-muted small mb-1">Open Rate</p>
                <h3 class="fw-bold mb-0">65.2%</h3>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-bottom py-3">
        <h5 class="mb-0 fw-bold">Recent Messages</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="border-0 py-3">Subject</th>
                        <th class="border-0 py-3">Recipients</th>
                        <th class="border-0 py-3">Channel</th>
                        <th class="border-0 py-3">Status</th>
                        <th class="border-0 py-3">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($communications as $msg)
                    <tr>
                        <td class="py-3"><span class="fw-semibold">{{ $msg->subject ?? 'Communication' }}</span></td>
                        <td class="py-3">{{ $msg->recipients ?? '-' }} users</td>
                        <td class="py-3">
                            <span class="badge bg-primary bg-opacity-10 text-primary">{{ $msg->channel ?? '-' }}</span>
                        </td>
                        <td class="py-3">
                            <span class="badge bg-success bg-opacity-10 text-success">
                                <i class="bi bi-check-circle"></i> {{ ucfirst($msg->status ?? 'sent') }}
                            </span>
                        </td>
                        <td class="py-3"><small class="text-muted">{{ optional($msg->created_at)->diffForHumans() ?? '-' }}</small></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <i class="bi bi-inbox fs-1 text-muted d-block mb-3"></i>
                            <p class="text-muted">No messages sent</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Send Message Modal -->
<div class="modal fade" id="sendMessageModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-bottom">
                <h5 class="modal-title fw-bold">Send Message</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('admin.governance.communications.send') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Recipients</label>
                        <select class="form-select" name="recipients" required>
                            <option value="">Select audience...</option>
                            <option value="all_users">All Users</option>
                            <option value="active_policy_holders">Active Policy Holders</option>
                            <option value="pending_renewals">Pending Renewals</option>
                            <option value="custom_segment">Custom Segment</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Channel</label>
                        <select class="form-select" name="channel" required>
                            <option value="">Select channel...</option>
                            <option value="email">Email</option>
                            <option value="sms">SMS</option>
                            <option value="push_notification">Push Notification</option>
                            <option value="in_app_message">In-App Message</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Subject</label>
                        <input type="text" class="form-control" name="subject" placeholder="Message subject" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Message</label>
                        <textarea class="form-control" name="message" rows="4" placeholder="Type your message..." required></textarea>
                    </div>
                    <div class="modal-footer border-top">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-send me-2"></i>Send Now
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

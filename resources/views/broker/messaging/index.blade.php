@extends('layouts.dashboard')
@section('dashboard_title', 'Messaging & Notifications')
@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Messaging & Notifications</h4>
        <p class="text-muted mb-0 small">Your notifications and system messages</p>
    </div>
    @if($unreadCount > 0)
    <span class="badge bg-danger rounded-pill fs-6">{{ $unreadCount }} unread</span>
    @endif
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        @forelse($notifications as $notification)
        @php $data = is_array($notification->data) ? $notification->data : json_decode($notification->data, true); @endphp
        <div class="d-flex align-items-start p-4 border-bottom {{ is_null($notification->read_at) ? 'bg-primary bg-opacity-5' : '' }}">
            <div class="bg-{{ is_null($notification->read_at) ? 'primary' : 'secondary' }} bg-opacity-10 text-{{ is_null($notification->read_at) ? 'primary' : 'secondary' }} rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0" style="width:42px;height:42px;">
                <i class="bi bi-bell"></i>
            </div>
            <div class="flex-grow-1">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fw-bold small">{{ $data['title'] ?? 'Notification' }}</div>
                        <div class="text-muted small mt-1">{{ $data['message'] ?? $data['body'] ?? 'No content' }}</div>
                    </div>
                    <div class="text-muted small ms-3 text-nowrap">{{ $notification->created_at?->diffForHumans() }}</div>
                </div>
                @if(is_null($notification->read_at))
                <span class="badge bg-primary bg-opacity-10 text-primary small mt-1">New</span>
                @endif
            </div>
        </div>
        @empty
        <div class="text-center py-5 text-muted">
            <i class="bi bi-bell-slash fs-2 d-block mb-2 opacity-25"></i>
            No notifications found.
        </div>
        @endforelse
    </div>
    @if($notifications instanceof \Illuminate\Pagination\LengthAwarePaginator && $notifications->hasPages())
    <div class="card-footer bg-white border-0 py-3 px-4">{{ $notifications->links() }}</div>
    @endif
</div>
@endsection

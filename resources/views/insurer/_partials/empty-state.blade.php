{{-- Reusable empty state: $emptyIcon, $emptyTitle, $emptyText, $emptyAction (optional) --}}
<div class="text-center py-5 text-muted">
    <i class="bi bi-{{ $emptyIcon ?? 'inbox' }} fs-1 d-block mb-3 text-secondary"></i>
    <h5 class="mb-1">{{ $emptyTitle ?? 'No records yet' }}</h5>
    <p class="mb-3 small">{{ $emptyText ?? 'Records will appear here once available' }}</p>
    @if(!empty($emptyAction))
        {!! $emptyAction !!}
    @endif
</div>

{{-- Reusable page header partial: $pageTitle, $pageSubtitle, $pageIcon, $pageAction (optional HTML) --}}
<div class="row mb-4">
    <div class="col-12 d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div>
            <h2 class="fw-bold mb-1">
                <i class="bi bi-{{ $pageIcon ?? 'shield' }} text-primary me-2"></i>{{ $pageTitle ?? 'Page' }}
            </h2>
            @if(!empty($pageSubtitle))
            <p class="text-muted small mb-0">{{ $pageSubtitle }}</p>
            @endif
        </div>
        @if(!empty($pageAction))
            {!! $pageAction !!}
        @endif
    </div>
</div>

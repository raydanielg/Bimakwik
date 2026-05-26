<div class="text-center py-5">
    <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
        <i class="bi {{ $icon ?? 'bi-inbox' }} text-muted fs-2"></i>
    </div>
    <h5 class="fw-bold mb-2">{{ $title ?? 'No Data Found' }}</h5>
    <p class="text-muted mb-0">{{ $text ?? 'There is no data to display at this time.' }}</p>
    @if(isset($action))
        <div class="mt-3">{{ $action }}</div>
    @endif
</div>

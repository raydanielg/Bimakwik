<nav aria-label="breadcrumb" class="mb-1">
    <ol class="breadcrumb mb-0" style="font-size: 0.75rem;">
        <li class="breadcrumb-item">
            <a href="{{ route('broker.dashboard') }}" class="text-decoration-none text-muted">
                <i class="bi bi-house-door me-1"></i>Broker
            </a>
        </li>
        <li class="breadcrumb-item active fw-semibold" aria-current="page" style="color:#d946ef;">{{ $title }}</li>
    </ol>
</nav>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1">{{ $title }}</h2>
        <p class="text-muted mb-0">{{ $subtitle }}</p>
    </div>
    @if(isset($action))
        {{ $action }}
    @endif
</div>

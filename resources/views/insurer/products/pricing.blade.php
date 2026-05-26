@extends('layouts.dashboard')
@section('dashboard_content')
@include('insurer._partials.page-header', ['pageTitle' => 'Pricing & Calculation Rules', 'pageSubtitle' => 'Premium calculation rules and age range factors', 'pageIcon' => 'calculator'])
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        @if($rules->count() > 0)
        <div class="table-responsive"><table class="table table-hover mb-0"><thead class="table-light"><tr><th>Rule Name</th><th>Formula</th><th>Status</th><th>Updated</th></tr></thead><tbody>
            @foreach($rules as $rule)
            <tr><td class="fw-semibold">{{ $rule->name ?? 'Rule' }}</td><td><code class="small">{{ $rule->formula ?? '—' }}</code></td><td><span class="badge bg-success bg-opacity-10 text-success">Active</span></td><td class="small text-muted">{{ optional($rule->updated_at)->diffForHumans() ?? '—' }}</td></tr>
            @endforeach
        </tbody></table></div>
        <div class="p-3">{{ $rules->links() }}</div>
        @else
        @include('insurer._partials.empty-state', ['emptyIcon' => 'calculator', 'emptyTitle' => 'No pricing rules', 'emptyText' => 'Add premium calculation rules for products'])
        @endif
    </div>
</div>
@endsection

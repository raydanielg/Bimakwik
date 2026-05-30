@extends('layouts.dashboard')

@section('content')
@php
    $documents = collect($customerDocuments ?? []);
    $pick = function ($row, $keys, $default = '-') {
        foreach ($keys as $key) {
            if (isset($row[$key]) && $row[$key] !== null && $row[$key] !== '') {
                return $row[$key];
            }
        }
        return $default;
    };
@endphp
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="fw-bold">{{ __('customer.documents_title') }}</h4>
            <p class="text-muted small">{{ __('customer.documents_subtitle') }}</p>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <div class="list-group list-group-flush">
                        @forelse($documents as $document)
                            @php
                                $updatedRaw = $pick($document, ['updated_at', 'created_at', 'uploaded_at'], null);
                                $updated = $updatedRaw;
                                try {
                                    $updated = $updatedRaw ? \Carbon\Carbon::parse($updatedRaw)->format('d M Y') : '-';
                                } catch (\Throwable $e) {
                                    $updated = $updatedRaw ?: '-';
                                }
                                $downloadUrl = $pick($document, ['download_url', 'file_url', 'url'], '#');
                            @endphp
                            <div class="list-group-item d-flex justify-content-between align-items-center px-0 py-3">
                                <div>
                                    <h6 class="mb-1">{{ $pick($document, ['title', 'document_name', 'name']) }}</h6>
                                    <small class="text-muted">{{ __('customer.updated') }}: {{ $updated }}</small>
                                </div>
                                <a href="{{ $downloadUrl }}" class="btn btn-sm btn-outline-primary">{{ __('customer.download_pdf') }}</a>
                            </div>
                        @empty
                            <div class="text-center text-muted py-4">{{ __('customer.no_documents') }}</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@php
    $isFiltering = !empty(array_filter(request()->except('page')));
@endphp

@props([
    'addLink' => null,
    'addDescription' => null,
    'formAction' => null,
])

<x-box>
    <div class="d-flex justify-content-between">
        <button
            class="btn btn-sm btn-outline-dark"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#pageFilters"
            aria-expanded="false"
            aria-controls="pageFilters"
        >
            <i class="ph ph-funnel"></i> Filtros
        </button>
        @if ($addLink && $addDescription)
            <a href="{{ $addLink }}" class="btn btn-sm btn-outline-success">
                <i class="ph ph-plus"></i> {{ $addDescription }}
            </a>
        @endif
    </div>
    <div class="collapse {{ $isFiltering ? 'show' : '' }}" id="pageFilters">
        <form action="{{ $formAction }}" method="GET">
            {{ $slot }}
            <div class="d-flex justify-content-end">
                @if($isFiltering)
                    <a href="{{ $formAction }}" class="btn btn-link text-dark me-2">
                        <i class="ph ph-trash"></i> Limpar filtro
                    </a>
                @endif
                <button type="submit" class="btn btn-dark">
                    Filtrar
                </button>
            </div>
        </form>
    </div>
</x-box>
@if ($paginator->hasPages())
    <div class="pagination-inner">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="page-link page-arrow disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">&lsaquo;</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="page-link page-arrow" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="page-link disabled" aria-disabled="true">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="page-link active" aria-current="page">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="page-link page-arrow" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
        @else
            <span class="page-link page-arrow disabled" aria-disabled="true" aria-label="@lang('pagination.next')">&rsaquo;</span>
        @endif
    </div>
@endif

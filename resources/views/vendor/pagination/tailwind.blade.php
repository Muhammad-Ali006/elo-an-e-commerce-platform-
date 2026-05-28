@if ($paginator->hasPages())
    <div class="pagination-inner">
        @if ($paginator->onFirstPage())
            <span class="page-link page-arrow disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <svg class="page-arrow-icon" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="page-link page-arrow" rel="prev" aria-label="@lang('pagination.previous')">
                <svg class="page-arrow-icon" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
            </a>
        @endif

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

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="page-link page-arrow" rel="next" aria-label="@lang('pagination.next')">
                <svg class="page-arrow-icon" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" /></svg>
            </a>
        @else
            <span class="page-link page-arrow disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <svg class="page-arrow-icon" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" /></svg>
            </span>
        @endif
    </div>
@endif

{{-- USER PROMPT: "yr ya ui q kharab hai" --}}
@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="admin-pagination-wrapper">
        <div class="admin-pagination-info">
            Showing <strong>{{ $paginator->firstItem() }}</strong> to <strong>{{ $paginator->lastItem() }}</strong> of <strong>{{ $paginator->total() }}</strong> results
        </div>
        <ul class="admin-pagination-list">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled" aria-disabled="true"><span><i class="fa-solid fa-angle-left"></i></span></li>
            @else
                <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="fa-solid fa-angle-left"></i></a></li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active" aria-current="page"><span>{{ $page }}</span></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li><a href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="fa-solid fa-angle-right"></i></a></li>
            @else
                <li class="disabled" aria-disabled="true"><span><i class="fa-solid fa-angle-right"></i></span></li>
            @endif
        </ul>
    </nav>
@endif

@if ($paginator->hasPages())
    <nav class="flex justify-center items-center py-2 mb-6">
        <ul class="flex">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li>
                    <span class="block border px-4 py-2 cursor-not-allowed">&lsaquo;</span>
                </li>
            @else
                <li>
                    <a class="block border px-4 py-2" href="{{ $paginator->previousPageUrl() }}" rel="prev">&lsaquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li><span class="block border-t border-b border-r px-4 py-2 cursor-not-allowed">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li><span class="pagination-current block border-t border-b border-r px-4 py-2">{{ $page }}</span></li>
                        @else
                            <li><a class="block border-t border-b border-r px-4 py-2" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a class="block border-t border-b border-r px-4 py-2" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
            @else
                <li>
                    <span class="block border-t border-b border-r px-4 py-2 cursor-not-allowed">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif

@php
    $isTryOutPage = Route::currentRouteName() === 'tryout-utbk';
@endphp
@if ($paginator->hasPages())
    <nav>
        <ul class="rbt-pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled">
                    <a aria-label="Previous">
                        <i class="feather-chevron-left"></i>
                    </a>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }} @if($isTryOutPage) #tryout @endif" rel="prev">
                        <i class="feather-chevron-left"></i>
                    </a>
                </li>
            @endif
            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled"><a>{{ $element }}</a></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        {{-- Show only 1 pages before and 2 page after current page --}}
                        @if ($page >= $paginator->currentPage() - 1 && $page <= $paginator->currentPage() + 2)
                            @if ($page == $paginator->currentPage())
                                <li class="active"><a>{{ $page }}</a></li>
                            @else
                                <li><a href="{{ $url }} @if($isTryOutPage) #tryout @endif">{{ $page }}</a></li>
                            @endif
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a aria-label="Next" href="{{ $paginator->nextPageUrl() }} @if($isTryOutPage) #tryout @endif">
                        <i class="feather-chevron-right"></i>
                    </a>
                </li>
            @else
                <li class="disabled">
                    <a aria-label="Next">
                        <i class="feather-chevron-right"></i>
                    </a>
                </li>
            @endif
        </ul>
    </nav>
@endif

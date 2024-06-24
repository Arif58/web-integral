@if ($paginator->hasPages())
    <nav>
        <ul class="rbt-pagination">
            @if ($paginator->onFirstPage())
                <li class="disabled">
                    <a aria-label="Previous">
                        <i class="feather-chevron-left"></i>
                    </a>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{$paginator->previousPageUrl()}}" rel="prev">
                    <i class="feather-chevron-left"></i>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="page-item disabled"><a>{{$element}}</a></li>
                @endif
                
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active"><a>{{$page}}</a></li>
                        @else
                            <li><a href="{{$url}}">{{$page}}</a></li>
                        @endif
                    @endforeach
                @endif

                @if($paginator->hasMorePages())
                    <li>
                        <a aria-label="Next" href="{{$paginator->nextPageUrl()}}">
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
            @endforeach
        </ul>
    </nav>
@endif
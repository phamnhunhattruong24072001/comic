@push('css')
    <style>
        .pagination li {
            color: black;
            float: left;
            padding: 8px 16px;
            text-decoration: none;
        }
        .pagination .active{
            background: #2A3F54;
            color: #FFF;
        }
        .pagination li .fa{
            font-size: 20px;
        }
    </style>
@endpush
@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled" aria-disabled="true" aria-label="@lang('common.pagination.pre')">
                    <span aria-hidden="true"><i class="fa fa-caret-left" aria-hidden="true"></i></span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('common.pagination.pre')"><i class="fa fa-caret-left" aria-hidden="true"></i></a>
                </li>
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
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('common.pagination.next')"><i class="fa fa-caret-right" aria-hidden="true"></i></a>
                </li>
            @else
                <li class="disabled" aria-disabled="true" aria-label="@lang('common.pagination.next')">
                    <span aria-hidden="true"><i class="fa fa-caret-right" aria-hidden="true"></i></span>
                </li>
            @endif
        </ul>
    </nav>
@endif

@if ($paginator->total() > $paginator->perPage())
    <nav class="d-flex justify-content-center mt-3">
        <ul class="pagination">
            @if ($paginator->onFirstPage())
                <li class="page-item m-0"><a class="page-link disabled bg-transparent fs-10"><span class="fas fa-chevron-left"></span></a></li>
            @else
                <li class="page-item m-0"><a class="page-link fs-10" href="{{ $paginator->previousPageUrl() }}"><span class="fas fa-chevron-left"></span></a></li>
            @endif
            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item m-0">
                        <button class="page-link disabled bg-transparent fs-10">{{ $element }}</a>
                    </li>
                @endif
                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active m-0" aria-current="page">
                                <span class="page-link fs-10">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item m-0">
                                <a class="page-link fs-10" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach
            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item m-0">
                    <a class="page-link fs-10" href="{{ $paginator->nextPageUrl() }}"><span class="fas fa-chevron-right"></span></a>
                </li>
            @else
                <li class="page-item m-0">
                    <a class="page-link disabled bg-transparent fs-10" href=""><span class="fas fa-chevron-right"></span></a>
                </li>
            @endif
        </ul>
    </nav>
@endif

@if ($paginator->hasPages())
    <nav class="d-flex justify-items-center justify-content-between">
        <div class="d-flex justify-content-between flex-fill d-sm-none">
            <ul class="pagination">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                @else
                    <a class="page-item page_item_custom" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                        <li>
                            <i class="fa fa-chevron-left" aria-hidden="true"></i>
                        </li>
                    </a>
                @endif

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <a class="page-item page_item_custom" href="{{ $paginator->nextPageUrl() }}" rel="next">
                        <li>
                            <i class="fa fa-chevron-right" aria-hidden="true"></i>
                        </li>
                    </a>
                @else
                @endif
            </ul>
        </div>

        <div class="d-none flex-sm-fill d-sm-flex align-items-sm-center justify-content-sm-between">
            <div>
                <p class="small text-muted">
                    {!! __('Mostra da ') !!}
                    <span class="fw-semibold">{{ $paginator->firstItem() }}</span>
                    {!! __('a') !!}
                    <span class="fw-semibold">{{ $paginator->lastItem() }}</span>
                    {!! __('su') !!}
                    <span class="fw-semibold">{{ $paginator->total() }}</span>
                    {!! __('risultati') !!}
                </p>
            </div>

            <div>
                <ul class="pagination d-flex gap-2 align-items-center">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                    @else
                        <a class="page-item page_item_custom" href="{{ $paginator->previousPageUrl() }}" rel="prev"
                            aria-label="@lang('pagination.previous')">
                            <li>
                                <i class="fa fa-chevron-left" aria-hidden="true"></i>
                            </li>
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <li class="page-item disabled" aria-disabled="true">
                                <span class="page-link">
                                    {{ $element }}
                                </span>
                            </li>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li class="page-item page_item_custom" style="background-color: #1e1e1e"
                                        aria-current="page">
                                        <span>{{ $page }}</span>
                                    </li>
                                @else
                                    <a class="page-item other_page" href="{{ $url }}">
                                        <li>
                                            {{ $page }}
                                        </li>
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a class="page-item page_item_custom" href="{{ $paginator->nextPageUrl() }}" rel="next"
                            aria-label="@lang('pagination.next')">
                            <li>
                                <i class="fa fa-chevron-right" aria-hidden="true"></i>
                            </li>
                        </a>
                    @else
                    @endif
                </ul>
            </div>
        </div>
    </nav>
@endif

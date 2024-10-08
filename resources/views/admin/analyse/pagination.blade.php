<div class="ana_pagination_area">
    <div class="ana_pagination_box">
        <div style="margin-right: 1em">{{ $paginator->currentPage() }}/{{ $paginator->lastPage() }}ページ</div>
        @if ($paginator->hasPages())
            <div>
                <ul class="ana_pagination">
                    {{-- prev --}}
                    @if ($paginator->onFirstPage())
                        <li class="ana_pagination_link ana_pagination_prev_link ana_pagination_disabled"
                            aria-disabled="true">
                            <span>＜</span>
                        </li>
                    @else
                        <li class="ana_pagination_link ana_pagination_prev_link">
                            <a class="ana_pagination_enabled" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                                ＜
                            </a>
                        </li>
                    @endif

                    {{-- next --}}
                    @if ($paginator->hasMorePages())
                        <li class="ana_pagination_link ana_pagination_next_link">
                            <a class="ana_pagination_enabled" href="{{ $paginator->nextPageUrl() }}" rel="next">
                                ＞
                            </a>
                        </li>
                    @else
                        <li class="ana_pagination_link ana_pagination_next_link ana_pagination_disabled"
                            aria-disabled="true">
                            <span>＞</span>
                        </li>
                    @endif
                </ul>
            </div>
        @endif
    </div>
</div>

@if ($paginator->hasPages())
    <ul class="pagination_list d-flex align-items-center justify-content-end flex-wrap-wrap g-sm">

        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <svg width="8" height="14" viewBox="0 0 8 14" fill="none"
            xmlns="http://www.w3.org/2000/svg">
                <path d="M6.91675 12.8334L1.08341 7.00002L6.91675 1.16669" stroke="#424C60"
                    stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        @else
            <li>
                <button type="button" dusk="previousPage" wire:click="previousPage" wire:loading.attr="disabled" rel="prev" aria-label="@lang('pagination.previous')" >
                    <svg width="8" height="14" viewBox="0 0 8 14" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M6.91675 12.8334L1.08341 7.00002L6.91675 1.16669" stroke="#424C60"
                            stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($paginator->currentPage() > 3 && $page == 2)
                    ⋯
                    @endif
                    @if ($page == $paginator->currentPage())
                        <li class="active_pagination"><a href="#" wire:click.prevent="gotoPage({{$page}})">{{$page}}</a></li>
                    @elseif ($page == $paginator->currentPage() + 1 || $page == $paginator->currentPage() + 2 || $page == $paginator->currentPage() - 2 || $page == $paginator->currentPage() - 1 || $page == $paginator->lastPage() || $page == 1)
                        <li><a href="#" wire:click.prevent="gotoPage({{$page}})">{{$page}}</a></li>
                    @endif
                    @if ($paginator->currentPage() < $paginator->lastPage() - 2 && $page == $paginator->lastPage() - 1)
                    ⋯
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li>
                <button type="button" dusk="nextPage" wire:click="nextPage" wire:loading.attr="disabled">
                    <svg width="8" height="14" viewBox="0 0 8 14" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1.08325 1.16665L6.91659 6.99998L1.08325 12.8333" stroke="#424C60"
                            stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </li>
        @else
            <svg width="8" height="14" viewBox="0 0 8 14" fill="none"
            xmlns="http://www.w3.org/2000/svg">
                <path d="M1.08325 1.16665L6.91659 6.99998L1.08325 12.8333" stroke="#424C60"
                    stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        @endif

    </ul>
@endif

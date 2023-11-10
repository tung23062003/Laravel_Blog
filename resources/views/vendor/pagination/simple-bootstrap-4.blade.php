@if ($paginator->hasPages())
    <nav>
        <ul class="pagination" style="display: flex; justify-content: center; gap: 10px; margin-top: 20px;">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" style="background-color: rgb(255, 175, 175); color: white; width: 80px; cursor: no-drop; text-align: center">
                    <span class="page-link">@lang('pagination.previous')</span>
                </li>
            @else
                <li class="page-item" style="background-color: red; color: white; width: 80px; text-align: center">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a>
                </li>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item" style="background-color: red; color: white; width: 80px; cursor: no-drop; text-align: center">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" style="background-color: rgb(255, 175, 175); color: white; width: 80px; cursor: no-drop; text-align: center">
                    <span class="page-link">@lang('pagination.next')</span>
                </li>
            @endif
        </ul>
    </nav>
@endif

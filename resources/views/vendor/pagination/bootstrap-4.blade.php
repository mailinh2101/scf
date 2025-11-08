@if ($paginator->hasPages())
    <div class="col-lg-12">
        <div class="space20"></div>
        <div class="pagination-area">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <li class="page-item disabled">
                            <span class="page-link" aria-label="Previous">
                                <i class="fa-solid fa-angle-left"></i>
                            </span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev"
                                aria-label="Previous">
                                <i class="fa-solid fa-angle-left"></i>
                            </a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li class="page-item"><a class="page-link active"
                                            href="#">{{ $page }}</a></li>
                                @else
                                    <li class="page-item"><a class="page-link"
                                            href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <li class="page-item">
                            <a class="page-link m-0" href="{{ $paginator->nextPageUrl() }}" rel="next"
                                aria-label="Next">
                                <i class="fa-solid fa-angle-right"></i>
                            </a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <span class="page-link m-0" aria-label="Next">
                                <i class="fa-solid fa-angle-right"></i>
                            </span>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
@endif

<style>
    .pagination {
        display: flex;
        gap: 8px;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .page-item {
        display: inline-block;
    }

    .page-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        padding: 0;
        border: 2px solid #C0F037;
        background-color: transparent;
        color: #C0F037;
        text-decoration: none;
        border-radius: 4px;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .page-link:hover {
        background-color: #C0F037;
        color: #000;
    }

    .page-item.active .page-link {
        background-color: #C0F037;
        color: #000;
        border-color: #C0F037;
    }

    .page-item.disabled .page-link {
        border-color: #666;
        color: #666;
        cursor: not-allowed;
        background-color: transparent;
    }

    @media (max-width: 768px) {
        .page-link {
            width: 36px;
            height: 36px;
            font-size: 12px;
        }
    }
</style>

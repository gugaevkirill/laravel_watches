@if ($paginator->lastPage() > 1)
    @for ($i = 1; $i <= $paginator->lastPage(); $i++)
        @if (abs($i - $paginator->currentPage()) <= 1
            || $i == 1
            || $i == $paginator->lastPage()
        )
        <a class="square-button @if ($paginator->currentPage() == $i) active @endif ">{{ $i }}</a>
        @else
        <div class="divider">...</div>
        @endif
    @endfor
@endif
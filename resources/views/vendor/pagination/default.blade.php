@if ($paginator->hasPages())
    <ul class="pagination">

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active"><span>&nbsp;&nbsp;</span></li>
                    @else
                        <li><a href="{{ $url }}">&nbsp;&nbsp;</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

    </ul>
@endif

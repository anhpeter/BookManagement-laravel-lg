<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
    @if ($hasBtn())
        <a href="{{ $btnLink }}" class="d-none d-sm-inline-block btn btn-sm btn-{{ $color }} shadow-sm">
            @if ($btnIcon !== '')
                <i class="fas {{ $btnIcon }} fa-sm  fw"></i>
            @endif
            {{ $btnContent }}
        </a>
    @endif

</div>

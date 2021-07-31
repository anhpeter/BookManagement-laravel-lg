@php
$color = $color ?? 'primary';
$title = $title ?? 'Title';
$btnIcon = $btnIcon ?? '';
$btnContent = $btnContent ?? '';
$btnLink = $btnLink ?? '#';
@endphp
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
    @if ($btnIcon !== '' || $btnContent !== '')
        <a href="{{ $btnLink }}" class="d-none d-sm-inline-block btn btn-sm btn-{{ $color }} shadow-sm">
            @if ($btnIcon !== '')
                <i class="fas {{ $btnIcon }} fa-sm text-white-50"></i>
            @endif
            {{ $btnContent }}
        </a>
    @endif

</div>

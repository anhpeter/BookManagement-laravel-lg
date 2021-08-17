@php
$type = Session::get('type', 'dark');
@endphp
@if (Session::has('message'))
    <div class="toast bg-{{ $type }}" style="position: absolute; top: 10px; right: 10px; z-index:1000"
        data-autohide="false">
        <div class="toast-header bg-{{ $type }} d-flex justify-content-end">
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span class="text-light" aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body bg-{{ $type }} text-light">
            {{ Session::get('message') }}
        </div>
    </div>
@endif

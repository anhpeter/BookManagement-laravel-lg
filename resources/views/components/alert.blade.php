<div>
    <div class="alert alert-{{ $type }}" role="alert">
        @if ($title != null)
            <h4 class="alert-heading">{{ $title }}</h4>
        @endif
        <p>{{ $message }}</p>
    </div>
</div>

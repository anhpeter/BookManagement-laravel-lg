<div class="action-container">
    @foreach ($template as $key => $item)
        @if ($key !== 'delete')
            @if ($controller == 'user' && $key == 'view')
                <a href="{{ route('profiles.show', ['profile' => $id]) }}" class="{{ $item['class'] }}"
                    data-toggle="tooltip" title="{{ $item['content'] }}">
                    <i class="{{ $item['icon'] }}"></i>
                </a>
            @else
                <a href="{{ route(MyHelper::toPlural($controller) . '.' . $item['route'], [$controller => $id]) }}"
                    class="{{ $item['class'] }}" data-toggle="tooltip" title="{{ $item['content'] }}">
                    <i class="{{ $item['icon'] }}"></i>
                </a>
            @endif
        @else
            <form class="delete-item-form"
                action="{{ route(MyHelper::toPlural($controller) . '.destroy', [$controller => $id]) }}" method="post"
                data-item-name="{{ $name }}">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button type="submit" class="{{ $item['class'] }}" data-toggle="tooltip"
                    title="{{ $item['content'] }}">
                    <i class="{{ $item['icon'] }}"></i>
                </button>
            </form>
        @endif

    @endforeach


</div>

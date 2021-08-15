<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Price</th>
            <th scope="col">Qty</th>
            <th scope="col">Total price</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($order->books as $i => $item)
            <tr>
                <th scope="row">{{ $i + 1 }}</th>
                <td>
                    <a href="{{ route('books.edit', ['book' => $item->id])}}" >
                        {{ $item->title }}
                    </a>
                </td>
                <td>{{ MyHelper::priceFormat($item->pivot->price) }}</td>
                <td>{{ $item->pivot->qty }}</td>
                <td>{{ MyHelper::priceFormat($item->pivot->price * $item->pivot->qty) }}</td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="4"></td>
            <th colspan="1000">Total: {{ MyHelper::priceFormat($getTotal()) }}</th>
        </tr>
    </tfoot>
</table>

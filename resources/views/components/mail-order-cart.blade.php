@php
$tdStyle = 'border: 1px solid #dddddd; text-align: left; padding: 8px;color: black; padding: 10px;';
@endphp
<table  style="border-collapse:collapse">
    <thead>
        <tr>
            <th style="{{ $tdStyle }}" scope="col">#</th>
            <th style="{{ $tdStyle }}" scope="col">Title</th>
            <th style="{{ $tdStyle }}" scope="col">Price</th>
            <th style="{{ $tdStyle }}" scope="col">Qty</th>
            <th style="{{ $tdStyle }}" scope="col">Total price</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($order->books as $i => $item)
            <tr>
                <th style="{{ $tdStyle }}" scope="row">{{ $i + 1 }}</th>
                <td style="{{ $tdStyle }}"> {{ $item->title }} </td>
                <td style="{{ $tdStyle }}">{{ MyHelper::priceFormat($item->pivot->price) }}</td>
                <td style="{{ $tdStyle }}">{{ $item->pivot->qty }}</td>
                <td style="{{ $tdStyle }}">{{ MyHelper::priceFormat($item->pivot->price * $item->pivot->qty) }}
                </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td style="{{ $tdStyle }}" colspan="4"></td>
            <th style="{{ $tdStyle }} font-weight:bold" colspan="1000">Total:
                {{ MyHelper::priceFormat($getTotal()) }}</th>
        </tr>
    </tfoot>
</table>

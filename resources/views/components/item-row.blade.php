@php
    $badge = match ($status) {
        'available' => [
            'color' => '#008236',
            'bg' => '#DBFCE7',
            'border' => '#7CF1A8',
        ],
        'low stock' => [
            'color' => '#BB4D00',
            'bg' => '#FEF3C6',
            'border' => '#FFD231',
        ],
        'out of stock' => [
            'color' => '#B52C30',
            'bg' => '#FCCCD3',
            'border' => '#F42140',
        ],
    };
@endphp
<tr>
    <th scope="row"></th>
    <td>{{ $category }}</td>
    <td class="text-center">{{ $quantity }}</td>
    <td class="text-center">
        <p class="badge px-2 my-2"
            style="color: {{ $badge['color'] }}; background: {{ $badge['bg'] }}; border: solid 1px {{ $badge['border'] }};">
            {{ $status }}</p>
    </td>
</tr>

@php
    $badge = match (trim($status)) {
        'Available' => [
            'color' => '#008236',
            'bg' => '#DBFCE7',
            'border' => '#7CF1A8',
        ],
        'Low Stock' => [
            'color' => '#BB4D00',
            'bg' => '#FEF3C6',
            'border' => '#FFD231',
        ],
        'Out of Stock' => [
            'color' => '#B52C30',
            'bg' => '#FCCCD3',
            'border' => '#F42140',
        ],
        default => [
            'color' => 'white',
            'bg' => 'gray',
            'border' => 'black',
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

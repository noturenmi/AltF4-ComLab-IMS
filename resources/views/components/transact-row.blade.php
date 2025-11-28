@php
    $badge = match ($action) {
        'create' => [
            'color' => '#008236',
            'bg' => '#DBFCE7',
            'border' => '#7CF1A8',
        ],
        'edit' => [
            'color' => '#7A1FA2',
            'bg' => '#F3EAFD',
            'border' => '#C084E6',
        ],
        'delete' => [
            'color' => '#B52C30',
            'bg' => '#FCCCD3',
            'border' => '#F42140',
        ],
    };
@endphp
<tr>
    <th scope="row"></th>
    <td class="text-center">
        <p class="badge px-2 my-2"
            style="color: {{ $badge['color'] }}; background: {{ $badge['bg'] }}; border: solid 1px {{ $badge['border'] }};">
            {{ $action }}</p>
    </td>
    <td>{{ $desc }}</td>
    <td class="text-center">{{ $timestamp }}</td>
    <td class="text-center">{{ $user }}</td>
</tr>

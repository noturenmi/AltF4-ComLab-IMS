@php
    $badge = match (trim($transaction->type)) {
        'CREATE' => [
            'color' => '#008236',
            'bg' => '#DBFCE7',
            'border' => '#7CF1A8',
        ],
        'UPDATE' => [
            'color' => '#7A1FA2',
            'bg' => '#F3EAFD',
            'border' => '#C084E6',
        ],
        'DELETE' => [
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
            {{ $transaction->type }}</p>
    </td>
    <td>{{ $transaction->remarks }}</td>
    <td class="text-center">{{ $transaction->created_at }}</td>
    <td class="text-center">{{ join(' ', $transaction->user->makeHidden('id')->toArray()) }}</td>
</tr>

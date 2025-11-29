@php
    $badge = match (trim($status)) {
        'Active' => [
            'color' => '#008236',
            'bg' => '#DBFCE7',
            'border' => '#7CF1A8',
        ],
        'Inactive' => [
            'color' => '#364153',
            'bg' => '#F3F4F6',
            'border' => '#D1D5DC',
        ],
        'Maintenance' => [
            'color' => '#BB4D00',
            'bg' => '#FEF3C6',
            'border' => '#FFD231',
        ],
    };
@endphp

<tr>
    <th scope='row'>{{ $name }}</th>
    <td>{{ $lab }}</td>
    <td class="text-secondary">{{ $model }}</td>
    <td class="text-center">
        <p class="badge rounded px-2"
            style="color: {{ $badge['color'] }}; background: {{ $badge['bg'] }}; border: solid 1px {{ $badge['border'] }};">
            {{ $status }}</p>
    </td>
    <td class="text-secondary text-center">{{ $assignedDate }}</td>
    <td>
        <div class="d-flex flex-wrap justify-content-center">
            <a href="" class="btn btn-outline-primary mx-1">
                <i class="bi bi-pencil"></i>
            </a>
            <a href="" class="btn btn-outline-danger mx-2">
                <i class="bi bi-trash"></i>
            </a>
        </div>
    </td>
</tr>

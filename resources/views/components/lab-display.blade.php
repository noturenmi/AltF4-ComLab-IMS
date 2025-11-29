@php
    $statusColor = match ($status) {
        'Available' => '#A0C196',
        'Maintenance' => '#364153',
        'Occupied' => '#DB9F9C',
    };

    $compStatuses = [
        'Computers' => $computerCount,
        'Active' => $activeCount,
        'Inactive' => $inactiveCount,
        'Maintenance' => $maintenanceCount,
    ];
@endphp

<div class="card h-100 shadow" style="min-width: 25rem;">
    <div class="card-body">
        <div class="d-flex flex-wrap justify-content-between align-items-baseline">
            <h5 class="card-title mb-3 mt-2 fw-bold" style="color:#363E77;">{{ $label }}</h5>
            <div class="rounded-pill px-4 pt-2" style="background: {{ $statusColor }};">
                <h6 class="text-light fw-bold">{{ $status }}</h6>
            </div>
        </div>

        <div class="d-flex flex-wrap gap-3 mt-2 justify-content-evenly align-items-stretch">

            @foreach ($compStatuses as $compStatus => $count)
                <div class="card h-100" style="min-width: 10rem">
                    <div class="card-body" style="background: #D9D9D9; box-shadow: inset 0 1px 2px #000000A0;">
                        <h6 class="text-center">{{ $compStatus }}</h6>
                        <h1 class="text-center fw-bold" style="color: #23355D;">{{ $count }}</h1>
                    </div>
                </div>
            @endforeach

        </div>

        <div class="d-flex justify-content-evenly gap-3 my-3">
            <a href="" class="btn btn-outline-primary rounded-pill px-4">
                <i class="bi bi-pencil-square"></i> Edit</a>
            <a href="" class="btn btn-outline-danger rounded-pill px-3">
                <i class="bi bi-trash"></i> Delete</a>
        </div>
    </div>
</div>

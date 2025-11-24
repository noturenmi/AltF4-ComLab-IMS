@php
    $statusColor = match ($status) {
        'Active' => '#A0C196',
        'Maintenance' => '#DB9F9C',
    };
@endphp

<div class="card h-100" style="min-width: 25rem;">
    <div class="card-body">
        <div class="d-flex flex-wrap justify-content-between align-items-baseline">
            <h5 class="card-title mb-3 mt-2 fw-bold" style="color:#363E77;">LABORATORY {{ $label }}</h5>
            <div class="rounded-pill px-4 pt-2" style="background: {{ $statusColor }};">
                <h6 class="text-light fw-bold">{{ $status }}</h6>
            </div>
        </div>

        <div class="d-flex gap-3 mt-2">
            <div class="card h-100 w-50">
                <div class="card-body" style="background: #D9D9D9; box-shadow: inset 0 1px 2px #000000A0;">
                    <h6 class="text-center">Computers</h6>
                    <h1 class="text-center fw-bold" style="color: #23355D;">{{ $computerCount }}</h1>
                </div>
            </div>
            <div class="card h-100 w-50">
                <div class="card-body" style="background: #D9D9D9; box-shadow: inset 0 1px 2px #000000A0;">
                    <h6 class="text-center">Items</h6>
                    <h1 class="text-center fw-bold" style="color: #23355D;">{{ $itemCount }}</h1>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-evenly gap-3 my-3">
            <a href="" class="btn rounded-pill" style="background: #D9D9D9; color: #2F3E80;">
                <i class="bi bi-pencil-square"></i> Edit</a>
            <a href="" class="btn rounded-pill" style="background: #D9D9D9; color: #A82922;">
                <i class="bi bi-trash"></i> Delete</a>
        </div>
    </div>
</div>

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

<div class="card h-100 shadow" style="max-width: 25rem;">
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
            <a href="{{ route('laboratories.edit', ['id' => $id]) }}" class="btn btn-outline-primary rounded-pill px-4">
                <i class="bi bi-pencil-square"></i> Edit</a>

            @if (auth()->user()->role == 'admin')
                <button class="btn btn-outline-danger rounded-pill px-3" data-bs-toggle="modal"
                    data-bs-target="#delete-lab-{{ $id }}">
                    <i class="bi bi-trash"></i> Delete</button>

                <div class="modal fade" id="delete-lab-{{ $id }}" tabindex="-1"
                    aria-labelledby="delete-lab-{{ $id }}-label" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="delete-lab-{{ $id }}-label">Delete Laboratory?
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="delete-lab-{{ $id }}-form"
                                    action="{{ route('laboratory.delete', ['id' => $id]) }}" method="POST"
                                    style="display: none;">
                                    @method('DELETE')
                                    @csrf
                                </form>
                                <h3>Are you sure you want to delete <strong>{{ $label }}</strong>?</h3>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" form="delete-lab-{{ $id }}-form"
                                    class="btn btn-danger">Delete Laboratory</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

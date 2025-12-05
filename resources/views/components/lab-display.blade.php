@php
    $statusColor = match (trim($laboratory->status)) {
        'Available' => '#A0C196',
        'Maintenance' => '#364153',
        'Occupied' => '#DB9F9C',
    };

    $statuses = [
        'Computers' => $laboratory->computers->count(),
        'Active' => $laboratory->active_count,
        'Inactive' => $laboratory->inactive_count,
        'Maintenance' => $laboratory->maintenance_count,
    ];
@endphp

<div class="card h-100 shadow" style="max-width: 25rem;">
    <div class="card-body">
        <div class="d-flex flex-wrap justify-content-between align-items-baseline">
            <h5 class="card-title mb-3 mt-2 fw-bold" style="color:#363E77;">{{ $laboratory->name }}</h5>
            <div class="rounded-pill px-4 pt-2" style="background: {{ $statusColor }};">
                <h6 class="text-light fw-bold">{{ $laboratory->status }}</h6>
            </div>
        </div>

        <div class="d-flex flex-wrap gap-3 mt-2 justify-content-evenly align-items-stretch">

            @foreach ($statuses as $status => $count)
                <div class="card h-100" style="min-width: 10rem">
                    <div class="card-body" style="background: #D9D9D9; box-shadow: inset 0 1px 2px #000000A0;">
                        <h6 class="text-center">{{ $status }}</h6>
                        <h1 class="text-center fw-bold" style="color: #23355D;">{{ $count }}</h1>
                    </div>
                </div>
            @endforeach

        </div>

        <div class="d-flex justify-content-evenly gap-3 my-3">
            <a href="{{ route('laboratories.edit', $laboratory) }}" class="btn btn-outline-primary rounded-pill px-4">
                <i class="bi bi-pencil-square"></i> Edit</a>

            @if (auth()->user()->role == 'admin')
                <button class="btn btn-outline-danger rounded-pill px-3" data-bs-toggle="modal"
                    data-bs-target="#delete-lab-{{ $laboratory->id }}">
                    <i class="bi bi-trash"></i> Delete</button>

                <div class="modal fade" id="delete-lab-{{ $laboratory->id }}" tabindex="-1"
                    aria-labelledby="delete-lab-{{ $laboratory->id }}-label" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="delete-lab-{{ $laboratory->id }}-label">Delete Laboratory?
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="delete-lab-{{ $laboratory->id }}-form"
                                    action="{{ route('laboratories.destroy', $laboratory) }}" method="POST"
                                    style="display: none;">
                                    @method('DELETE')
                                    @csrf
                                </form>
                                <h3>Are you sure you want to delete <strong>{{ $laboratory->name }}</strong>?</h3>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" form="delete-lab-{{ $laboratory->id }}-form"
                                    class="btn btn-danger">Delete Laboratory</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

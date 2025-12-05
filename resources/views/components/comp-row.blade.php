@php
    $badge = match (trim($computer->status)) {
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

    $statuses = ['Active', 'Inactive', 'Maintenance'];
@endphp

<tr>
    <th scope='row'>{{ $computer->name }}</th>
    @if (!request()->segment(2) || !is_numeric(request()->segment(2)))
        <td>{{ $computer->laboratory?->name ?: '' }}</td>
    @endif
    <td class="text-secondary">{{ $computer->model }}</td>
    <td class="text-center">
        <p class="badge rounded px-2 mt-3"
            style="color: {{ $badge['color'] }}; background: {{ $badge['bg'] }}; border: solid 1px {{ $badge['border'] }};">
            {{ $computer->status }}</p>
    </td>
    <td class="text-secondary text-center">{{ $computer->assigned_date }}</td>
    <td>
        <div class="d-flex flex-wrap justify-content-center">
            <button class="btn btn-outline-primary mx-1" data-bs-toggle="modal"
                data-bs-target="#edit-comp-{{ $computer->id }}">
                <i class="bi bi-pencil"></i></button>

            <div class="modal fade" id="edit-comp-{{ $computer->id }}" tabindex="-1"
                aria-labelledby="edit-comp-{{ $computer->id }}-label" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="edit-comp-{{ $computer->id }}-label">Edit
                                {{ $computer->name }}
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="edit-comp-{{ $computer->id }}-form"
                                action="{{ route('computers.update', $computer) }}" method="POST"
                                class="d-flex flex-column gap-3">
                                @method('PATCH')
                                @csrf

                                <div class="form-floating">
                                    <input type="text" name="comp_name" id="comp-name" class="form-control"
                                        placeholder="" autocomplete="off" value="{{ $computer->name }}">
                                    <label for="comp-name">Computer Name</label>
                                </div>
                                <div class="form-floating">
                                    <input type="text" name="comp_model" id="comp-model" class="form-control"
                                        placeholder="" autocomplete="off" value="{{ $computer->model }}">
                                    <label for="comp-model">Computer Model</label>
                                </div>
                                <select name="comp_lab" class="form-select">
                                    <option value="" selected>No Laboratory</option>
                                    @foreach ($laboratories as $laboratory)
                                        <option value="{{ $laboratory->id }}" @selected($computer->laboratory?->name ?: '' == $laboratory->name)>
                                            {{ $laboratory->name }}</option>
                                    @endforeach
                                </select>
                                <select name="comp_status" class="form-select">
                                    @foreach ($statuses as $status)
                                        <option value="{{ $status }}" @selected($computer->status == $status)>
                                            {{ $status }}</option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" form="edit-comp-{{ $computer->id }}-form"
                                class="btn btn-primary">Save Changes</button>
                        </div>
                    </div>
                </div>
            </div>

            <button class="btn btn-outline-danger mx-2" data-bs-toggle="modal"
                data-bs-target="#delete-comp-{{ $computer->id }}">
                <i class="bi bi-trash"></i></button>

            <div class="modal fade" id="delete-comp-{{ $computer->id }}" tabindex="-1"
                aria-labelledby="delete-comp-{{ $computer->id }}-label" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="delete-comp-{{ $computer->id }}-label">Delete Computer?
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="delete-comp-{{ $computer->id }}-form"
                                action="{{ route('computers.destroy', $computer) }}" method="POST"
                                style="display: none;">
                                @method('DELETE')
                                @csrf
                            </form>
                            <h3>Are you sure you want to delete <strong>{{ $computer->name }}</strong>?</h3>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" form="delete-comp-{{ $computer->id }}-form"
                                class="btn btn-danger">Delete Computer</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </td>
</tr>

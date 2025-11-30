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

    $statuses = ['Active', 'Inactive', 'Maintenance'];
@endphp

<tr>
    <th scope='row'>{{ $name }}</th>
    @if (isset($lab))
        <td>{{ $lab }}</td>
    @endif
    <td class="text-secondary">{{ $model }}</td>
    <td class="text-center">
        <p class="badge rounded px-2 mt-3"
            style="color: {{ $badge['color'] }}; background: {{ $badge['bg'] }}; border: solid 1px {{ $badge['border'] }};">
            {{ $status }}</p>
    </td>
    <td class="text-secondary text-center">{{ $assignedDate }}</td>
    <td>
        <div class="d-flex flex-wrap justify-content-center">
            <button class="btn btn-outline-primary mx-1" data-bs-toggle="modal"
                data-bs-target="#edit-comp-{{ $id }}">
                <i class="bi bi-pencil"></i></button>

            <div class="modal fade" id="edit-comp-{{ $id }}" tabindex="-1"
                aria-labelledby="edit-comp-{{ $id }}-label" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="edit-comp-{{ $id }}-label">Edit {{ $name }}
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="edit-comp-{{ $id }}-form"
                                action="{{ route('computer.update', ['id' => $id]) }}" method="POST"
                                class="d-flex flex-column gap-3">
                                @method('PATCH')
                                @csrf

                                <div class="form-floating">
                                    <input type="text" name="comp_name" id="comp-name" class="form-control"
                                        placeholder="" autocomplete="off" value="{{ $name }}">
                                    <label for="comp-name">Computer Name</label>
                                </div>
                                <div class="form-floating">
                                    <input type="text" name="comp_model" id="comp-model" class="form-control"
                                        placeholder="" autocomplete="off" value="{{ $model }}">
                                    <label for="comp-model">Computer Model</label>
                                </div>
                                <select name="comp_lab" class="form-select">
                                    <option value="" selected>Select Laboratory</option>
                                    @foreach ($laboratories as $laboratory)
                                        <option value="{{ $laboratory->id }}" @selected(isset($lab) && $lab == $laboratory->name)>
                                            {{ $laboratory->name }}</option>
                                    @endforeach
                                </select>
                                <select name="comp_status" class="form-select">
                                    @foreach ($statuses as $stat)
                                        <option value="{{ $stat }}" @selected($status == $stat)>
                                            {{ $stat }}</option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" form="edit-comp-{{ $id }}-form"
                                class="btn btn-primary">Save Changes</button>
                        </div>
                    </div>
                </div>
            </div>

            @if (auth()->user()->role == 'admin')
                <button class="btn btn-outline-danger mx-2" data-bs-toggle="modal"
                    data-bs-target="#delete-comp-{{ $id }}">
                    <i class="bi bi-trash"></i></button>

                <div class="modal fade" id="delete-comp-{{ $id }}" tabindex="-1"
                    aria-labelledby="delete-comp-{{ $id }}-label" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="delete-comp-{{ $id }}-label">Delete Computer?
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="delete-comp-{{ $id }}-form"
                                    action="{{ route('computer.delete', ['id' => $id]) }}" method="POST"
                                    style="display: none;">
                                    @method('DELETE')
                                    @csrf
                                </form>
                                <h3>Are you sure you want to delete <strong>{{ $name }}</strong>?</h3>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" form="delete-comp-{{ $id }}-form"
                                    class="btn btn-danger">Delete Computer</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </td>
</tr>

@php
    $badge = match (trim($item->status)) {
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
    <td>{{ $item->name }}</td>
    @if (!request()->segment(2) || !is_numeric(request()->segment(2)))
        <td>{{ $item->category->name }}</td>
    @endif
    <td class="text-center">{{ $item->quantity }}</td>
    <td class="text-center">
        <p class="badge px-2 my-2"
            style="color: {{ $badge['color'] }}; background: {{ $badge['bg'] }}; border: solid 1px {{ $badge['border'] }};">
            {{ $item->status }}</p>
    </td>
    <td>
        <div class="d-flex flex-wrap justify-content-center">
            <button class="btn btn-outline-primary mx-1" data-bs-toggle="modal"
                data-bs-target="#edit-item-{{ $item->id }}">
                <i class="bi bi-pencil"></i></button>

            <div class="modal fade" id="edit-item-{{ $item->id }}" tabindex="-1"
                aria-labelledby="edit-item-{{ $item->id }}-label" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="edit-item-{{ $item->id }}-label">Edit {{ $item->name }}
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="edit-item-{{ $item->id }}-form" action="{{ route('items.update', $item) }}"
                                method="POST" class="d-flex flex-column gap-3">
                                @method('PATCH')
                                @csrf

                                <div class="form-floating">
                                    <input type="text" name="item_name" id="item-name" class="form-control"
                                        placeholder="" autocomplete="off" value="{{ $item->name }}">
                                    <label>Item Name</label>
                                </div>
                                <div class="form-floating">
                                    <input type="text" name="item_quantity" id="item-quantity" class="form-control"
                                        placeholder="" autocomplete="off" value="{{ $item->quantity }}">
                                    <label for="item-quantity">Item Quantity</label>
                                </div>
                                <select name="item_cat" class="form-select">
                                    <option value="" selected>Select Category</option>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}" @selected($item->category->name == $cat->name)>
                                            {{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" form="edit-item-{{ $item->id }}-form"
                                class="btn btn-primary">Save Changes</button>
                        </div>
                    </div>
                </div>
            </div>

            <button class="btn btn-outline-danger mx-2" data-bs-toggle="modal"
                data-bs-target="#delete-comp-{{ $item->id }}">
                <i class="bi bi-trash"></i></button>

            <div class="modal fade" id="delete-comp-{{ $item->id }}" tabindex="-1"
                aria-labelledby="delete-comp-{{ $item->id }}-label" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="delete-comp-{{ $item->id }}-label">Delete Computer?
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="delete-comp-{{ $item->id }}-form"
                                action="{{ route('items.destroy', $item) }}" method="POST" style="display: none;">
                                @method('DELETE')
                                @csrf
                            </form>
                            <h3>Are you sure you want to delete <strong>{{ $item->name }}</strong>?</h3>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" form="delete-comp-{{ $item->id }}-form"
                                class="btn btn-danger">Delete Computer</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </td>
</tr>

<div class="container-fluid card h-100 shadow m-4" style="max-width: 30rem;">
    <div class="card-body">
        <div class="d-flex gap-3 justify-content-between align-items-baseline">
            <h1 class="card-title fw-bold" style="rverflow-wrap: break-word;">{{ $category->name }}</h1>
            <div class="rounded-3 py-1 px-2 text-light" style="background: #{{ $category->color }}; font-size: 1.5rem;">
                <i class="bi bi-{{ $category->icon }}"></i>
            </div>
        </div>
        <h4 class="card-subtitle text-muted mt-1">{{ $category->items->count() ?? 0 }} Unique Items</h4>
        <p class="card-subtitle text-muted mt-2">{{ $category->description }}</p>

        <div class="d-flex justify-content-center gap-3 mt-5 mb-3">
            <a href="{{ route('categories.edit', $category) }}" class="btn btn-outline-primary rounded-pill px-5">
                <i class="bi bi-pencil-square"></i> Edit</a>

            @if (auth()->user()->role == 'admin')
                <button class="btn btn-outline-danger rounded-pill px-5" data-bs-toggle="modal"
                    data-bs-target="#delete-cat-{{ $category->id }}">
                    <i class="bi bi-trash"></i> Delete</button>

                <div class="modal fade" id="delete-cat-{{ $category->id }}" tabindex="-1"
                    aria-labelledby="delete-cat-{{ $category->id }}-label" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="delete-cat-{{ $category->id }}-label">Delete Category?
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="delete-cat-{{ $category->id }}-form"
                                    action="{{ route('categories.destroy', $category) }}" method="POST"
                                    style="display: none;">
                                    @method('DELETE')
                                    @csrf
                                </form>
                                <h3>Are you sure you want to delete <strong>{{ $category->name }}</strong>?</h3>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" form="delete-cat-{{ $category->id }}-form"
                                    class="btn btn-danger">Delete Category</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>

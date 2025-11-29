<div class="card h-100 shadow m-4" style="min-width: 30rem; max-width: 30rem">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
            <div class="rounded-3 px-2 py-1 bg-info text-light" style="font-size: 2rem">
                <i class="bi bi-box"></i>
            </div>
            <h1 class="card-title m-3 fw-bold text-end">{{ $name }}</h1>
        </div>
        <h4 class="card-subtitle text-muted mx-3 text-end">{{ $itemCount }} Items</h4>

        <div class="d-flex justify-content-evenly gap-3 mt-5 mb-3">
            <a href="" class="btn btn-outline-primary rounded-pill px-4">
                <i class="bi bi-pencil-square"></i> Edit</a>
            <a href="" class="btn btn-outline-danger rounded-pill px-3">
                <i class="bi bi-trash"></i> Delete</a>
        </div>
    </div>
</div>

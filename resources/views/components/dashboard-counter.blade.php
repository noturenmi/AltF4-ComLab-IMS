<div class="card h-100" style="min-width: 15rem;">
    <div class="card-body">
        <div class="d-flex justify-content-between flex-wrap-reverse">
            <h6 class="card-title mb-3 mt-2 fw-bold">{{ $label }}</h6>
            <div class="align-self-start px-2 py-1 rounded-3 fs-5"
                style="color: {{ $color }}; background: {{ $bg }}">
                {{ $slot }}
            </div>
        </div>
        <h1 class="card-text">{{ $counter }}</h1>
    </div>
</div>

<div class="card h-100 shadow" style="min-width: 15rem;">
    <div class="card-body p-5">
        <div class="d-flex justify-content-between flex-wrap-reverse">
            <h1 class="card-title mb-3 mt-2 fw-bold">{{ $label }}</h1>
            <div class="align-self-start px-3 py-1 rounded-3"
                style="color: {{ $color }}; background: {{ $bg }}; font-size: 2.5rem">
                {{ $slot }}
            </div>
        </div>
        <h1 class="card-text">{{ $counter }}</h1>
    </div>
</div>

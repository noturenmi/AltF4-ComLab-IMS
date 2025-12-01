@php
    $pages = ['dashboard', 'laboratories', 'computers', 'categories', 'items'];
@endphp
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
<nav class="navbar navbar-dark sticky-top p-3" style="background: #0C2B4E;">
    <div class="container-fluid">
        <div class="d-flex align-items-center">
            <button type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling"
                aria-controls="offcanvasScrolling" class="btn mb-0 fw-bold fs-2 mx-4 text-light">
                <i class="bi bi-list"></i>
            </button>
            <span class="fs-3 fw-bold text-light">AltF4Solutions</span>
        </div>
    </div>

    <div class="offcanvas offcanvas-start text-light" data-bs-scroll="true" data-bs-backdrop="true" tabindex="-1"
        id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel" style="background: #0C2B4E;">
        <div class="offcanvas-header">
            <h3 class="offcanvas-title fw-bold mt-3" id="offcanvasScrollingLabel">AltF4Solutions</h3>
            <button type="button" class="btn-close btn-close-white text-reset" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <hr>
            <ul class="nav flex-column">
                @foreach ($pages as $page)
                    <li class="nav-item fs-4 my-1">
                        <a href="{{ $page != 'dashboard' ? route($page . '.index') : route($page) }}"
                            class="nav-link text-light
                        {{ request()->is($page) ? 'active fw-bold' : '' }}"
                            {{ request()->is($page) ? "aria-current='page'" : '' }}>
                            {{ ucwords($page) }}
                        </a>
                    </li>
                @endforeach
                <hr>

                <li class="nav-item fs-4 my-1">
                    <a href="" class="nav-link text-light">User Settings</a>
                </li>

                <li class="nav-item fs-4 my-1">
                    <a href="{{ route('logout') }}" class="nav-link text-light"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                </li>

            </ul>
        </div>
    </div>
</nav>

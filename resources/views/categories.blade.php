@extends('layouts.master')

@section('content')
    <h1 class="m-4 fw-bold text-center" style="color: #636363;">Categories</h1>

    <div class="container card pt-4">
        <a href="" class="btn rounded-3 mx-4 text-light fw-bold align-self-end" style="background: #5C6BA1;">
            <i class="bi bi-plus-square-fill mx-1" style="color: #D9D9D9;"></i> Add Category</a>
        <div class="card-body d-flex flex-wrap gap-3 justify-content-center">
            @foreach ($categories as $cat)
                <x-category-card name="{{ $cat->name }}" :itemCount="$cat->items_sum_quantity" />
            @endforeach
        </div>
    </div>
@endsection

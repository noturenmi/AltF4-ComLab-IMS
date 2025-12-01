@extends('layouts.master')

@section('content')
    <h1 class="m-4 fw-bold text-center" style="color: #636363;">Categories</h1>

    <div class="container card pt-4">

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
        @endif

        <button class="btn rounded-3 mx-4 text-light fw-bold align-self-end" style="background: #5C6BA1;"
            data-bs-toggle="modal" data-bs-target="#new-cat-modal">
            <i class="bi bi-plus-square-fill mx-1" style="color: #D9D9D9;"></i> Add Category
        </button>

        <div class="modal fade" id="new-cat-modal" tabindex="-1" aria-labelledby="new-cat-modal-label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="new-cat-modal-label">New Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('categories.store') }}" method="POST" id="new-cat"
                            class="d-flex flex-column gap-3">
                            @csrf
                            <div class="form-floating">
                                <input type="text" name="cat_name" id="comp-name" class="form-control" placeholder=""
                                    autocomplete="off">
                                <label for="comp-name">Category Name</label>
                            </div>
                            <div class="form-floating">
                                <input type="text" name="cat_desc" id="comp-model" class="form-control" placeholder=""
                                    autocomplete="off">
                                <label for="comp-model">Category Description</label>
                            </div>
                            <select name="cat_icon" class="form-select">
                                @foreach ($icons as $icon => $value)
                                    <option value="{{ $value }}">{{ $icon }}</option>
                                @endforeach
                            </select>
                            <select name="cat_color" class="form-select">
                                @foreach ($colors as $color => $value)
                                    <option value="{{ $value }}">{{ $color }}</option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" form="new-cat" class="btn btn-success">Add Category</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body d-flex flex-wrap gap-3 justify-content-center">
            @foreach ($categories as $cat)
                <x-category-card :category="$cat" />
            @endforeach
        </div>
    </div>
@endsection

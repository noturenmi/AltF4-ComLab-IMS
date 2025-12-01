@extends('layouts.master')

@section('content')
    <div class="container d-flex justify-content-between align-items-baseline">
        <a href="{{ route('categories.index') }}" class="btn btn-secondary mt-5"><i class="bi bi-chevron-left"></i>
            Back to Categories</a>
        <button type="submit" form="cat-{{ $category->id }}-form" class="btn btn-primary">Save Changes</button>
    </div>

    <form action="{{ route('categories.update', $category) }}" method="POST" id="cat-{{ $category->id }}-form"
        class="container card my-4 p-2 gap-3">
        @method('PATCH')
        @csrf
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <input type="text" name="cat_name" value="{{ $category->name }}" autocomplete="off"
            class="form-control fs-1 fw-bold">
        @error('cat_name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <input type="text" name="cat_desc" value="{{ $category->description }}" autocomplete="off"
            class="form-control fs-5">
        @error('cat_desc')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <select name="cat_icon" class="form-select">
            @foreach ($icons as $icon => $value)
                <option value="{{ $value }}" @selected($category->icon == $value)>{{ $icon }}</option>
            @endforeach
        </select>
        <select name="cat_color" class="form-select">
            @foreach ($colors as $color => $value)
                <option value="{{ $value }}" @selected($category->color == $value)>{{ $color }}</option>
            @endforeach
        </select>
    </form>

    <div class="container card py-5">
        <h2 class="text-center fw-bold">Items</h2>
        <hr>
        <table class="table align-middle">
            <table id="item-table" class="table align-middle">
                <thead>
                    <tr>
                        <th style='width: 5%'></th>
                        <th scope='col'>Name</th>
                        <th scope='col' class="text-center">Quantity</th>
                        <th scope='col' class="text-center">Status</th>
                        <th scope='col' class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <x-item-row :id="$item->category->id" :item="$item" :categories="$categories" />
                    @endforeach
                </tbody>
            </table>
    </div>

    </table>
    </div>
@endsection

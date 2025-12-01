@extends('layouts.master')

@php
    $statuses = ['Available', 'Low Stock', 'Out of Stock'];
@endphp

@section('content')
    <h1 class="m-4 fw-bold text-center" style="color: #636363;">Items</h1>
    <div class="container card pt-4">

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
        @endif

        <button class="btn rounded-3 mx-4 mb-3 text-light fw-bold align-self-end" style="background: #5C6BA1;"
            data-bs-toggle="modal" data-bs-target="#new-item-modal">
            <i class="bi bi-plus-square-fill mx-1" style="color: #D9D9D9;"></i> Add Item</button>

        <div class="modal fade" id="new-item-modal" tabindex="-1" aria-labelledby="new-item-modal-label"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="new-item-modal-label">New Item</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('items.store') }}" method="POST" id="new-item"
                            class="d-flex flex-column gap-3">
                            @csrf
                            <div class="form-floating">
                                <input type="text" name="item_name" class="form-control" placeholder=""
                                    autocomplete="off">
                                <label>Item Name</label>
                            </div>
                            <div class="form-floating">
                                <input type="text" name="item_quantity" class="form-control" placeholder=""
                                    autocomplete="off">
                                <label>Item Quantity</label>
                            </div>
                            <select name="item_cat" class="form-select">
                                <option value="" selected>Select Category</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" form="new-item" class="btn btn-success">Add Item</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex gap-3">
            <input type="text" id="filter-category" class="form-control" placeholder="Filter Category">
            <select id="filter-status" class="form-select">
                <option value="" selected>All Statuses</option>
                @foreach ($statuses as $status)
                    <option value="{{ $status }}">{{ $status }}</option>
                @endforeach
            </select>
        </div>

        <div class="d-flex my-3 gap-3">
            <select id="sort-column" class="form-select">
                <option value="category" selected>Sort by Category</option>
                <option value="quantity">Sort by Quantity</option>
            </select>
            <select id="sort-order" class="form-select">
                <option value="asc" selected>Ascending</option>
                <option value="desc">Descending</option>
            </select>
        </div>

        <table id="item-table" class="table align-middle">
            <thead>
                <tr>
                    <th style='width: 5%'></th>
                    <th scope='col'>Name</th>
                    <th scope='col'>Category</th>
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
    <script>
        const table = document.querySelector("#item-table");
        const rows = table.getElementsByTagName("tr");

        const filterCat = document.querySelector("#filter-category");
        const filterStat = document.querySelector("#filter-status");
        const catColIndex = 2;
        const quantiColIndex = 3;
        const statColIndex = 4;

        const sortCol = document.querySelector("#sort-column");
        const sortOrd = document.querySelector("#sort-order");

        function updateRowNums() {
            let rowNum = 1;
            for (let i = 1; i < rows.length; i++) {
                if (!rows[i].classList.contains("d-none")) {
                    rows[i].children[0].innerText = rowNum;
                    rowNum++;
                }
            }
        }

        function applyFiltersAndSort() {
            const enteredCategory = filterCat.value.toLowerCase();
            const selectedStatus = filterStat.value.toLowerCase();

            for (let i = 1; i < rows.length; i++) {
                let show = true;

                const catCell = rows[i].children[catColIndex].textContent.toLowerCase();
                const statCell = rows[i].children[statColIndex].textContent
                    .trim()
                    .toLowerCase();

                if (enteredCategory && !catCell.includes(enteredCategory)) show = false;

                if (selectedStatus && !statCell.includes(selectedStatus)) show = false;

                rows[i].classList.toggle("d-none", !show);
            }

            let visibleRows = [];
            for (let i = 1; i < rows.length; i++) {
                if (!rows[i].classList.contains("d-none")) visibleRows.push(rows[i]);
            }

            const sortField = sortCol.value;
            const sortOrder = sortOrd.value;
            const colIndex = sortField === "category" ? catColIndex : quantiColIndex;

            visibleRows.sort((a, b) => {
                let x = a.children[colIndex].textContent.trim().toLowerCase();
                let y = b.children[colIndex].textContent.trim().toLowerCase();
                if (sortField === "quantity") {
                    x = parseInt(x, 10);
                    y = parseInt(y, 10);
                }

                if (sortOrder === "asc") {
                    if (x > y) return 1;
                    if (x < y) return -1;
                    return 0;
                } else {
                    if (x < y) return 1;
                    if (x > y) return -1;
                    return 0;
                }
            });

            for (let i = 0; i < visibleRows.length; i++) {
                table.tBodies[0].appendChild(visibleRows[i]);
            }

            updateRowNums();
        }

        filterCat.addEventListener("input", applyFiltersAndSort);
        filterStat.addEventListener("change", applyFiltersAndSort);
        sortCol.addEventListener("change", applyFiltersAndSort);
        sortOrd.addEventListener("change", applyFiltersAndSort);

        applyFiltersAndSort();
    </script>
@endsection

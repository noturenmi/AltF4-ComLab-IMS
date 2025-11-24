@extends('layouts.master')

@php
    $items = [
        ['category' => 'HDMI Cable', 'quantity' => 23, 'status' => 'low stock'],
        ['category' => 'Office Mouse', 'quantity' => 60, 'status' => 'available'],
        ['category' => 'Membrane Keyboard', 'quantity' => 84, 'status' => 'available'],
        ['category' => 'ID Cards', 'quantity' => 0, 'status' => 'out of stock'],
    ];

    $statuses = ['available', 'low stock', 'out of stock'];
@endphp

@section('content')
    <h1 class="m-4 fw-bold" style="color: #636363;">Items</h1>
    <div class="container card pt-4">
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

        <table id="item-table" class="table table-sm align-middle">
            <thead>
                <tr>
                    <th style='width: 5%'></th>
                    <th scope='col'>Category</th>
                    <th scope='col' class="text-center">Quantity</th>
                    <th scope='col' class="text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <x-item-row category="{{ $item['category'] }}" :quantity="$item['quantity']" status="{{ $item['status'] }}" />
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
        const table = document.querySelector("#item-table");
        const rows = table.getElementsByTagName("tr");

        const filterCat = document.querySelector("#filter-category");
        const filterStat = document.querySelector("#filter-status");
        const catColIndex = 1;
        const quantiColIndex = 2;
        const statColIndex = 3;

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

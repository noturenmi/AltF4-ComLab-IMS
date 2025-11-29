@extends('layouts.master')

@php
    $actions = ['ADD', 'UPDATE', 'DELETE'];
@endphp

@section('content')
    <h1 class="m-4 fw-bold" style="color: #636363;">Transactions</h1>
    <div class="container card pt-4">
        <div class="d-flex gap-3">
            <input type="text" id="filter-category" class="form-control" placeholder="Filter Description or User">
            <select id="filter-status" class="form-select">
                <option value="" selected>All Actions</option>
                @foreach ($actions as $action)
                    <option value="{{ $action }}">{{ $action }}</option>
                @endforeach
            </select>
        </div>
        <div class="d-flex my-3 gap-3">
            <select id="sort-column" class="form-select">
                <option value="timestamp" selected>Sort by Date & Time</option>
                <option value="quantity">Sort by User</option>
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
                    <th scope='col' class="text-center">Action</th>
                    <th scope='col'>Remarks</th>
                    <th scope='col' class="text-center">Date & Time</th>
                    <th scope='col' class="text-center">User</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $tr)
                    <x-transact-row action="{{ $tr->type }}" desc="{{ $tr->remarks }}"
                        timestamp="{{ $tr->created_at }}" user="{{ join(' ', $tr->user->makeHidden('id')->toArray()) }}"
                        :id="$tr->id" />
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
        const table = document.querySelector("#item-table");
        const rows = table.getElementsByTagName("tr");

        const filterDesc = document.querySelector("#filter-category");
        const filterAct = document.querySelector("#filter-status");
        const actColIndex = 1;
        const descColIndex = 2;
        const timeColIndex = 3;
        const userColIndex = 4;

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
            const enteredFilter = filterDesc.value.toLowerCase();

            const selectedAction = filterAct.value.toLowerCase();

            for (let i = 1; i < rows.length; i++) {
                let show = true;

                const descCell = rows[i].children[descColIndex].textContent.toLowerCase();
                const actCell = rows[i].children[actColIndex].textContent.trim().toLowerCase();
                const userCell = rows[i].children[userColIndex].textContent.trim().toLowerCase();

                if (enteredFilter && !(descCell.includes(enteredFilter) || userCell.includes(enteredFilter))) show = false;

                if (selectedAction && !actCell.includes(selectedAction)) show = false;

                rows[i].classList.toggle("d-none", !show);
            }

            let visibleRows = [];
            for (let i = 1; i < rows.length; i++) {
                if (!rows[i].classList.contains("d-none")) visibleRows.push(rows[i]);
            }

            const sortField = sortCol.value;
            const sortOrder = sortOrd.value;
            const colIndex = sortField === "timestamp" ? timeColIndex : sortField === "desc" ? descColIndex : userColIndex;

            visibleRows.sort((a, b) => {
                let x = a.children[colIndex].textContent.trim();
                let y = b.children[colIndex].textContent.trim();

                if (sortField === "timestamp") {
                    if (sortOrder === "asc")
                        return new Date(x) - new Date(y)
                    else
                        return new Date(y) - new Date(x)
                }

                x = x.toLowerCase();
                y = y.toLowerCase();

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

        filterDesc.addEventListener("input", applyFiltersAndSort);
        filterAct.addEventListener("change", applyFiltersAndSort);
        sortCol.addEventListener("change", applyFiltersAndSort);
        sortOrd.addEventListener("change", applyFiltersAndSort);

        applyFiltersAndSort();
    </script>
@endsection

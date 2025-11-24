@extends('layouts.master')

@php
    $computers = [
        [
            'id' => 1,
            'name' => 'PC-001',
            'lab' => '1',
            'model' => 'Dell Optiplex 7090',
            'status' => 'active',
            'assignedDate' => '2024-01-15',
        ],
        [
            'id' => 2,
            'name' => 'PC-002',
            'lab' => '2',
            'model' => 'Dell Optiplex 7080',
            'status' => 'maintenance',
            'assignedDate' => '2024-02-15',
        ],
        [
            'id' => 3,
            'name' => 'PC-003',
            'lab' => '3',
            'model' => 'Dell Optiplex 7070',
            'status' => 'inactive',
            'assignedDate' => '2024-03-15',
        ],
    ];
@endphp

@section('content')
    <div class="container d-flex flex-wrap align-items-center justify-content-between">
        <h1 class="my-4 mx-4 fw-bold" style="color: #636363;">Computers</h1>
        <a href="" class="btn rounded-3 mx-4 text-light fw-bold" style="background: #5C6BA1;">
            <i class="bi bi-plus-square-fill mx-1" style="color: #D9D9D9;"></i> Add Computer</a>
    </div>
    <div class="container card pt-4">
        <table class="table">
            <thead>
                <tr>
                    <th scope='col'>Name</th>
                    <th scope='col'>Lab</th>
                    <th scope='col'>Model</th>
                    <th scope='col'>Status</th>
                    <th scope='col'>Assigned Date</th>
                    <th scope='col'>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($computers as $pc)
                    <x-comp-row name="{{ $pc['name'] }}" lab="{{ $pc['lab'] }}" model="{{ $pc['model'] }}"
                        status="{{ $pc['status'] }}" assignedDate="{{ $pc['assignedDate'] }}" :id="$pc['id']" />
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

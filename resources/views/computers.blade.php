@extends('layouts.master')

@section('content')
    <h1 class="m-4 fw-bold text-center" style="color: #636363;">Computers</h1>

    <div class="container card mt-3 pt-4">
        <a href="" class="btn rounded-3 mx-4 text-light fw-bold align-self-end" style="background: #5C6BA1;">
            <i class="bi bi-plus-square-fill mx-1" style="color: #D9D9D9;"></i> Add Computer</a>
        <table class="table align-middle">
            <thead>
                <tr>
                    <th scope='col'>Name</th>
                    <th scope='col'>Lab</th>
                    <th scope='col'>Model</th>
                    <th scope='col' class="text-center">Status</th>
                    <th scope='col' class="text-center">Assigned Date</th>
                    <th scope='col' class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($computers as $computer)
                    <x-comp-row name="{{ $computer->name }}" lab="{{ $computer->laboratory->name }}"
                        model="{{ $computer->model }}" status="{{ $computer->status }}"
                        assignedDate="{{ $computer->assigned_date }}" :id="$computer->id" />
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

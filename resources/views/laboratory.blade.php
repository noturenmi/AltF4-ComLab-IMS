@extends('layouts.master')

@php
    $statuses = ['Available', 'Occupied', 'Maintenance'];
@endphp

@section('content')
    <div class="container d-flex justify-content-between align-items-baseline">
        <a href="{{ route('laboratories') }}" class="btn btn-secondary mt-5"><i class="bi bi-chevron-left"></i>
            Back to Laboratories</a>
        <button type="submit" form="lab-{{ $laboratory->id }}-form" class="btn btn-primary">Save Changes</button>
    </div>

    <form action="{{ route('laboratory.update', $laboratory) }}" method="POST" id="lab-{{ $laboratory->id }}-form"
        class="container card my-4 p-2 gap-3">
        @method('PATCH')
        @csrf
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <input type="text" name="lab_name" value="{{ $laboratory->name }}" autocomplete="off"
            class="form-control fs-1 fw-bold">
        @error('lab_name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <select name="lab_status" class="form-select fs-3">
            @foreach ($statuses as $status)
                <option value="{{ $status }}" @selected($laboratory->status == $status)>
                    {{ $status }}
                </option>
            @endforeach
        </select>
        @error('lab_status')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </form>
    <div class="container card py-5">
        <h2 class="text-center fw-bold">Assigned Computers</h2>
        <hr>
        <table class="table align-middle">
            <thead>
                <tr>
                    <th scope='col'>Name</th>
                    <th scope='col'>Model</th>
                    <th scope='col' class="text-center">Status</th>
                    <th scope='col' class="text-center">Assigned Date</th>
                    <th scope='col' class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($labComputers as $computer)
                    <x-comp-row :id="$computer->id" :name="$computer->name" :model="$computer->model" :status="$computer->status" :assignedDate="$computer->assigned_date"
                        :laboratories="$laboratories" :lab="$laboratory->name" />
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

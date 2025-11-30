@extends('layouts.master')

@section('content')
    <h1 class="m-4 fw-bold text-center" style="color: #636363;">Computers</h1>

    <div class="container card mt-3 pt-4">

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
        @endif

        @if (auth()->user()->role == 'admin')
            <button class="btn rounded-3 mx-4 text-light fw-bold align-self-end" style="background: #5C6BA1;"
                data-bs-toggle="modal" data-bs-target="#new-comp-modal">
                <i class="bi bi-plus-square-fill mx-1" style="color: #D9D9D9;"></i> Add Computer
            </button>

            <div class="modal fade" id="new-comp-modal" tabindex="-1" aria-labelledby="new-comp-modal-label"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="new-comp-modal-label">New Computer</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('computers.new') }}" method="POST" id="new-comp"
                                class="d-flex flex-column gap-3">
                                @csrf
                                <div class="form-floating">
                                    <input type="text" name="comp_name" id="comp-name" class="form-control"
                                        placeholder="" autocomplete="off">
                                    <label for="comp-name">Computer Name</label>
                                </div>
                                <div class="form-floating">
                                    <input type="text" name="comp_model" id="comp-model" class="form-control"
                                        placeholder="" autocomplete="off">
                                    <label for="comp-model">Computer Model</label>
                                </div>
                                <select name="comp_lab" class="form-select">
                                    <option value="" selected>Select Laboratory</option>
                                    @foreach ($laboratories as $lab)
                                        <option value="{{ $lab->id }}">{{ $lab->name }}</option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" form="new-comp" class="btn btn-success">Add Computer</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
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
                    <x-comp-row name="{{ $computer->name }}"
                        lab="{{ isset($computer->lab_id) ? $computer->laboratory->name : '' }}"
                        model="{{ $computer->model }}" status="{{ $computer->status }}"
                        assignedDate="{{ $computer->assigned_date }}" :id="$computer->id" :laboratories="$laboratories" />
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

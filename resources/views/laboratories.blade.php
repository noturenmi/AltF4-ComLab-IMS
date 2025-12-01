@extends('layouts.master')

@section('content')
    <h1 class="m-4 fw-bold text-center" style="color: #636363;">Laboratories</h1>
    <div class="container card py-5">

        <button class="btn rounded-3 mx-4 text-light fw-bold align-self-end" style="background: #5C6BA1;"
            data-bs-toggle="modal" data-bs-target="#new-lab-modal">
            <i class="bi bi-plus-square-fill mx-1" style="color: #D9D9D9;"></i> Add Laboratory
        </button>

        <div class="modal fade" id="new-lab-modal" tabindex="-1" aria-labelledby="new-lab-modal-label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="new-lab-modal-label">New Laboratory</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('laboratories.store') }}" method="POST" id="new-lab">
                            @csrf
                            <div class="form-floating">
                                <input type="text" name="lab_name" id="lab-name" class="form-control" placeholder=""
                                    autocomplete="off">
                                <label for="lab-name">Laboratory Name</label>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" form="new-lab" class="btn btn-success">Add Laboratory</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body d-flex flex-wrap gap-3 justify-content-center">
            @foreach ($laboratories as $lab)
                <x-lab-display :id="$lab->id" :laboratory="$lab" />
            @endforeach
        </div>
    </div>
@endsection

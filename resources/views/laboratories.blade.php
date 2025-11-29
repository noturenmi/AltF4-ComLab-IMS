@extends('layouts.master')

@section('content')
    <h1 class="m-4 fw-bold text-center" style="color: #636363;">Laboratories</h1>
    <div class="d-flex flex-wrap gap-3 justify-content-center">
        @foreach ($labs as $lab)
            <x-lab-display label="{{ $lab->name }}" status="{{ $lab->status }}" :computerCount="$lab->computers_count" :activeCount="$lab->active_count"
                :inactiveCount="$lab->inactive_count" :maintenanceCount="$lab->maintenance_count" :id="$lab->id" />
        @endforeach
    </div>
@endsection

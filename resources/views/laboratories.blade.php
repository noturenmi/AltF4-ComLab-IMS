@extends('layouts.master')

@php
    $labs = [
        [
            'id' => 1,
            'label' => 'A',
            'status' => 'Active',
            'computerCount' => 10,
            'itemCount' => 35,
        ],
        [
            'id' => 2,
            'label' => 'B',
            'status' => 'Maintenance',
            'computerCount' => 12,
            'itemCount' => 48,
        ],
    ];
@endphp

@section('content')
    <h1 class="text-center my-4 fw-bold">Laboratories</h1>
    <div class="d-flex flex-wrap p-5 gap-3 justify-content-center">
        @foreach ($labs as $lab)
            <x-lab-display label="{{ $lab['label'] }}" status="{{ $lab['status'] }}" :computerCount="$lab['computerCount']" :itemCount="$lab['itemCount']"
                :id="$lab['id']" />
        @endforeach
    </div>
@endsection

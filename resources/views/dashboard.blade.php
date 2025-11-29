@extends('layouts.master')

@php
    $cards = [
        [
            'label' => 'Total Items',
            'icon' => 'box',
            'color' => '#2D6EFC',
            'bg' => '#DBEAFE',
            'counter' => $itemCount,
        ],
        [
            'label' => 'Total Computers',
            'icon' => 'pc-display',
            'color' => '#00A63E',
            'bg' => '#DBFCE7',
            'counter' => $compCount,
        ],
        [
            'label' => 'Total Labs',
            'icon' => 'building',
            'color' => '#F54A00',
            'bg' => '#FFEDD4',
            'counter' => $labCount,
        ],
        [
            'label' => 'Low Stock',
            'icon' => 'exclamation-triangle',
            'color' => '#E7030E',
            'bg' => '#FFE2E2',
            'counter' => $lowStockCount,
        ],
    ];
@endphp

@section('content')
    <h1 class="m-4 fw-bold text-center" style="color: #636363;">Dashboard</h1>
    <div id="dashboard-outer-wrapper" class="px-5">

        <div class="d-flex flex-wrap gap-3 align-self-stretch">

            @foreach ($cards as $card)
                <div class="flex-grow-1">
                    <x-dashboard-counter label="{{ $card['label'] }}" counter="{{ $card['counter'] }}"
                        color="{{ $card['color'] }}" bg="{{ $card['bg'] }}">
                        <i class="bi bi-{{ $card['icon'] }}"></i>
                        </ x-dashboard-counter>
                </div>
            @endforeach

        </div>

        <div class="mt-4" style="min-height: 20vh;">
            <x-dashboard-counter label="Transactions Today" counter="{{ $transTodayCount }}" color="#9A16FA" bg="#F3E8FF">
                <i class="bi bi-file-text"></i></x-dashboard-counter>
        </div>
    </div>
@endsection

@extends('layouts.master')

@section('content')
    <h1 class="text-center my-4 fw-bold">Dashboard</h1>
    <div class="container-fluid mt-3 d-grid gap-3"
        style="grid-template-columns: 1fr 1fr 1fr;
        grid-template-areas:
        'items computers transactions'
        'labs stock transactions';">

        <div style="grid-area: items">
            <x-dashboard-counter label="Total Items" counter="7" color="#2D6EFC" bg="#DBEAFE">
                <i class="bi bi-box"></i></ x-dashboard-counter>
        </div>

        <div style="grid-area: computers">
            <x-dashboard-counter label="Total Computers" counter="7" color="#00A63E" bg="#DBFCE7">
                <i class="bi bi-pc-display"></i></ x-dashboard-counter>
        </div>

        <div style="grid-area: transactions;">
            <x-dashboard-counter label="Transactions Today" counter="0" color="#9A16FA" bg="#F3E8FF">
                <i class="bi bi-file-text"></i></ x-dashboard-counter>
        </div>

        <div style="grid-area: labs">
            <x-dashboard-counter label="Total Labs" counter="0" color="#F54A00" bg="#FFEDD4">
                <i class="bi bi-building"></i></ x-dashboard-counter>
        </div>

        <div style="grid-area: stock">
            <x-dashboard-counter label="Low Stock" counter="0" color="#E7030E" bg="#FFE2E2">
                <i class="bi bi-exclamation-triangle"></i></x-dashboard-counter>
        </div>
    </div>
@endsection

<?php

use App\Http\Controllers\ComputerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LabController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/dashboard', DashboardController::class)->name('dashboard');

Route::get('/laboratories', [LabController::class, 'index'])->name('laboratories');

Route::get('/computers', [ComputerController::class, 'index'])->name('computers');

Route::get('/items', ItemController::class)->name('items');

Route::get('/categories', function () {
    return view('dashboard');
})->name('categories');

Route::get('/transactions', TransactionController::class)->name('transactions');

Route::get('/reports', function () {
    return view('dashboard');
})->name('reports');

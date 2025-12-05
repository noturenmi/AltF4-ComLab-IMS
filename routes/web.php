<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ComputerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LabController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware('guest')->group(function () {

    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.auth');

    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.validate');

});

Route::middleware('auth')->group(function () {

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::resource('/laboratories', LabController::class)->except(['create', 'show']);
    Route::resource('/computers', ComputerController::class)->except(['create', 'show', 'edit']);
    Route::resource('/categories', CategoryController::class)->except(['create', 'show']);
    Route::resource('/items', ItemController::class)->except(['create', 'show', 'edit']);

    Route::get('/transactions', TransactionController::class)->name('transactions');

    Route::get('/reports', function () {
        return view('dashboard');
    })->name('reports');

});

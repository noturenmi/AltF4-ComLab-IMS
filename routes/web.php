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
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.auth');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.validate');

Route::middleware('auth')->group(function () {

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::get('/laboratories', [LabController::class, 'index'])->name('laboratories');
    Route::post('/laboratories', [LabController::class, 'newLab'])->name('laboratories.new');
    Route::get('/laboratory/{id}', [LabController::class, 'editLab'])->name('laboratories.edit');
    Route::patch('/laboratory/{laboratory}', [LabController::class, 'patchLab'])->name('laboratory.update');
    Route::delete('/laboratory/{id}', [LabController::class, 'deleteLab'])->name('laboratories.delete');

    Route::get('/computers', [ComputerController::class, 'index'])->name('computers');

    Route::get('/items', ItemController::class)->name('items');

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');

    Route::get('/transactions', TransactionController::class)->name('transactions');

    Route::get('/reports', function () {
        return view('dashboard');
    })->name('reports');

});

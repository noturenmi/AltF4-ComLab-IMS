<?php

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/laboratories', function () {
    return view('laboratories');
})->name('laboratories');

Route::get('/computers', function () {
    return view('computers');
})->name('computers');

Route::get('/items', function () {
    return view('items');
})->name('items');

Route::get('/categories', function () {
    return view('dashboard');
})->name('categories');

Route::get('/transactions', function () {
    return view('dashboard');
})->name('transactions');

Route::get('/reports', function () {
    return view('dashboard');
})->name('reports');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

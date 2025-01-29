<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Home Route
Route::get('/', function () {
    return Inertia::render('Home');
})->name('home');

// Login Routes
Route::get('/login', [LoginController::class, 'index'])->name('login.create');
Route::post('/login', [LoginController::class, 'login'])->name('login.store');

// Customer Registration Routes
Route::get('/register/customer', [CustomerController::class, 'create'])->name('register.create');
Route::post('/register/customer', [CustomerController::class, 'store'])->name('register.store');

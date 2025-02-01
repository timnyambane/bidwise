<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\JobPostController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
    Route::resource('job-posts', JobPostController::class)->names([
        'index' => 'job-posts.index',
        'create' => 'job-posts.create',
        'store' => 'job-posts.store',
        'show' => 'job-posts.show',
        'edit' => 'job-posts.edit',
        'update' => 'job-posts.update',
        'destroy' => 'job-posts.destroy',
    ]);
});


Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return Inertia::render('Home');
    })->name('home');
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');
    Route::get('/register/customer', [CustomerController::class, 'create'])->name('register.customer.create');
    Route::post('/register/customer', [CustomerController::class, 'store'])->name('register.customer.store');
});

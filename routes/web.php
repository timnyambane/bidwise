<?php

use App\Http\Controllers\BusinessController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobPostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');
    Route::get('/register/customer', [CustomerController::class, 'create'])->name('register.customer.create');
    Route::post('/register/customer', [CustomerController::class, 'store'])->name('register.customer.store');
    Route::get('/register/business', [BusinessController::class, 'create'])->name('register.business.create');
    Route::post('/register/business', [BusinessController::class, 'store'])->name('register.business.store');
    Route::post('/validate-business', [BusinessController::class, 'validateBusiness'])->name('register.business.validate-business');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
    Route::get('/settings', [SettingsController::class, 'create'])->name('settings.create');
    Route::get('/job-post', [JobPostController::class, 'index'])->name('job-post.index');
    Route::post('/job-post', [JobPostController::class, 'store'])->name('job-post.store');
});
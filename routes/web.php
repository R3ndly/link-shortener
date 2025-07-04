<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

    Route::controller(AuthController::class)->group(function() {
        Route::get('/login', 'showLoginForm')->name('login');
        Route::get('/register', 'showRegisterForm');
    });

Route::get('/profile', [ProfileController::class, 'show']);//->middleware('auth:sanctum');

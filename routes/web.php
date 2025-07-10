<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LinkController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
});

    Route::controller(AuthController::class)->group(function() {
        Route::get('/login', 'showLoginForm')->name('login');
        Route::get('/register', 'showRegisterForm');
    });

Route::get('/profile', [ProfileController::class, 'show']);

Route::get('/{shortURL}', [LinkController::class, 'destination_url']);

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\NavigationController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
});

    Route::controller(NavigationController::class)->group(function() {
        Route::get('/login', 'LoginForm')->name('login');
        Route::get('/register', 'RegisterForm');
        Route::get('/profile', 'Profile');
        Route::get('/links', 'userLinks');
        Route::get('/links/edit/{id}', 'editLinks');
    });



Route::get('/{shortURL}', [LinkController::class, 'destination_url']);

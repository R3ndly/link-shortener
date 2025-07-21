<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GenderController;
use App\Http\Controllers\LinkController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function() {
    Route::get('/profile', [ProfileController::class, 'getProfileData']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/generate-short-link', [LinkController::class, 'generateShortLink']);

    Route::controller(LinkController::class)->group(function () {
        Route::get('/links', 'getLinks');
        Route::get('/links/{id}', 'show');
        Route::put('/links/{id}', 'update');
        Route::delete('/links/{id}', 'delete');

    });
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/genders', [GenderController::class, 'index']);

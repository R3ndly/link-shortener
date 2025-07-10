<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GenderController;
use App\Http\Controllers\LinkController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function() {
    Route::get('/profile', [ProfileController::class, 'getProfileData']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/generate-short-link', [LinkController::class, 'generateShortLink']);
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/genders', [GenderController::class, 'index']);

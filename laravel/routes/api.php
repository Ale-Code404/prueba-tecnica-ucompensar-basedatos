<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    AuthController,
    UserController
};

Route::middleware('guest')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('register', [AuthController::class, 'register']);
    });
});

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('users', UserController::class)->only('index');
});

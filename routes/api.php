<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/**
 * @see UserController
 */

Route::post('/auth/registration', [UserController::class, 'registration']);
Route::post('/auth/login', [UserController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/auth/logout', [UserController::class, 'logout']);
    Route::get('/user', [UserController::class, 'getUser']);
});

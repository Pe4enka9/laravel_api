<?php

use App\Http\Controllers\HackathonController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/**
 * @see UserController
 * @see HackathonController
 */

Route::post('/auth/registration', [UserController::class, 'registration']);
Route::post('/auth/login', [UserController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/auth/logout', [UserController::class, 'logout']);
    Route::get('/user', [UserController::class, 'getUser']);
    Route::get('/user/hackathons', [HackathonController::class, 'user']);
    Route::post('/hackathons', [HackathonController::class, 'store']);
    Route::put('/hackathons/{id}', [HackathonController::class, 'update']);
});

Route::get('/hackathons', [HackathonController::class, 'index']);
Route::get('/hackathons/{id}', [HackathonController::class, 'show']);

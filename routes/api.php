<?php

use App\Http\Controllers\CommandController;
use App\Http\Controllers\HackathonController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/**
 * @see UserController
 * @see HackathonController
 * @see CommandController
 */

Route::post('/auth/registration', [UserController::class, 'registration']);
Route::post('/auth/login', [UserController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/auth/logout', [UserController::class, 'logout']);
    Route::get('/user', [UserController::class, 'getUser']);

    Route::get('/user/hackathons', [HackathonController::class, 'user']);
    Route::post('/hackathons', [HackathonController::class, 'store']);
    Route::put('/hackathons/{hackathon}', [HackathonController::class, 'update']);
    Route::delete('/hackathons/{hackathon}', [HackathonController::class, 'destroy']);

    Route::post('/commands', [CommandController::class, 'store']);
});

Route::get('/hackathons', [HackathonController::class, 'index']);
Route::get('/hackathons/{hackathon}', [HackathonController::class, 'show']);

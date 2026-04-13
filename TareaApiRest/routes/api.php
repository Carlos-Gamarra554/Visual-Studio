<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\JugadorController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckAdmin;

Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    
    Route::apiResource('clubs', ClubController::class)->only(['index', 'show']);
    Route::apiResource('jugadores', JugadorController::class)->only(['index', 'show']);

    Route::middleware(CheckAdmin::class)->group(function () {
        Route::post('jugadores/bulk', [JugadorController::class, 'bulkStore']);
        Route::apiResource('clubs', ClubController::class)->except(['index', 'show']);
        Route::apiResource('jugadores', JugadorController::class)->except(['index', 'show']);
    });
});
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PengajuanApiController;

// Public API Routes
Route::prefix('api/v1')->group(function () {
    Route::post('register', [\App\Http\Controllers\Api\AuthController::class, 'register']);
    Route::post('login', [\App\Http\Controllers\Api\AuthController::class, 'login']);
});

// Protected API Routes
Route::prefix('api/v1')->middleware('auth:sanctum')->group(function () {
    Route::post('logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);
    
    // Pengajuan API
    Route::apiResource('pengajuan', PengajuanApiController::class);
    Route::get('pengajuan-statistics', [PengajuanApiController::class, 'statistics']);
});

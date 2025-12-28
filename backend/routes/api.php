<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NavttcProgramController;

// Public API routes
Route::prefix('navttc-programs')->group(function () {
    Route::get('/', [NavttcProgramController::class, 'index']);
    Route::get('/{id}', [NavttcProgramController::class, 'show']);
});

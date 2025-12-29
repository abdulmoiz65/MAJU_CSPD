<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NavttcProgramController;
use App\Http\Controllers\Api\UpcomingProgramController;
use App\Http\Controllers\Api\CalendarController;

// Calendar API route
Route::get('/calendar/active', [CalendarController::class, 'getActiveCalendar']);

// Public API routes
Route::prefix('navttc-programs')->group(function () {
    Route::get('/', [NavttcProgramController::class, 'index']);
    Route::get('/{id}', [NavttcProgramController::class, 'show']);
});

// Upcoming Programs API routes
Route::prefix('upcoming-programs')->group(function () {
    Route::get('/by-month', [UpcomingProgramController::class, 'byMonth']);
    Route::get('/', [UpcomingProgramController::class, 'index']);
    Route::get('/{id}', [UpcomingProgramController::class, 'show']);
    Route::post('/', [UpcomingProgramController::class, 'store']);
    Route::put('/{id}', [UpcomingProgramController::class, 'update']);
    Route::delete('/{id}', [UpcomingProgramController::class, 'destroy']);
});

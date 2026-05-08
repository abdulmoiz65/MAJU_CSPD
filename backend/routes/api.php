<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NavttcProgramController;
use App\Http\Controllers\Api\UpcomingProgramController;
use App\Http\Controllers\Api\CalendarController;
use App\Http\Controllers\Api\DiplomaProgramController;
use App\Http\Controllers\Api\LanguageCourseController;
use App\Http\Controllers\Api\SummerSchoolController;

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
    Route::get('/completed', [UpcomingProgramController::class, 'completed']);
    Route::get('/', [UpcomingProgramController::class, 'index']);
    Route::get('/{id}', [UpcomingProgramController::class, 'show']);
    Route::post('/', [UpcomingProgramController::class, 'store']);
    Route::put('/{id}', [UpcomingProgramController::class, 'update']);
    Route::delete('/{id}', [UpcomingProgramController::class, 'destroy']);
});

// Diploma Programs API routes
Route::prefix('diploma-programs')->group(function () {
    Route::get('/', [DiplomaProgramController::class, 'index']);
    Route::get('/{id}', [DiplomaProgramController::class, 'show']);
});

// Language Courses API routes
Route::prefix('language-courses')->group(function () {
    Route::get('/', [LanguageCourseController::class, 'index']);
    Route::get('/{id}', [LanguageCourseController::class, 'show']);
});

// Summer Schools API routes
Route::prefix('summer-schools')->group(function () {
    Route::get('/', [SummerSchoolController::class, 'index']);
    Route::get('/{id}', [SummerSchoolController::class, 'show']);
});

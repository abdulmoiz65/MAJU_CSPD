<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NavttcProgramController;
use App\Http\Controllers\Admin\UpcomingProgramController;
use App\Http\Controllers\Admin\CalendarController;
use App\Http\Middleware\AdminAuthenticate;

Route::prefix('admin')->name('admin.')->group(function () {

    // Public login routes
    Route::get('login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminLoginController::class, 'login'])->name('login.submit');

    // Protected admin routes
    Route::middleware(AdminAuthenticate::class)->group(function () {

        Route::post('logout', [AdminLoginController::class, 'logout'])->name('logout');

        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // NAVTTC Programs
        Route::get('/navttc-programs', [NavttcProgramController::class, 'index'])->name('navttc.index');
        Route::get('/navttc-programs/create', [NavttcProgramController::class, 'create'])->name('navttc.create');
        Route::post('/navttc-programs', [NavttcProgramController::class, 'store'])->name('navttc.store');
        Route::get('/navttc-programs/{id}/edit', [NavttcProgramController::class, 'edit'])->name('navttc.edit');
        Route::put('/navttc-programs/{id}', [NavttcProgramController::class, 'update'])->name('navttc.update');
        Route::delete('/navttc-programs/{id}', [NavttcProgramController::class, 'destroy'])->name('navttc.destroy');

        // Upcoming Programs
        Route::get('/upcoming-programs', [UpcomingProgramController::class, 'index'])->name('upcoming.index');
        Route::get('/upcoming-programs/create', [UpcomingProgramController::class, 'create'])->name('upcoming.create');
        Route::post('/upcoming-programs', [UpcomingProgramController::class, 'store'])->name('upcoming.store');
        Route::get('/upcoming-programs/{id}', [UpcomingProgramController::class, 'show'])->name('upcoming.show');
        Route::get('/upcoming-programs/{id}/edit', [UpcomingProgramController::class, 'edit'])->name('upcoming.edit');
        Route::put('/upcoming-programs/{id}', [UpcomingProgramController::class, 'update'])->name('upcoming.update');
        Route::delete('/upcoming-programs/{id}', [UpcomingProgramController::class, 'destroy'])->name('upcoming.destroy');

        // Calendars
        Route::get('/calendars', [CalendarController::class, 'index'])->name('calendars.index');
        Route::get('/calendars/create', [CalendarController::class, 'create'])->name('calendars.create');
        Route::post('/calendars', [CalendarController::class, 'store'])->name('calendars.store');
        Route::delete('/calendars/{calendar}', [CalendarController::class, 'destroy'])->name('calendars.destroy');

    });

});

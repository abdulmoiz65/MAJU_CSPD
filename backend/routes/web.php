<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NavttcProgramController;
use App\Http\Controllers\Admin\UpcomingProgramController;
use App\Http\Controllers\Admin\CalendarController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Admin\DiplomaProgramController;
use App\Http\Controllers\Admin\LanguageCourseController;
use App\Http\Controllers\Admin\SummerSchoolController;
use App\Http\Middleware\AdminAuthenticate;

Route::prefix('cspdadmin')->name('admin.')->group(function () {

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
        Route::put('/upcoming-programs/{id}/toggle-completed', [UpcomingProgramController::class, 'toggleCompleted'])->name('upcoming.toggle-completed');
        Route::get('/upcoming-programs/completed', [UpcomingProgramController::class, 'completedPrograms'])->name('upcoming.completed');
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
        Route::get('/calendars/{calendar}/edit', [CalendarController::class, 'edit'])
            ->name('calendars.edit');

        Route::put('/calendars/{calendar}', [CalendarController::class, 'update'])
            ->name('calendars.update');

        Route::delete('/calendars/{calendar}', [CalendarController::class, 'destroy'])
            ->name('calendars.destroy');

        // Users
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

        // Diploma Programs
        Route::get('/diploma-programs', [DiplomaProgramController::class, 'index'])->name('diploma.index');
        Route::get('/diploma-programs/create', [DiplomaProgramController::class, 'create'])->name('diploma.create');
        Route::post('/diploma-programs', [DiplomaProgramController::class, 'store'])->name('diploma.store');
        Route::get('/diploma-programs/{id}/edit', [DiplomaProgramController::class, 'edit'])->name('diploma.edit');
        Route::put('/diploma-programs/{id}', [DiplomaProgramController::class, 'update'])->name('diploma.update');
        Route::delete('/diploma-programs/{id}', [DiplomaProgramController::class, 'destroy'])->name('diploma.destroy');

        // Language Courses
        Route::get('/language-courses', [LanguageCourseController::class, 'index'])->name('language.index');
        Route::get('/language-courses/create', [LanguageCourseController::class, 'create'])->name('language.create');
        Route::post('/language-courses', [LanguageCourseController::class, 'store'])->name('language.store');
        Route::get('/language-courses/{id}/edit', [LanguageCourseController::class, 'edit'])->name('language.edit');
        Route::put('/language-courses/{id}', [LanguageCourseController::class, 'update'])->name('language.update');
        Route::delete('/language-courses/{id}', [LanguageCourseController::class, 'destroy'])->name('language.destroy');

        // Summer Schools
        Route::get('/summer-schools', [SummerSchoolController::class, 'index'])->name('summer.index');
        Route::get('/summer-schools/create', [SummerSchoolController::class, 'create'])->name('summer.create');
        Route::post('/summer-schools', [SummerSchoolController::class, 'store'])->name('summer.store');
        Route::get('/summer-schools/{id}/edit', [SummerSchoolController::class, 'edit'])->name('summer.edit');
        Route::put('/summer-schools/{id}', [SummerSchoolController::class, 'update'])->name('summer.update');
        Route::delete('/summer-schools/{id}', [SummerSchoolController::class, 'destroy'])->name('summer.destroy');
    });

});

// Catch-all route for React Frontend
Route::view('/{path?}', 'frontend')
    ->where('path', '.*');

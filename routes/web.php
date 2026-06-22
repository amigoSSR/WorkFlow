<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Alias for user dashboard (some views reference `user.dashboard`)
Route::get('/user/dashboard', function () {
    return view('user.dashboarduser');
})->middleware(['auth', 'verified'])->name('user.dashboard');

// User Routes
Route::middleware(['auth', 'verified'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboarduser', function () {
        return view('user.dashboarduser');         
    })->name('dashboard');

    Route::get('/diaryuser', [App\Http\Controllers\DiaryController::class, 'index'])->name('diaryuser');
    Route::get('/diaryuser/{id}', [App\Http\Controllers\DiaryController::class, 'show'])->name('diaryuser.show');
    Route::post('/diaryuser/{id}/roadmap', [App\Http\Controllers\DiaryController::class, 'storeRoadmap'])->name('diaryuser.roadmap.store');
    Route::post('/diaryuser/{id}/milestone', [App\Http\Controllers\DiaryController::class, 'storeMilestone'])->name('diaryuser.milestone.store');
    Route::post('/diaryuser/{id}/link', [App\Http\Controllers\DiaryController::class, 'storeLink'])->name('diaryuser.link.store');

    Route::get('/joinproject', [App\Http\Controllers\ProjectController::class, 'index'])->name('joinproject');
    Route::post('/project/store', [App\Http\Controllers\ProjectController::class, 'store'])->name('project.store');
    Route::post('/project/join', [App\Http\Controllers\ProjectController::class, 'join'])->name('project.join');
    
    Route::get('/calendar', function (\Illuminate\Http\Request $request) {
        $date = $request->input('date', now()->format('Y-m'));
        $currentDate = \Carbon\Carbon::parse($date . '-01');
        $events = \App\Models\Event::orderBy('start_date')->get();
        return view('user.calendar', compact('events', 'currentDate'));
    })->name('calendar');

    Route::get('/houseRule', function () {
        return view('user.houseRule');   
    })->name('houseRule');

    Route::get('/piket_schedule', function () {
        return view('user.JadwalPiket');           
    })->name('piket_schedule');
});

// Admin Routes
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/users', [AdminDashboardController::class, 'users'])->name('users');
    Route::put('/users/{user}/role', [AdminDashboardController::class, 'updateRole'])->name('users.role.update');
    Route::get('/projects', [AdminDashboardController::class, 'projects'])->name('projects');
    Route::get('/project-management', [AdminDashboardController::class, 'projectsList'])->name('project.management');
    Route::get('/check-up', [AdminDashboardController::class, 'checkUp'])->name('checkup');
    Route::get('/calendar', [AdminDashboardController::class, 'calendar'])->name('calendar');
    Route::get('/house-rules', [AdminDashboardController::class, 'houseRules'])->name('house.rules');
    Route::get('/piket', [AdminDashboardController::class, 'piket'])->name('piket');
    Route::get('/diary', [AdminDashboardController::class, 'diary'])->name('diary');
    
    // Piket
    Route::post('/piket', [App\Http\Controllers\PiketController::class, 'store'])->name('piket.store');
    Route::delete('/piket/{piket}', [App\Http\Controllers\PiketController::class, 'destroy'])->name('piket.destroy');
    
    Route::post('/events', [App\Http\Controllers\EventController::class, 'store'])->name('events.store');
    Route::delete('/events/{event}', [App\Http\Controllers\EventController::class, 'destroy'])->name('events.destroy');
});

// Diary Routes (placeholder)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/diary', function () {
        return view('diary');
    })->name('diary.index');
    Route::get('/calendar', function () {
        return view('calendar');
    })->name('calendar');
    Route::get('/house-rules', function () {
        return view('house-rules');
    })->name('house-rules');
    Route::get('/piket', function () {
        return view('piket');
    })->name('piket');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

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
Route::get('/user/dashboard', [App\Http\Controllers\UserDashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('user.dashboard');

// User Routes
Route::middleware(['auth', 'verified'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboarduser', [App\Http\Controllers\UserDashboardController::class, 'index'])->name('dashboard');

    Route::get('/diaryuser', [App\Http\Controllers\DiaryController::class, 'index'])->name('diaryuser');
    Route::get('/diaryuser/{id}', [App\Http\Controllers\DiaryController::class, 'show'])->name('diaryuser.show');
    Route::post('/diaryuser/{id}/roadmap', [App\Http\Controllers\DiaryController::class, 'storeRoadmap'])->name('diaryuser.roadmap.store');
    Route::post('/diaryuser/{id}/milestone', [App\Http\Controllers\DiaryController::class, 'storeMilestone'])->name('diaryuser.milestone.store');
    Route::patch('/diaryuser/milestone/{milestone}', [App\Http\Controllers\DiaryController::class, 'updateMilestoneStatus'])->name('diaryuser.milestone.update');
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
        $houseRules = \App\Models\HouseRule::ordered()->get();
        return view('user.houseRule', compact('houseRules'));   
    })->name('houseRule');

    Route::get('/piket_schedule', function () {
        $pikets = \App\Models\Piket::with('user')->get();

        $schedule = [
            'senin'        => $pikets->where('day', 'senin')->where('week_type', 'none'),
            'selasa'       => $pikets->where('day', 'selasa')->where('week_type', 'none'),
            'rabu'         => $pikets->where('day', 'rabu')->where('week_type', 'none'),
            'kamis'        => $pikets->where('day', 'kamis')->where('week_type', 'none'),
            'jumat_ganjil' => $pikets->where('day', 'jumat')->where('week_type', 'ganjil'),
            'jumat_genap'  => $pikets->where('day', 'jumat')->where('week_type', 'genap'),
            'sabtu_ganjil' => $pikets->where('day', 'sabtu')->where('week_type', 'ganjil'),
            'sabtu_genap'  => $pikets->where('day', 'sabtu')->where('week_type', 'genap'),
        ];

        return view('user.JadwalPiket', compact('schedule'));
    })->name('piket_schedule');

    // Weekly Checkup
    Route::get('/weekly-checkup', [App\Http\Controllers\WeeklyReportController::class, 'index'])->name('weekly_checkup');
    Route::post('/weekly-checkup/generate', [App\Http\Controllers\WeeklyReportController::class, 'generate'])->name('weekly_checkup.generate');
    Route::get('/weekly-checkup/download/{report}', [App\Http\Controllers\WeeklyReportController::class, 'download'])->name('weekly_checkup.download');

    // Notifications
    Route::post('/notifications/{id}/mark-as-read', function (\Illuminate\Http\Request $request, $id) {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->markAsRead();
        return response()->json(['success' => true]);
    })->name('notifications.mark_as_read');
    
    // Kanban milestone update
    Route::patch('/dashboard/milestone/{milestone}/status', [App\Http\Controllers\UserDashboardController::class, 'updateMilestoneStatus'])->name('dashboard.milestone.update_status');
});

// Admin Routes
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/users', [AdminDashboardController::class, 'users'])->name('users');
    Route::put('/users/{user}/role', [AdminDashboardController::class, 'updateRole'])->name('users.role.update');
    Route::get('/projects', [AdminDashboardController::class, 'projects'])->name('projects');
    Route::get('/project-management', [AdminDashboardController::class, 'projectsList'])->name('project.management');
    
    // Weekly Checkup Admin
    Route::get('/check-up', [App\Http\Controllers\WeeklyReportController::class, 'adminIndex'])->name('checkup');
    Route::post('/check-up/generate', [App\Http\Controllers\WeeklyReportController::class, 'adminGenerate'])->name('checkup.generate');
    Route::post('/check-up/generate-master', [App\Http\Controllers\WeeklyReportController::class, 'adminGenerateMaster'])->name('checkup.generate_master');
    Route::get('/check-up/download/{report}', [App\Http\Controllers\WeeklyReportController::class, 'download'])->name('checkup.download');
    Route::delete('/check-up/{report}', [App\Http\Controllers\WeeklyReportController::class, 'destroy'])->name('checkup.destroy');
    Route::get('/calendar', [AdminDashboardController::class, 'calendar'])->name('calendar');
    Route::get('/house-rules', [AdminDashboardController::class, 'houseRules'])->name('house.rules');
    Route::get('/house-rules/create', [AdminDashboardController::class, 'createHouseRule'])->name('house.rules.create');
    Route::post('/house-rules', [AdminDashboardController::class, 'storeHouseRule'])->name('house.rules.store');
    Route::get('/house-rules/{houseRule}', [AdminDashboardController::class, 'showHouseRule'])->name('house.rules.show');
    Route::get('/house-rules/{houseRule}/edit', [AdminDashboardController::class, 'editHouseRule'])->name('house.rules.edit');
    Route::put('/house-rules/{houseRule}', [AdminDashboardController::class, 'updateHouseRule'])->name('house.rules.update');
    Route::delete('/house-rules/{houseRule}', [AdminDashboardController::class, 'destroyHouseRule'])->name('house.rules.destroy');
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

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\OvertimeController;
use App\Http\Controllers\PasswordController;
use App\Http\Middleware\CheckRole;
use App\Http\Middleware\CheckPosition;
use App\Http\Middleware\RedirectIfAuthenticated;



// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

Route::middleware(RedirectIfAuthenticated::class)->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('index.login');
    Route::post('/login', [AuthController::class, 'auth']) -> name('auth.login');

});


Route::middleware('auth')->group(function () {
    Route::get('/dashboard/user', [HomeController::class, 'index'])->name('dashboard.user');
    Route::get('/dashboard/admin', [DashboardController::class, 'index']) -> name('dashboard.admin')->middleware(CheckRole::class);
    Route::resource('/attendances', AttendanceController::class)->only(['index', 'create'])->middleware(CheckRole::class);
    Route::get('/attendances/edit', [AttendanceController::class, 'edit'])->name('attendances.edit');
    Route::get('/attendances/delete/{id}', [AttendanceController::class, 'delete'])->name('attendances.destroy')->middleware(CheckRole::class);;
    
    Route::get('/absensi/{attendance}', [HomeController::class, 'show'])->name('dashboard.show');
    Route::resource('/employees', EmployeeController::class)->only(['index', 'create']);
    Route::get('/employees/edit/{id}', [EmployeeController::class, 'edit'])->name('employees.edit');
    Route::get('/employees/delete/{id}', [EmployeeController::class, 'delete'])->name('employees.destroy')->middleware(CheckRole::class);
    Route::get('/password-change/{role}',[PasswordController::class, 'ShowChangeForm'])->name('password.show');

    Route::resource('/overtimes',OvertimeController::class)->only(['index', 'create']);
    Route::get('/overtimes/report/{condition}', [OvertimeController::class, 'showReport'])->name('overtimes.report');
    Route::get('overtimes/report/show/{id}', [OvertimeController::class, 'show'])->name('overtimes.show');
    Route::get('overtimes/report/edit/{id}', [OvertimeController::class, 'edit'])->name('overtimes.edit');
    Route::get('overtimes/report/delete/{id}', [OvertimeController::class, 'delete'])->name('overtimes.destroy');
    Route::post('/overtimes/{overtime}/approve', [OvertimeController::class, 'approve'])->name('overtimes.approve');
    Route::post('/overtimes/{overtime}/reject', [OvertimeController::class, 'reject'])->name('overtimes.reject');
    Route::delete('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    
    Route::resource('/presences', PresenceController::class)->only(['index']);
    Route::get('/presences/{attendance}', [PresenceController::class, 'show'])->name('presences.show');
    // not present data
    Route::get('/presences/{attendance}/not-present', [PresenceController::class, 'notPresent'])->name('presences.not-present');
    Route::post('/presences/{attendance}/not-present', [PresenceController::class, 'notPresent']);
    // present (url untuk menambahkan/mengubah user yang tidak hadir menjadi hadir)
    Route::post('/presences/{attendance}/present', [PresenceController::class, 'presentUser'])->name('presences.present');
    Route::post('/presences/{attendance}/acceptPermission', [PresenceController::class, 'acceptPermission'])->name('presences.acceptPermission');
});

Route::get('/', function () {
    $data = [
        'title' => 'Home'
    ];
    return view('home.home', $data);
});

Route::get('/about', function () {
    $data = [
        'title' => 'About'
    ];
    return view('home.about', $data);
});











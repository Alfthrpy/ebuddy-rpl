<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;



// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('index.login');
    Route::post('/login', [AuthController::class, 'auth']) -> name('auth.login');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard-pegawai', [HomeController::class, 'index'])->name('dashboard.pegawai');
    Route::post('/dashboard-pejabat', [HomeController::class, 'index']) -> name('dashboard.pejabat');
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









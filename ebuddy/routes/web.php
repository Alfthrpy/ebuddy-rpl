<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;



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
    Route::get('/login', [AuthController::class, 'index'])->name('auth.login');
    Route::post('/login', [AuthController::class, 'authenticate']) -> name('login');
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

Route::get('/dashboard', function () {
    $data = [
        'title' => 'dashboard'
    ];

    return view('dashboard.index', $data);
});






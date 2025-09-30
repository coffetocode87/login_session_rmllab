<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Route Public (Tanpa Login)
|--------------------------------------------------------------------------
*/
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLogin')->name('login');
    Route::post('/login', 'login')->name('login.post');

    Route::get('/register', 'showRegister')->name('register');
    Route::post('/register', 'register')->name('register.post');
});

/*
|--------------------------------------------------------------------------
| Route Butuh Login + Force Session Timeout
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'force.session.timeout'])->group(function () {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard umum
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Admin Only
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin')->middleware('role:admin')->group(function () {
        Route::get('/', fn () => view('admin.dashboard'))->name('admin.dashboard');
    });

    /*
    |--------------------------------------------------------------------------
    | User Only
    |--------------------------------------------------------------------------
    */
    Route::prefix('user')->middleware('role:user')->group(function () {
        Route::get('/', fn () => view('user.dashboard'))->name('user.dashboard');
    });
});

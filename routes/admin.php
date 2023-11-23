<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;


Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware(['guest:admin', 'PreventBackHistory'])->group(function () {
        Route::view('/login', 'dashboard.admin.login')->name('login');
        Route::post('/check', [AdminController::class, 'check'])->name('check');
    });

    Route::middleware(['auth:admin', 'PreventBackHistory'])->group(function () {
        Route::view('/dashboard', 'dashboard.admin.dashboard')->name('dashboard');
        Route::get('/logout', [AdminController::class, 'logout'])->name('logout');
    });
});

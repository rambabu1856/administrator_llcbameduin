<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Select\SelectBox;
use App\Http\Controllers\Admin\StudentManagement\StudentProfileController;
use App\Http\Controllers\Admin\StudentManagement\StudentPromotionController;
use App\Http\Controllers\Admin\StudentManagement\AdmissionRegisterController;


Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware(['guest:admin', 'PreventBackHistory'])->group(function () {
        Route::view('/login', 'dashboard.admin.login')->name('login');
        Route::post('/check', [AdminController::class, 'check'])->name('check');
    });

    Route::middleware(['auth:admin', 'PreventBackHistory'])->group(function () {

        Route::get('/cache', function () {
            /**[SAFE] Clears all cache with 1 line!**/
            Artisan::call('route:clear');
            Artisan::call('view:clear');
            Artisan::call('config:clear');
            Artisan::call('event:clear');
            Artisan::call('cache:clear');
            Artisan::call('optimize:clear');
            Session::flush();
            Artisan::call('clear-compiled');
            return redirect()->route('admin.login')->with('success', 'Cache Cleared');
        });


        Route::view('/dashboard', 'dashboard.admin.dashboard')->name('dashboard');
        Route::get('/logout', [AdminController::class, 'logout'])->name('logout');

        // SELECT BOX
        Route::POST('getBatch', [SelectBox::class, 'getBatch'])->name('getBatch');
        Route::POST('getAcademicYear', [SelectBox::class, 'getAcademicYear'])->name('getAcademicYear');
        Route::POST('getAcademicYearGrade', [SelectBox::class, 'getAcademicYearGrade'])->name('getAcademicYearGrade');

        // STUDENT MANAGEMENT
        Route::resource('/student_profile', StudentProfileController::class);
        Route::resource('/student_admission_register', AdmissionRegisterController::class);
        Route::resource('/student_promotion', StudentPromotionController::class);
    });
});

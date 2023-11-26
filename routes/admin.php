<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Select\SelectBox;
use App\Http\Controllers\Admin\FeeManagement\FeeGroupHeadController;
use App\Http\Controllers\Admin\FeeManagement\FeeStractureController;
use App\Http\Controllers\Admin\FeeManagement\FeeStructureController;
use App\Http\Controllers\Admin\FeeManagement\FeeSubGroupHeadController;
use App\Http\Controllers\Admin\StudentManagement\StudentProfileController;
use App\Http\Controllers\Admin\StudentManagement\StudentPromotionController;
use App\Http\Controllers\Admin\StudentManagement\AdmissionRegisterController;
use App\Models\StudentFee\FeeStructure;

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
        Route::POST('promoteStudentFromGrade ', [SelectBox::class, 'promoteStudentFromGrade'])->name('promoteStudentFromGrade');
        Route::POST('promoteStudentToGrade ', [SelectBox::class, 'promoteStudentToGrade'])->name('promoteStudentToGrade');


        Route::POST('getAcademicYear', [SelectBox::class, 'getAcademicYear'])->name('getAcademicYear');
        Route::POST('getAcademicYearGrade', [SelectBox::class, 'getAcademicYearGrade'])->name('getAcademicYearGrade');
        Route::POST('getSbcReferenceNumber', [SelectBox::class, 'getSbcReferenceNumber'])->name('getSbcReferenceNumber');

        // STUDENT MANAGEMENT
        Route::resource('/student_profile', StudentProfileController::class);
        Route::resource('/student_admission_register', AdmissionRegisterController::class);
        Route::resource('/student_promotion', StudentPromotionController::class);

        // FEE MANAGEMENT
        Route::POST('getEligibleFee', [FeeStructureController::class, 'getEligibleFee'])->name('getEligibleFee');
        Route::resource('/fee_structure', FeeStructureController::class);
        Route::resource('/fee_group_head', FeeGroupHeadController::class);
        Route::resource('/fee_sub_group_head', FeeSubGroupHeadController::class);
    });
});

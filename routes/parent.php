<?php

use App\Http\Controllers\Students\Dashboard\ExamController;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


//==============================Translate all pages============================
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:parent']
    ],
    function () {

        //==============================dashboard============================
        Route::get('/parent/dashboard', function () {
            $sons = Student::where('parent_id',Auth::guard('parent')->user()->id)->get();
            return view('pages.Parents.dashboard',compact('sons'));
        });
        Route::group(['prefix' => 'Parents/dashboard'], function () {
            Route::resource('student_exams', ExamController::class);
            Route::resource('profile_stu', \App\Http\Controllers\Students\Dashboard\Student_profileController::class);
            Route::post('profile_stu/{id}',[\App\Http\Controllers\Students\Dashboard\Student_profileController::class,'update'])->name('profile.update');

        });
    }
);

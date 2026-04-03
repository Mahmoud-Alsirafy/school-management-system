<?php

use App\Http\Controllers\Students\Dashboard\ExamController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


//==============================Translate all pages============================
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:student']
    ],
    function () {

        //==============================dashboard============================
        Route::get('/student/dashboard', function () {
            return view('pages.Students.dashboard');
        });
        Route::group(['prefix' => 'Students/dashboard'], function () {
            Route::resource('student_exams', ExamController::class);
        });
    }
);

<?php

use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Teachers\dashboard\StudentController;


//==============================Translate all pages============================
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:teacher']
    ], function () {

    //==============================dashboard============================
    Route::get('/teacher/dashboard', function () {

        $teacher_id = Teacher::find(Auth::guard('teacher')->user()->id)->section()->pluck('section_id');
        $data['count'] = $teacher_id->count();
        $data['count_students'] = Student::whereIn('section_id', $teacher_id)->count();
        return view('pages.Teacher.dashboard.dashboard',$data);
    });

    Route::group(['prefix' => 'Teachers/dashboard'], function () {
        Route::get('student',[StudentController::class,'index'])->name('student.index');
        Route::get('sections',[StudentController::class,'sections'])->name('sections');
        Route::post('attendance',[StudentController::class,'attendance'])->name('attendance');
        Route::get('attendance_report',[StudentController::class,'attendance_report'])->name('attendance_report');
        Route::post('attendance.search',[StudentController::class,'attendance_search'])->name('attendance.search');

    });
});

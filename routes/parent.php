<?php

use App\Http\Controllers\Parent\Dashboard\ChildrenController;
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
        Route::group(['prefix' => 'Parent/Dashboard'], function () {
            Route::get("childern" , [ChildrenController::class,'index'])->name('sons');
            Route::get("results/{id}" , [ChildrenController::class,'results'])->name('sons.results');
            Route::get("attendances/{id}" , [ChildrenController::class,'attendances'])->name('sons.attendances');
        });
    }
);

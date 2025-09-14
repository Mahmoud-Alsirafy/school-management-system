<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Grade\GradeController;
use App\Http\Controllers\Section\Sectioncoltroller;
use App\Http\Controllers\Students\studentController;
use App\Http\Controllers\Teachers\TeacherController;
use App\Http\Controllers\ClassRooms\ClassRoomsController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(['middleware' => ['guest']], function () {

    Route::get('/', function () {
        return view('auth.login');
    });

});

 //==============================Translate all pages============================
Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
    /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
    //==============================middleware============================
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
     //==============================dashboard============================


    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

     //==============================grade============================


    Route::resource('grade', GradeController::class);

     //==============================Classrooms============================

    Route::resource('Classrooms', ClassRoomsController::class);
    Route::post('delete_all', [ClassRoomsController::class, 'delete_all'])->name('delete_all');

    Route::post('Filter_Classes', [ClassRoomsController::class, 'Filter_Classes'])->name('Filter_Classes');

     //==============================Sections============================

    Route::resource('Sections',Sectioncoltroller::class);
    Route::get('classes/{id}',[Sectioncoltroller::class,'get_classrooms'])->name('get_classrooms');

    // ===============================Teacher============================

        Route::resource('Teachers',TeacherController::class);


    // ===============================Students===========================

        Route::resource('Students',studentController::class);
        Route::get('/Get_classrooms/{id}',[studentController::class,'Get_classrooms']);
        Route::get('/Get_Sections/{id}',[studentController::class,'Get_Sections']);
        Route::post('Upload_attachment',[studentController::class,'Upload_attachment'])->name('Upload_attachment');
        Route::get('Download_attachment/{studentsname}/{filename}', [studentController::class,'Download_attachment'])->name('Download_attachment');
        Route::post('Delete_attachment',[studentController::class,'Delete_attachment'])->name("Delete_attachment");
    require __DIR__ . '/auth.php';
});

//==============================parents============================
Route::view('add_parent','livewire.Show_Form');



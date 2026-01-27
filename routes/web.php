<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Fees\FeesController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Grade\GradeController;
use App\Http\Controllers\FeesInvoices\FeesInvoices;
use App\Http\Controllers\library\libraryController;
use App\Http\Controllers\Payment\PaymentController;
use App\Http\Controllers\QR_CODE\Qr_codeController;
use App\Http\Controllers\Quizzes\QuizzesController;
use App\Http\Controllers\Section\Sectioncoltroller;
use App\Http\Controllers\Setting\SettingController;
use App\Http\Controllers\Subject\SubjectController;
use App\Http\Controllers\Students\studentController;
use App\Http\Controllers\Teachers\TeacherController;
use App\Http\Controllers\Question\QuestionController;
use App\Http\Controllers\Online_classes\OnlineClasses;
use App\Http\Controllers\Students\GraduatedController;
use App\Http\Controllers\Students\PromotionController;
use App\Http\Controllers\Attendance\AttendanceController;
use App\Http\Controllers\ClassRooms\ClassRoomsController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\ProcessingFees\ProcessingFeesController;
use App\Http\Controllers\ReceiptStudent\ReceiptStudentController;
use App\Http\Controllers\StudentAccount\StudentAccountController;

// Route::group(['middleware' => ['guest']], function () {

//     Route::get('/', function () {
//         return view('auth.login');
//     });
// });

Route::group(['prefix' => LaravelLocalization::setLocale()], function () {




    Route::get('/', [HomeController::class, 'index'])->name('selection');

    Route::group(['namespace' => 'Auth'], function () {
        Route::get('/login/{type}', [LoginController::class, 'loginFom'])->middleware('guest')->name('login.show');
        Route::post('/login', [LoginController::class, 'login'])->name('login');
        Route::get('/login', function () {
            return redirect()->route('selection');
        })->name('login');
        Route::post('/logout/{type}', [LoginController::class, 'logout'])->name('logout');
    });


    Route::get('/dashboard', [HomeController::class, 'dashboard'])->middleware('auth')->name('dashboard');



//==============================Translate all pages============================
    /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
    //==============================middleware============================
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
    //==============================dashboard============================


    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->middleware(['auth', 'verified'])->name('dashboard');

    //==============================grade============================


    Route::resource('grade', GradeController::class);

    //==============================Classrooms============================

    Route::resource('Classrooms', ClassRoomsController::class);
    Route::post('delete_all', [ClassRoomsController::class, 'delete_all'])->name('delete_all');

    Route::post('Filter_Classes', [ClassRoomsController::class, 'Filter_Classes'])->name('Filter_Classes');

    //==============================Sections============================

    Route::resource('Sections', Sectioncoltroller::class);
    Route::get('classes/{id}', [Sectioncoltroller::class, 'get_classrooms'])->name('get_classrooms');

    // ===============================Teacher============================

    Route::resource('Teachers', TeacherController::class);


    // ===============================Students===========================

    Route::group(['prefix' => 'Students'], function () {
        Route::resource('Students', studentController::class);
        Route::get('/Get_classrooms/{id}', [studentController::class, 'Get_classrooms']);
        Route::get('/Get_Sections/{id}', [studentController::class, 'Get_Sections']);
        Route::post('Upload_attachment', [studentController::class, 'Upload_attachment'])->name('Upload_attachment');
        Route::get('Download_attachment/{studentsname}/{filename}', [studentController::class, 'Download_attachment'])->name('Download_attachment');
        Route::post('Delete_attachment', [studentController::class, 'Delete_attachment'])->name("Delete_attachment");
        // ==============================Fees_Invoices===========================
        Route::resource('Fees_Invoices', FeesInvoices::class);
        // ===============================Fees===========================
        Route::resource('Fees', FeesController::class);
        // ===============================Receipt===========================
        Route::resource('Receipt', ReceiptStudentController::class);
        // ===============================Processing===========================
        Route::resource('Processing', ProcessingFeesController::class);
        // ===============================Payment===========================
        Route::resource('Payment', PaymentController::class);
        // ===============================Attendance===========================
        Route::resource('Attendance', AttendanceController::class);
    });
    // ===============================Subject===========================

    Route::group(['prefix' => 'Subject'], function () {
        Route::resource('subjects', SubjectController::class);
    });


    // =====================Quizzes==========================

    Route::group(['prefix' => 'Quizzes'], function () {
        Route::resource('Quizzes', QuizzesController::class);
    });


    // ===============================Promotion===========================


    Route::resource('Promotion', PromotionController::class);


    // ===============================Graduated===========================
    Route::resource('Graduated', GraduatedController::class);




    // ===============================QR===========================
    Route::resource('qrcode', Qr_codeController::class);
    Route::post('qrcode', [Qr_codeController::class, 'generate'])->name("generate");

    // =============================StudentAccountController===========

    Route::resource('StudentAccount', StudentAccountController::class);


    // =============================Question========================
    Route::group(['prefix' => 'Question'], function () {
        Route::resource('Question', QuestionController::class);
    });

    // =============================Question========================
    Route::group(['prefix' => 'Online'], function () {
        Route::resource('Online', OnlineClasses::class);
        Route::get('indirect_admin', [OnlineClasses::class, 'indirectCreate'])->name('indirect.create.admin');
        Route::post('indirect_admin', [OnlineClasses::class, 'storeIndirect'])->name('indirect.store.admin');
    });


    // =============================Question========================
    Route::group(['prefix' => 'library'], function () {
        Route::resource('library', libraryController::class);
        Route::get('/downloadAttachment/{id}', [libraryController::class, 'downloadAttachment'])->name('downloadAttachment');
    });


    // ============================Settings======================
    Route::group(['prefix' => 'Setting'], function () {
        Route::resource('Setting', SettingController::class);
    });

    // require __DIR__ . '/auth.php';
});

//==============================parents============================
Route::view('add_parent', 'livewire.Show_Form')->name('add_parent');

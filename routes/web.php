<?php

use App\Http\Controllers\Attendance\AttendanceController;
use App\Http\Controllers\Classrooms\ClassroomController;
use App\Http\Controllers\Exams\ExamController;
use App\Http\Controllers\Fees\FeesController;
use App\Http\Controllers\Fees\FeesinvoicesController;
use App\Http\Controllers\Grades\GradeController;

use App\Http\Controllers\Payment\PaymentController;
use App\Http\Controllers\ProcessingFee\ProcessingFeeController;
use App\Http\Controllers\Sections\SectionController;
use App\Http\Controllers\Students\GratuatedController;
use App\Http\Controllers\Students\PromotionController;
use App\Http\Controllers\Students\StudentController;
use App\Http\Controllers\Subject\SubjectController;
use App\Http\Controllers\Teachers\TeacherController;
use App\Models\Profile;
use App\Repository\GraduatedRepository;
use Livewire\Livewire;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\Route;
use App\Livewire\AddParent;
use App\Http\Controllers\ReceiptStudents\ReceiptStudentsController;

/*
|--------------------------------------------------------------------------
| Livewire Routes (Let Laravel handle automatically)
|--------------------------------------------------------------------------
*/
// Remove custom Livewire configuration - Laravel will handle it automatically

/*
|--------------------------------------------------------------------------
| Public routes (localized)
|--------------------------------------------------------------------------
*/
Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [
        'localeSessionRedirect',
        'localizationRedirect',
        'localeViewPath',
        'guest'
    ],
], function () {
    Route::view('/auth', 'auth.auth')->name('auth');
    Route::get('/login', fn() => view('auth.auth'))->name('login');
    Route::get('/register', fn() => view('auth.auth'))->name('register');
});

/*
|--------------------------------------------------------------------------
| Authenticated routes (localized)
|--------------------------------------------------------------------------
*/
Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [
        'localeSessionRedirect',
        'localizationRedirect',
        'localeViewPath',
        'auth',
    ],
], function () {

    // Dashboard
   
    Route::get('/', fn() => view('/dashboard'))->name('dashboard');

    // Grades
    Route::resource('Grades', GradeController::class);

    // Classrooms & Sections
    Route::resource('Classrooms', ClassroomController::class);
    Route::resource('Sections', SectionController::class);
    Route::get('/classes/{id}', [SectionController::class, 'getclasses']);

    // Parents (Livewire form)
    Route::view('add_parent', 'livewire.show_Form')->name('add_parent');
     Route::view('Parents','livewire.show_parent')->name('Parents');
     Route::view('edit-parent','livewire.edit-parent')->name('Edit');
     Route::get('/edit_parent/{id}', \App\Livewire\EditParent::class)->name('edit-parent');
    Route::resource('Teachers',         TeacherController::class);
    Route::resource('Students',         StudentController::class);
    Route::get('/Get_classrooms/{id}',[StudentController::class,'Get_classrooms']);
    Route::get('Get_Sections/{id}',[StudentController::class,'Get_Sections']);
    Route::post('Upload_attachment', [StudentController::class,'Upload_attachment'])->name('Upload_attachment');
    Route::get('Download_attachment/{student_name}/{file_name}', [StudentController::class,'Download_attachment'])->name('Download_attachment');
    Route::post('Delete_attachment', [StudentController::class,'Delete_attachment'])->name('Delete_attachment');
    Route::resource('Promotion',PromotionController::class);
    Route::resource('Graduated',GratuatedController::class);
   Route::delete('Promotions/management/Graduate_one', [GratuatedController::class, 'delete_one'])->name('Graduated.delete_one');
    Route::resource('Fees',FeesController::class);
    Route::resource('Fees_invoices',FeesinvoicesController::class);
    Route::resource('profile',Profile::class);
    // IMPORTANT: Livewire route MUST be inside the localized group
       Route::post('/livewire/update', function () {
        return app(\Livewire\Mechanisms\HandleRequests\HandleRequests::class)->handleUpdate();
    });
    
    Route::post('/livewire/upload-file', function () {
        return app(\Livewire\Features\SupportFileUploads\FileUploadController::class)->handle();
    });
     Route::resource('receipt_students', ReceiptStudentsController::class);
     Route::resource('ProcessingFee',ProcessingFeeController::class);

    Route::resource('Payment_students',PaymentController::class);
    Route::resource('Attendance', AttendanceController::class);
    Route::resource('subjects',SubjectController::class);
    Route::resource('Exams',ExamController::class);
});
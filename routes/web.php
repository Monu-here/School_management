<?php

use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\ExamController;
use App\Http\Controllers\Admin\GradeController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\MarkController;
use App\Http\Controllers\Admin\MarksController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\StudentPromotion;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Front\HomeController as FrontHomeController;
use App\Mail\MyEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::name('front.')->group(function () {
    Route::get('', [FrontHomeController::class, 'index'])->name('index');
    Route::get('about', [FrontHomeController::class, 'about'])->name('about');
    Route::get('course', [FrontHomeController::class, 'course'])->name('course');
    Route::get('team', [FrontHomeController::class, 'team'])->name('team');
    Route::get('testo', [FrontHomeController::class, 'testo'])->name('testo');
    Route::get('contact', [FrontHomeController::class, 'contact'])->name('contact');
});

// This route is for Admin & Tecaher  login START
Route::prefix('admin')->name('adminLogin.')->group(function () {
    Route::match(['GET', 'POST'], '', [LoginController::class, 'login'])->name('login');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});
// This route is for Admin & Tecaher  login END

// This route is for admin site START

// Route::prefix('AdminDashboard')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
Route::prefix('AdminDashboard')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('', [HomeController::class, 'index'])->name('index');
    Route::prefix('setting')->name('setting.')->group(function () {
        Route::match(['GET', 'POST'], '', [SettingController::class, 'add'])->name('add');
    });
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('', [LoginController::class, 'index'])->name('index');
        Route::match(['GET', 'POST'], 'add', [LoginController::class, 'add'])->name('add');
        // Route::match(['GET', 'POST'], 'edit/{user}', [LoginController::class, 'edit'])->name('edit');
        Route::get('show/{userId}', [LoginController::class, 'show'])->name('show');
        Route::get('del/{user}', [LoginController::class, 'del'])->name('del');
        Route::get('role/teacher', [LoginController::class, 'roleTeacher'])->name('roleTeacher');
    });
    Route::prefix('student')->name('student.')->group(function () {
        Route::get('', [StudentController::class, 'index'])->name('index');
        Route::match(['GET', 'POST'], 'add', [StudentController::class, 'add'])->name('add');
        Route::get('student/show/{student}', [StudentController::class, 'studentShow'])->name('studentShow');
        Route::get('del/{student}', [StudentController::class, 'del'])->name('del');
        Route::get('teacher', [StudentController::class, 'teacherIndex'])->name('teacherIndex');
        Route::match(['GET', 'POST'], 'teacheradd', [StudentController::class, 'teacheradd'])->name('teacheradd');
        Route::get('teacher/show/{teacher}', [StudentController::class, 'teacherShow'])->name('teacherShow');
    });
    Route::prefix('department')->name('department.')->group(function () {
        Route::get('', [DepartmentController::class, 'index'])->name('index');
        Route::match(['GET', 'POST'], 'add', [DepartmentController::class, 'add'])->name('add');
    });
    Route::prefix('payment')->name('payment.')->group(function () {
        Route::get('', [PaymentController::class, 'index'])->name('index');
        Route::match(['GET', 'POST'], 'add', [PaymentController::class, 'add'])->name('add');
        Route::match(['GET', 'POST'], 'studentPayment', [PaymentController::class, 'studentPaymentList'])->name('studentPayment');
        Route::match(['GET', 'POST'], 'studentPaymentAdd/{student_id}', [PaymentController::class, 'studentPaymentAdd'])->name('studentPaymentAdd');
        Route::get('printBill/{student_id}', [PaymentController::class, 'printBill'])->name('printBill');
    });
    Route::prefix('promotion')->name('promotion.')->group(function () {
        Route::get('list', [StudentPromotion::class, 'list'])->name('list');
        Route::match(['GET', 'POST'], '', [StudentPromotion::class, 'index'])->name('index');
        Route::match(['GET', 'POST'], '/pp', [StudentPromotion::class, 'p'])->name('p');
    });
    Route::prefix('exam')->name('exam.')->group(function () {
        Route::get('', [ExamController::class, 'index'])->name('index');
        Route::match(['GET', 'POST'], 'add', [ExamController::class, 'add'])->name('add');
    });
    Route::prefix('grade')->name('grade.')->group(function () {
        Route::get('', [GradeController::class, 'index'])->name('index');
        Route::match(['GET', 'POST'], 'add', [GradeController::class, 'add'])->name('add');
    });
    Route::prefix('mark')->name('mark.')->group(function () {
        Route::get('', [MarkController::class, 'index'])->name('index');
        Route::match(['GET', 'POST'], 'add', [MarkController::class, 'add'])->name('add');
        Route::post('/admin/marks/students', [MarkController::class, 'getStudents'])->name('marks.students');
        Route::post('/admin/marks/store', [MarkController::class, 'storeMarks'])->name('store');
        Route::get('/admin/marksheet/{studentId}', [MarkController::class, 'marksheet'])->name('admin.marksheet');
        Route::post('/send-marksheet-email/{sendMail}', [MarkController::class, 'sendMarksheetEmail'])->name('admin.mark.email');
        Route::get('/download-marksheet/{studentId}', [MarkController::class, 'downloadMarksheet'])->name('admin.mark.download');
    });
});
// Here admin route will be END

// This route is for teacher Dashboard START
Route::prefix('TeacherDashboard')->name('teacher.')->middleware(['auth', 'teacher'])->group(function () {
    Route::get('', [TeacherController::class, 'index'])->name('index');
    // Add other teacher-specific routes here
});
// Here route of teacher END

Route::prefix('StudentDashboard')->name('student.')->middleware(['auth', 'student'])->group(function () {
    // Route::get('', [StudentController::class, 'index'])->name('index');
    // Add other student-specific routes here
});

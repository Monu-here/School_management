<?php

use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\ExamController;
use App\Http\Controllers\Admin\GradeController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\StudentPromotion;
use App\Http\Controllers\Admin\TeacherController;
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





Route::prefix('admin')->name('adminLogin.')->group(function () {
    Route::match(['GET', 'POST'], '', [LoginController::class, 'login'])->name('login');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});


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
    });
    Route::prefix('student')->name('student.')->group(function () {
        Route::get('', [StudentController::class, 'index'])->name('index');
        Route::match(['GET', 'POST'], 'add', [StudentController::class, 'add'])->name('add');
        Route::get('student/show/{student}', [StudentController::class, 'studentShow'])->name('studentShow');
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
        Route::get('', [ExamController::class, 'index']);
    });
    Route::prefix('grade')->name('grade.')->group(function () {
        Route::get('', [GradeController::class, 'index'])->name('index');
    });
});










Route::prefix('TeacherDashboard')->name('teacher.')->middleware(['auth', 'teacher'])->group(function () {
    Route::get('', [TeacherController::class, 'index'])->name('index');
    // Add other teacher-specific routes here
});

Route::prefix('StudentDashboard')->name('student.')->middleware(['auth', 'student'])->group(function () {
    // Route::get('', [StudentController::class, 'index'])->name('index');
    // Add other student-specific routes here
});

<?php

use App\Http\Controllers\Admin\AttendenceController;
use App\Http\Controllers\Admin\CommunicationController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\ExamController;
use App\Http\Controllers\Admin\FrontDetailController;
use App\Http\Controllers\Admin\GradeController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\MarkController;
use App\Http\Controllers\Admin\MarksController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\RolePermissionController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\StudentPromotion;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Front\HomeController as FrontHomeController;
use App\Http\Controllers\Front\ServiceController;
use App\Http\Controllers\Teacher\DepartmentController as TeacherDepartmentController;
use App\Http\Controllers\Teacher\TeacherDashbaordController;
use App\Mail\MyEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|-----------------------------------------------------------------------------------------------------------
| Web Routes
|------------------------------------------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('', [FrontHomeController::class, 'home'])->name('home');
Route::get('about', [FrontHomeController::class, 'about'])->name('about');
Route::get('course', [FrontHomeController::class, 'course'])->name('course');
Route::get('team', [FrontHomeController::class, 'team'])->name('team');
Route::get('testo', [FrontHomeController::class, 'testo'])->name('testo');
Route::get('contact', [FrontHomeController::class, 'contact'])->name('contact');


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
    Route::post('create-event', [HomeController::class, 'createEvent'])->name('event');
    Route::get('del-event/{event}', [HomeController::class, 'eventDel'])->name('eventDel');
    Route::get('view/notice/{id}', [HomeController::class, 'viewNotice'])->name('showme');

     Route::match(['GET', 'POST'], 'role-add', [RolePermissionController::class, 'addRole'])->name('role.add');
    Route::match(['GET', 'POST'], 'role-permission', [RolePermissionController::class, 'addPermission'])->name('permission.add');
    Route::match(['GET', 'POST'], 'give-role/{user}', [RolePermissionController::class, 'giveRole'])->name('give.role');
    Route::match(['GET', 'POST'], 'assign-permission-to-role/{role}', [RolePermissionController::class, 'assignPerRole'])->name('assign.permission.to.role');



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

    Route::prefix('frontdetail')->name('frontdetail.')->group(function () {
        Route::get('', [FrontDetailController::class, 'index'])->name('index');
        Route::match(['GET', 'POST'], 'slider', [FrontDetailController::class, 'slider'])->name('slider');
        Route::match(['GET', 'POST'], 'slider/edit{slider}', [FrontDetailController::class, 'sliderEdit'])->name('sliderEdit');
        Route::get('slider/del/{slider}', [FrontDetailController::class, 'sliderDel'])->name('sliderDel');
        Route::get('service', [FrontDetailController::class, 'service'])->name('service');
        Route::match(['GET', 'POST'], 'serviceAdd', [FrontDetailController::class, 'serviceAdd'])->name('serviceAdd');
        Route::get('service/del/{service}', [FrontDetailController::class, 'serviceDel'])->name('serviceDel');
        Route::get('about-us', [FrontDetailController::class, 'aboutUs'])->name('aboutUs');
        Route::match(['GET', 'POST'], 'aboutUsAdd', [FrontDetailController::class, 'aboutUsAdd'])->name('aboutUsAdd');
    });

    Route::prefix('notice')->name('notice.')->group(function () {
        Route::get('', [CommunicationController::class, 'index'])->name('index');
        Route::match(['GET', 'POST'], 'add', [CommunicationController::class, 'add'])->name('add');
        Route::match(['GET', 'POST'], 'edit/{notice}', [CommunicationController::class, 'edit'])->name('edit');
        Route::get('del/{notice}', [CommunicationController::class, 'del'])->name('del');
        // Route::get('show/{notice}', [CommunicationController::class, 'show'])->name('show');
    });
    Route::prefix('atten')->name('atten.')->group(function () {
        Route::match(['GET', 'POST'], '', [AttendenceController::class, 'index'])->name('index');
        Route::match(['GET', 'POST'], 'mark', [AttendenceController::class, 'mark'])->name('mark');
        // Route::match(['GET', 'POST'], 'mark/{studentId}', [AttendenceController::class, 'mark'])->name('mark');
        Route::match(['GET', 'POST'], 'my-report', [AttendenceController::class, 'report'])->name('report');
        // Route::match(['GET', 'POST'], 'my-report', [AttendenceController::class, 'getAttendance'])->name('report');
        // dd(1);
    });
});
// Here admin route will be END

// This route is for teacher Dashboard START
Route::prefix('TeacherDashboard')->name('teacher.')->middleware(['auth', 'teacher'])->group(function () {
    Route::get('', [TeacherDashbaordController::class, 'index'])->name('index');
    Route::post('create-event', [TeacherDashbaordController::class, 'createEvent'])->name('event');
    Route::prefix('departments')->name('departments.')->group(function () {
        Route::get('', [TeacherDepartmentController::class, 'index'])->name('index');
        Route::match(['GET', 'POST'], 'add', [TeacherDepartmentController::class, 'add'])->name('add');
    });


    // Add other teacher-specific routes here
});
// Here route of teacher END

Route::prefix('StudentDashboard')->name('student.')->middleware(['auth', 'student'])->group(function () {
    // Route::get('', [StudentController::class, 'index'])->name('index');
    // Add other student-specific routes here
});

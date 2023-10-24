<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TeacherController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('Auth.login');
});

Route::get('admin-login', function () {
    return view('Auth.login-admin');
});

Route::get('register-usr', function () {
    return view('Auth.register');
});

Route::post('regusr', [AuthenticationController::class,'store'])->name('regusr');
Route::post('loginuser', [AuthenticationController::class,'login'])->name('loginuser');
Route::post('loginadmin', [AuthenticationController::class,'loginadmin'])->name('loginadmin');
Route::get('signout',[AuthenticationController::class,'signout'])->name('signout');
Route::get('forgotpass',[AuthenticationController::class,'forgotpass'])->name('forgotpass');
Route::post('respass',[AuthenticationController::class,'respass'])->name('respass');
Route::get('resetpassword/{token}',[AuthenticationController::class,'resetpassword'])->name('resetpassword');
Route::post('updatepassword',[AuthenticationController::class,'updatepassword'])->name('updatepassword');


//Admin Controller
Route::get('admindashboard',[AdminController::class,'index'])->name('admindashboard');
Route::get('studentlist',[AdminController::class,'students'])->name('studentlist');
Route::post('addstudent',[AdminController::class,'addstudent'])->name('addstudent');
Route::get('fetchstudent',[AdminController::class,'fetchstudent'])->name('fetchstudent');
Route::any('deletestudent/{id}',[AdminController::class,'deletestudent'])->name('deletestudent');
Route::get('classlist',[AdminController::class,'classes'])->name('classlist');
Route::post('addclass',[AdminController::class,'addclass'])->name('addclass');
Route::any('deleteclass/{id}',[AdminController::class,'deleteclass'])->name('deleteclass');


//Teacher Controller
Route::get('teacherdashboard',[TeacherController::class,'index'])->name('teacherdashboard');
Route::get('teacherstudentlist',[TeacherController::class,'students'])->name('teacherstudentlist');
Route::get('generatereports',[TeacherController::class,'generatereports'])->name('generatereports');
Route::post('printAttendanceReport',[TeacherController::class,'printAttendanceReport'])->name('printAttendanceReport');
Route::get('printWarningLetter',[TeacherController::class,'printWarningLetter'])->name('printWarningLetter');










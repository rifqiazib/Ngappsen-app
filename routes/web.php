<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AttedanceController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\OfficeLocationController;
use App\Http\Controllers\WorkingHourController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login',[LoginController::class, 'doLogin'])->name('doLogin');
Route::get('logout',[LoginController::class, 'logout'])->name('logout');

Route::get('dashboard',[DashboardController::class, 'index'])->name('dashboard');

Route::get('attedance',[AttedanceController::class, 'index'])->name('attedance');
Route::get('attedance/create',[AttedanceController::class, 'create'])->name('attedance.create');
Route::post('attedance/store',[AttedanceController::class, 'store'])->name('attedance.store');

Route::get('history',[HistoryController::class, 'index'])->name('history');

Route::get('leave', [LeaveController::class, 'index'])->name('leave');
Route::get('leave/create',[LeaveController::class, 'create'])->name('leave.create');
Route::post('leave/store', [LeaveController::class, 'store'])->name('leave.store');
Route::put('leave/approval/{id}',[LeaveController::class, 'approval'])->name('leave.approval');

Route::get('department',[DepartmentController::class, 'index'])->name('department');
Route::post('department/store',[DepartmentController::class, 'store'])->name('department.store');
Route::put('department/update',[DepartmentController::class, 'update'])->name('department.update');
Route::delete('department/delete/{id}',[DepartmentController::class, 'delete'])->name('department.delete');

Route::get('staff',[StaffController::class, 'index'])->name('staff');
Route::get('staff/create',[StaffController::class, 'create'])->name('staff.create');
Route::post('staff/store',[StaffController::class, 'store'])->name('staff.store');
Route::get('staff/edit/{id}',[StaffController::class, 'edit'])->name('staff.edit');
Route::put('staff/update/{id}',[StaffController::class, 'update'])->name('staff.update');
Route::delete('staff/delete/{id}',[StaffController::class, 'delete'])->name('staff.delete');

Route::get('office-location',[OfficeLocationController::Class, 'index'])->name('office');
Route::post('office-location/store',[OfficeLocationController::class, 'store'])->name('office.store');
Route::get('office-location/edit/{id}',[OfficeLocationController::class, 'edit'])->name('office.edit');
Route::put('office-location/update/{id}',[OfficeLocationController::class, 'update'])->name('office.update');
Route::delete('office-location/delete/{id}',[OfficeLocationController::class, 'delete'])->name('office.delete');

Route::get('working-hour',[WorkingHourController::class, 'index'])->name('workingHour');
Route::get('working-hour/create',[WorkingHourController::class, 'create'])->name('workingHour.create');
Route::post('working-hour/store',[WorkingHourController::class, 'store'])->name('workingHour.store');
Route::get('working-hour/edit/{id}',[WorkingHourController::class, 'edit'])->name('workingHour.edit');
Route::put('working-hour/update/{id}',[WorkingHourController::class, 'update'])->name('workingHour.update');
Route::delete('working-hour/delete/{id}',[WorkingHourController::class, 'delete'])->name('workingHour.delete');

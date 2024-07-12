<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AttedanceController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\StaffController;

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
Route::post('leave/create', [LeaveController::class, 'store'])->name('leave.store');

Route::get('department',[DepartmentController::class, 'index'])->name('department');
Route::post('department/store',[DepartmentController::class, 'store'])->name('department.store');
Route::put('department/update',[DepartmentController::class, 'update'])->name('department.update');
Route::delete('department/delete/{id}',[DepartmentController::class, 'delete'])->name('department.delete');

Route::get('staff',[StaffController::class, 'index'])->name('staff');
Route::post('staff/store',[StaffController::class, 'store'])->name('staff.store');
Route::put('staff/update',[StaffController::class, 'update'])->name('staff.update');
Route::delete('staff/delete/{id}',[StaffController::class, 'delete'])->name('staff.delete');


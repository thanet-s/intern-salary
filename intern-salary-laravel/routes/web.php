<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InternController;
use App\Http\Controllers\DepartmentController;
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
Route::get('/login', [UserController::class, 'form'])->name('login');
Route::post('/login', [UserController::class, 'auth']);

// login middleware
Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [UserController::class, 'logout']);
    Route::get('/user', [UserController::class, 'resetPass']);
    Route::post('/user', [UserController::class, 'resetPass']);
    Route::get('/admins', [UserController::class, 'admins'])->name('admins');
    Route::post('/admins', [UserController::class, 'removeAdmin']);
    Route::get('/add-admin', [UserController::class, 'addAdmin']);
    Route::post('/add-admin', [UserController::class, 'addAdmin']);
    Route::get('/add-student', [InternController::class, 'form']);
    Route::post('/add-student', [InternController::class, 'add']);
    Route::post('/edit-student', [InternController::class, 'edit']);
    Route::post('/leave-student', [InternController::class, 'leave']);
    Route::get('/department', [DepartmentController::class, 'departmentList']);
    Route::post('/remove-department', [DepartmentController::class, 'removeDepartment']);
    Route::post('/add-department', [DepartmentController::class, 'addDepartment']);
    Route::post('/edit-department', [DepartmentController::class, 'editDepartment']);
    Route::get('/dashboard', [InternController::class, 'dashboard'])->name('dashboard');
    Route::post('/remove-interner', [InternController::class, 'remove']);
    Route::get('/admin/interner/{id}', [InternController::class, 'detail']);
    Route::post('/remove-work-record', [InternController::class, 'removeWork']);
    Route::get('/import-data', [InternController::class, 'import']);
});
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;

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
Route::get('/login', function () {
    return view('login');
})->name('login');
Route::post('/login', [UserController::class, 'auth']);

// login middleware
Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [UserController::class, 'logout']);
    Route::get('/user', [UserController::class, 'resetPass']);
    Route::post('/user', [UserController::class, 'resetPass']);
    Route::get('/admins', [UserController::class, 'admins']);
    Route::post('/admins', [UserController::class, 'admins']);
    Route::get('/add-admin', [UserController::class, 'addAdmin']);
    Route::post('/add-admin', [UserController::class, 'addAdmin']);
    Route::get('/', [HomeController::class, 'dashboard']);
});
<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
// use App\Models\Category;
// use App\Models\Post;
// use App\Models\User;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TaskController;

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

// auto redirect page
Route::get('/', function () {
    return redirect('/login');
});


// Login & register route
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

// Dasboard route
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

// Task data 
Route::resource('/dashboard/tasks', TaskController::class)->middleware('auth');
Route::post('/dashboard/tasks', [TaskController::class, 'store'])->middleware('admin');
Route::put('/dashboard/tasks', [TaskController::class, 'update'])->middleware('auth');
Route::delete('/dashboard/tasks/{task:id}/delete', [TaskController::class, 'destroy'])->middleware('admin');

// District data 
Route::resource('/dashboard/districts', DistrictController::class)->middleware('admin');
Route::post('/dashboard/districts', [DistrictController::class, 'store'])->middleware('admin');
Route::put('/dashboard/districts', [DistrictController::class, 'update'])->middleware('auth');
Route::delete('/dashboard/districts/{district:id}/delete', [DistrictController::class, 'destroy'])->middleware('admin');

// User data 
Route::resource('/dashboard/users', UserController::class)->middleware('admin');
Route::post('/dashboard/users', [UserController::class, 'store'])->middleware('admin');
Route::put('/dashboard/users', [UserController::class, 'update'])->middleware('auth');
Route::delete('/dashboard/users/{users:id}/delete', [UserController::class, 'destroy'])->middleware('admin');

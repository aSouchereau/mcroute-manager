<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\SyncRouterController;
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

Route::get('/', [LoginController::class, 'getLoginForm'])->name('index');

Route::get('login', [LoginController::class, 'getLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login.post');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class, 'getRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register'])->name('register.post');


Route::group(['as' => 'groups.', 'prefix' => 'groups', 'middleware' => ['auth']], function () {
   Route::post('', [GroupController::class, 'store'])->name('store');
   Route::patch('{group}', [GroupController::class, 'update'])->name('update');
   Route::delete('{group}', [GroupController::class, 'destroy'])->name('delete');
   Route::get('', [GroupController::class, 'index'])->name('index');
});

Route::group(['as' => 'routes.', 'prefix' => 'routes', 'middleware' => ['auth']], function () {
    Route::patch('{route}/status', [RouteController::class, 'toggle'])->name('toggle');
    Route::post('', [RouteController::class, 'store'])->name('store');
    Route::patch('{route}', [RouteController::class, 'update'])->name('update');
    Route::delete('{route}', [RouteController::class, 'destroy'])->name('delete');
    Route::get('', [RouteController::class, 'index'])->name('index');
});

Route::post('jobs/sync', [SyncRouterController::class, 'sync'])->name('jobs.sync');

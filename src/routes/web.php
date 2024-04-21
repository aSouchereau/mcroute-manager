<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Demo\DemoController;
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
Route::group(['as' => 'demo.', 'prefix' => 'demo'], function () {
   Route::get('welcome', [DemoController::class, 'welcome'])->name('welcome');
   Route::get('setup', [DemoController::class, 'setup'])->name('setup');
   Route::get('login', [DemoController::class, 'login'])->name('login');
});

Route::group(['middleware' => ['install:complete', 'demoRedirect']], function () {
    Route::get('login', [LoginController::class, 'getLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('login.post');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::group(['middleware' => ['auth', 'is.admin']], function () {
        Route::get('/', [RouteController::class, 'index'])->name('index');

        Route::group(['as' => 'groups.', 'prefix' => 'groups', 'middleware' => ['auth', 'is.admin']], function () {
            Route::post('', [GroupController::class, 'store'])->name('store');
            Route::patch('{group}', [GroupController::class, 'update'])->name('update');
            Route::delete('{group}', [GroupController::class, 'destroy'])->name('delete');
            Route::get('', [GroupController::class, 'index'])->name('index');
        });

        Route::group(['as' => 'routes.', 'prefix' => 'routes', 'middleware' => ['auth', 'is.admin']], function () {
            Route::patch('{route}/status', [RouteController::class, 'toggle'])->name('toggle');
            Route::post('', [RouteController::class, 'store'])->name('store');
            Route::patch('{route}', [RouteController::class, 'update'])->name('update');
            Route::delete('{route}', [RouteController::class, 'destroy'])->name('delete');
            Route::get('', [RouteController::class, 'index'])->name('index');
        });

        Route::group(['as' => 'jobs.', 'prefix' => 'jobs', 'middleware' => ['auth', 'is.admin']], function () {
            Route::post('sync', [SyncRouterController::class, 'sync'])->name('sync');
        });
    });


});

<?php

use App\Http\Controllers\GroupController;
use App\Http\Controllers\HomeController;
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

Route::get('/', [RouteController::class, 'index'])->name('index');

Route::group(['as' => 'groups.', 'prefix' => 'groups'], function () {
   Route::get('create', [GroupController::class, 'create'])->name('create');
   Route::post('', [GroupController::class, 'store'])->name('store');
   Route::get('{group}/edit', [GroupController::class, 'edit'])->name('edit');
   Route::patch('{group}', [GroupController::class, 'update'])->name('update');
   Route::delete('{group}', [GroupController::class, 'destroy'])->name('delete');
   Route::get('', [GroupController::class, 'index'])->name('index');
});

Route::group(['as' => 'routes.', 'prefix' => 'routes'], function () {
    Route::patch('{route}/status', [RouteController::class, 'toggle'])->name('toggle');
    Route::get('create', [RouteController::class, 'create'])->name('create');
    Route::post('', [RouteController::class, 'store'])->name('store');
    // Temporary edit route
    Route::get('{route}/edit', [RouteController::class, 'edit'])->name('edit');
    Route::patch('{route}', [RouteController::class, 'update'])->name('update');
    Route::delete('{route}', [RouteController::class, 'destroy'])->name('delete');
    Route::get('', [RouteController::class, 'index'])->name('index');
});

Route::post('jobs/sync', [SyncRouterController::class])->name('jobs.sync');

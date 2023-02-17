<?php

use App\Http\Controllers\GroupController;
use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::group(['as' => 'groups.', 'prefix' => 'groups'], function () {
   Route::get('create', [GroupController::class, 'create'])->name('groups.create');
   Route::post('', [GroupController::class, 'store'])->name('groups.store');
   Route::get('{group}/edit', [GroupController::class, 'edit'])->name('groups.edit');
   Route::patch('{group}', [GroupController::class, 'update'])->name('groups.update');
   Route::get('', [GroupController::class, 'index'])->name('groups.index');
});

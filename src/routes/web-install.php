<?php


use App\Http\Controllers\Installer\InstallerController;
use App\Http\Controllers\Installer\MigrateController;
use App\Http\Controllers\Installer\RouterConnectionController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'install.', 'prefix' => 'install'], function () {
    Route::get('/', [InstallerController::class, 'welcome'])->name('welcome');
    Route::get('router', [RouterConnectionController::class, 'view'])->name('router');
    Route::get('migrate', [MigrateController::class, 'view'])->name('migrate');
});

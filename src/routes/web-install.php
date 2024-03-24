<?php


use App\Http\Controllers\Installer\InstallerController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'install.', 'prefix' => 'install'], function () {
    Route::get('/', [InstallerController::class, 'welcome'])->name('welcome');
});

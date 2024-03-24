<?php

namespace App\Http\Controllers\Installer;



use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class InstallerController extends Controller
{
    public function welcome(): Factory|View|Application
    {
        return view('installer.welcome');
    }
    public function success()
    {

    }

}

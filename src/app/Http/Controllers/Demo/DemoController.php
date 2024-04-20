<?php

namespace App\Http\Controllers\Demo;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DemoController extends Controller
{
    public function welcome(): Factory|View|Application
    {
        return view('demo.welcome');
    }

    public function setup()
    {

    }

    public function login()
    {

    }
}

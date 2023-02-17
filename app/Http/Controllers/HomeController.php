<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index() : View {
        $groups = Group::all();
        return view('home.index', compact('groups'));
    }
}

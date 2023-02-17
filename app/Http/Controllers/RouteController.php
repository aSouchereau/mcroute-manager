<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Route;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $routes = Route::all();
        return view('routes.index', compact('routes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $groups = Group::all();
        return view('routes.create', compact('groups'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $group = Group::findOrFail($request->group_id);
        $route = new Route($request->all());
        $group->routes()->save($route);

        return redirect('routes');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Route $route): RedirectResponse
    {
        $route = Route::findOrFail($route);
        $route->delete();

        return redirect('routes');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Route;
use App\Traits\RouteTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class RouteController extends Controller
{
    use RouteTrait;

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
        $this->addRoute($route); // Makes api call to router to activate new route

        return redirect('routes');
    }

    /**
     * Update the specified resource in storage.
     * @throws Exception
     */
    public function update(Request $request, Route $route): RedirectResponse
    {
        $formData = $request->all();
        $route->update($formData);

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

    /*
     * Temporary edit method
     */
    public function edit($route) {
        $route = Route::findOrfail($route);

        return view('routes.edit', compact('route'));
    }
}

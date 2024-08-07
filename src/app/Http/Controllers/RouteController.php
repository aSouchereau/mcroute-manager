<?php

namespace App\Http\Controllers;

use App\Actions\Routes\Toggle;
use App\Http\Requests\RouteRequest;
use App\Models\Group;
use App\Models\Route;
use App\Traits\RouteTrait;
use Illuminate\Http\Client\HttpClientException;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RouteController extends Controller
{
    use RouteTrait;

    private Toggle $toggleRoute;

    function __construct(Toggle $toggleRoute)
    {
        $this->toggleRoute = $toggleRoute;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $routes = Route::all();
        return view('routes.index', compact('routes'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(RouteRequest $request): RedirectResponse
    {
        $route = new Route($request->all());

        // Makes api call to router to activate new route
        try {
            $this->addRoute($route->domain_name, $route->host);
        } catch (HttpClientException $e) {
            notyf()->addError('Router API: Failed to add new route - ' . $e->getMessage());
            return redirect('routes');
        }

        if ($request->group_id) {
            $group = Group::findOrFail($request->group_id);
            $group->routes()->save($route);
        } else {
            $route->save();
        }

        return redirect('routes');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RouteRequest $request, Route $route): RedirectResponse
    {
        $formData = $request->all();
        try {
            $this->replaceRoute($route->domain_name, $request->host);
        } catch (HttpClientException $e) {
            notyf()->addError('Router API: Failed to update route - ' . $e->getMessage());
            return redirect('routes');
        }
        $route->update($formData);

        return redirect('routes');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Route $route): RedirectResponse
    {
        $route = Route::findOrFail($route->id);
        try {
            $this->deleteRoute($route->domain_name);
        } catch (HttpClientException $e) {
            notyf()->addError('Router API: Failed to delete route - ' . $e->getMessage());
            return redirect('routes');
        }
        $route->delete();

        return redirect('routes');
    }

    public function toggle(Route $route) : RedirectResponse
    {
        $route = Route::findOrFail($route->id);

        $this->toggleRoute->toggle($route);

        return redirect('routes');
    }

}

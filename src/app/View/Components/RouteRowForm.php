<?php

namespace App\View\Components;

use App\Models\Group;
use App\Models\Route;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RouteRowForm extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $routeData
    )
    {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $route = $this->routeData;
        $groups = Group::all();
        return view('components.route-row-form', compact('route', 'groups'));
    }
}

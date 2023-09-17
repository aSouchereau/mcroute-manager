<?php

namespace App\View\Components;

use App\Models\Group;
use App\Models\Route;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ToggleSwitch extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Route | Group $resource,
        public string $routeName
    )
    {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $resource = $this->resource;
        $routeName = $this->routeName;
        return view('components.toggle-switch', compact('resource', 'routeName'));
    }
}

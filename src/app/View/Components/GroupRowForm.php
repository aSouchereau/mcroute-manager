<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class GroupRowForm extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $groupData
    )
    {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $group = $this->groupData;
        return view('components.group-row-form', compact('group'));
    }
}

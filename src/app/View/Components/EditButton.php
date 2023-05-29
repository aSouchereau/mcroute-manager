<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EditButton extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $tooltipName
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $name = $this->tooltipName;
        return view('components.edit-button', compact('name'));
    }
}

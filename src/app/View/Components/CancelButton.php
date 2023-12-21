<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CancelButton extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public int | string $fieldId
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $fieldId = $this->fieldId;
        return view('components.cancel-button', compact('fieldId'));
    }
}

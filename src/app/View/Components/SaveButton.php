<?php

namespace App\View\Components;

use App\Models\Group;
use App\Models\Route;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SaveButton extends Component
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

        return view('components.save-button', compact( 'fieldId'));
    }
}

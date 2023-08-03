<?php

namespace App\View\Components;

use App\Models\Group;
use App\Models\Route;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DeleteButton extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $tooltipName,
        public int $fieldId,
        public Route | Group $resource
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {

        $name = $this->tooltipName;
        $fieldId = $this->fieldId;
        $resource = $this->resource;
        $formRoute = $this->resource->getTable() . ".delete";

        return view('components.delete-button', compact('name', 'fieldId', 'resource', 'formRoute'));
    }
}

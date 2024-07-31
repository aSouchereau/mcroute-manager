<?php

namespace App\Actions\Routes;

use App\Models\Route;
use App\Traits\RouteTrait;
use Illuminate\Http\Client\HttpClientException;

class Toggle
{
    use RouteTrait;
    public function toggle(Route $route) {
        try {
            $this->toggleRoute($route);
        } catch (HttpClientException $e) {
            notyf()->addError('Router API: Failed to toggle route status - ' . $e->getMessage());
            return redirect('routes');
        }

        $route->enabled = !$route->enabled;
        $route->save();
    }
}

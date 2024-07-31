<?php

namespace App\Actions\Routes;

use App\Models\Route;
use App\Traits\RouteTrait;
use Illuminate\Http\Client\HttpClientException;

class Toggle
{
    use RouteTrait;
    public function toggle(Route $route): void {
        try {
            $this->toggleRoute($route);
        } catch (HttpClientException $e) {
            notyf()->addError('Router API: Failed to toggle route status - ' . $e->getMessage());
        }

        $route->enabled = !$route->enabled;
        $route->save();
    }

    public function setEnabled(Route $route): void {
        $this->addRoute($route->domain_name, $route->host);

        $route->enabled = true;
        $route->save();
    }

    public function setDisabled(Route $route): void {
        $this->deleteRoute($route->domain_name);

        $route->enabled = false;
        $route->save();
    }
}

<?php

namespace App\Http\Middleware\Checks;


class IsDemoMode
{
    /**
     * Assert the application is in demo mode.
     *
     * @return bool
     */
    public function assert(): bool
    {
        return config('app.demo');
    }
}

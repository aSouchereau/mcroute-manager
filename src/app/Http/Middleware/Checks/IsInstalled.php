<?php

namespace App\Http\Middleware\Checks;

use App\Models\User;
use Illuminate\Database\QueryException;

class IsInstalled
{
    /**
     * Assert the application is installed.
     *
     * @return bool
     */
    public function assert(): bool
    {
        try {
            $user = User::where('role', '=', 'admin')->first();
            return
                config('app.key') !== null &&
                config('app.key') !== '' &&
                isset($user);
        } catch (QueryException) {
            return false;   // Exception is expected if not installed, so we won't bother with logging, just return false
        }
    }
}

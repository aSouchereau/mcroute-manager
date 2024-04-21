<?php

namespace App\Http\Middleware;

use App\Http\Middleware\Checks\IsDemoMode;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class UseDemoDb
{
    private IsDemoMode $isDemoMode;
    private string $DB_CONNECTION = 'demo';

    function __construct(IsDemoMode $isDemoMode)
    {
        $this->isDemoMode = $isDemoMode;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($this->isDemoMode->assert()) {
            DB::setDefaultConnection($this->DB_CONNECTION);
        }
        return $next($request);
    }
}

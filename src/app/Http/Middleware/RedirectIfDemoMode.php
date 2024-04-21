<?php

namespace App\Http\Middleware;

use App\Http\Middleware\Checks\IsDemoMode;
use App\Http\Middleware\Checks\IsInstalled;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfDemoMode
{
    private IsDemoMode $isDemoMode;
    private IsInstalled $isInstalled;

    function __construct(IsDemoMode $isDemoMode, IsInstalled $isInstalled)
    {
        $this->isDemoMode = $isDemoMode;
        $this->isInstalled = $isInstalled;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($this->isDemoMode->assert() && !$this->isInstalled->assert()) {
            return redirect('/demo/welcome');
        }

        return $next($request);
    }
}

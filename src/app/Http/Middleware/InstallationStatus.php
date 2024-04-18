<?php

namespace App\Http\Middleware;

use App\Http\Middleware\Checks\IsInstalled;
use Illuminate\Http\Request;

/**
 * Class InstallationStatus.
 *
 * This middleware ensures that the installation has the required status.
 * If the installation has the required status, then the request passes
 * unchanged.
 * If the required status equals `:complete` but the installation is
 * incomplete, then the client is redirected to the installation pages.
 * If the required status equals `:incomplete` but the installation is
 * complete, then the client is redirected to the home page.
 * The latter mode is supposed to be used as a gatekeeper to the installation
 * pages and to prevent access if no installation is required.
 */
class InstallationStatus
{

    private IsInstalled $isInstalled;

    public function __construct(IsInstalled $isInstalled)
    {
        $this->isInstalled = $isInstalled;
    }

    /**
     * Handles an incoming request.
     *
     * @param Request $request the incoming request to serve
     * @param \Closure $next the next operation to be applied to the request
     *
     * @return mixed
     */
    public function handle(Request $request, \Closure $next, string $requiredStatus): mixed
    {
        if ($requiredStatus === 'complete') {
            if ($this->isInstalled->assert()) {
                return $next($request);
            } else {
                return redirect('/install');
            }
        } elseif ($requiredStatus === 'incomplete') {
            if ($this->isInstalled->assert()) {
                return redirect('/login');
            } else {
                return $next($request);
            }
        } else {
            throw new \InvalidArgumentException('$requiredStatus must either be "complete" or "incomplete"');
        }

    }
}

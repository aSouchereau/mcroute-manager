<?php

namespace App\Http\Middleware;

use App\Http\Middleware\Checks\IsDemoMode;
use App\Http\Middleware\Checks\IsInstalled;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

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
 *
 * The redirect locations depend on whether the app is in demo mode or not
 */
class InstallationStatus
{

    private IsInstalled $isInstalled;
    private IsDemoMode $isDemoMode;
    private Application|RedirectResponse|Redirector $installRedirect;
    private Application|RedirectResponse|Redirector $loginRedirect;

    public function __construct(IsInstalled $isInstalled, IsDemoMode $isDemoMode)
    {
        $this->isInstalled = $isInstalled;
        $this->isDemoMode = $isDemoMode;

        $this->installRedirect = $this->isDemoMode->assert() ? redirect('/demo/welcome') : redirect('/install');
        $this->loginRedirect = $this->isDemoMode->assert() ? redirect('/demo/welcome') : redirect('login');

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
                return $this->installRedirect;
            }
        } elseif ($requiredStatus === 'incomplete') {
            if ($this->isInstalled->assert()) {
                return $this->loginRedirect;
            } else {
                return $next($request);
            }
        } else {
            throw new \InvalidArgumentException('$requiredStatus must either be "complete" or "incomplete"');
        }

    }
}

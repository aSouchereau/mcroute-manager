<?php

namespace App\Http\Controllers\Demo;

use App\Actions\Demo\CreateDemoDatabase;
use App\Actions\Demo\SeedDatabase;
use App\Actions\Installer\Migrator;
use App\Actions\Installer\RegisterAdmin;
use App\Http\Controllers\Controller;
use App\Http\Middleware\Checks\IsInstalled;
use App\Jobs\DemoModeSetup;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DemoController extends Controller
{
    private IsInstalled $isInstalled;
    function __construct(IsInstalled $isInstalled)
    {
        $this->isInstalled = $isInstalled;
    }

    public function welcome(): Factory|View|Application|RedirectResponse
    {
        if (Auth::check()) {
            return redirect('routes');
        }

        return view('demo.welcome', [
            'isInstalled' => $this->isInstalled->assert(),
        ]);
    }

    public function setup(): Factory|View|Application
    {
        DemoModeSetup::dispatchSync();

        return view('demo.setup');
    }

    public function login(): Factory|View|Application|RedirectResponse
    {
        if (Auth::check()) {
            return redirect('routes');
        }

        return view('demo.login', [
            'demoUsername' => 'DemoAdmin',
            'demoPassword' => '!DEMOUSER111',
        ]);
    }
}

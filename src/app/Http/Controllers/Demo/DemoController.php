<?php

namespace App\Http\Controllers\Demo;

use App\Actions\Demo\ChangeDatabaseConnection;
use App\Actions\Demo\CreateDemoDatabase;
use App\Actions\Demo\SeedDatabase;
use App\Actions\Installer\Migrator;
use App\Actions\Installer\RegisterAdmin;
use App\Http\Controllers\Controller;
use App\Http\Middleware\Checks\IsInstalled;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DemoController extends Controller
{
    private CreateDemoDatabase $createDemoDatabase;
    private Migrator $migrator;
    private RegisterAdmin $registerAdmin;
    private SeedDatabase $seedDatabase;
    private IsInstalled $isInstalled;
    function __construct(
        CreateDemoDatabase $createDemoDatabase,
        Migrator $migrator,
        RegisterAdmin $registerAdmin,
        SeedDatabase $seedDatabase,
        IsInstalled $isInstalled)
    {
        $this->createDemoDatabase = $createDemoDatabase;
        $this->migrator = $migrator;
        $this->registerAdmin = $registerAdmin;
        $this->seedDatabase = $seedDatabase;
        $this->isInstalled = $isInstalled;
    }

    public function welcome(): Factory|View|Application
    {
        return view('demo.welcome', [
            'isInstalled' => $this->isInstalled,
        ]);
    }

    public function setup(): Factory|View|Application
    {
        $errors = [];
        $this->createDemoDatabase->create();
        $this->migrator->migrate();
        $this->seedDatabase->seed();
        $this->registerAdmin->create(
            'Demo User',
            'demo@example.com',
            '!DEMOUSER111'
        );

        return view('demo.setup', [
            'errors' => $errors,
        ]);
    }

    public function login()
    {

    }
}

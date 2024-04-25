<?php

namespace App\Http\Controllers\Installer;



use App\Actions\Installer\Migrator;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class MigrateController extends Controller
{
    private Migrator $migrator;

    /**
     * @param Migrator $migrator
     */
    function __construct(Migrator $migrator)
    {
        $this->migrator = $migrator;
    }

    /**
     * Return view after running migrations
     * @return Factory|View|Application
     */
    public function view(): Factory|View|Application
    {
        $migration = $this->migrator->migrate();
        return view('installer.migrate', [
            'errors' => $migration['errors'] ?? null,
        ]);
    }

}

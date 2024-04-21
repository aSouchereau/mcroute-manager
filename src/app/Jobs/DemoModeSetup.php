<?php

namespace App\Jobs;

use App\Actions\Demo\CreateDemoDatabase;
use App\Actions\Demo\SeedDatabase;
use App\Actions\Installer\Migrator;
use App\Actions\Installer\RegisterAdmin;
use App\Http\Middleware\Checks\IsInstalled;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DemoModeSetup implements ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(
        CreateDemoDatabase $createDemoDatabase,
        Migrator $migrator,
        SeedDatabase $seedDatabase,
        RegisterAdmin $registerAdmin): void
    {
        $createDemoDatabase->create();
        $migrator->migrate();
        $seedDatabase->seed();
        $registerAdmin->create(
            'Demo User',
            'demo@example.com',
            '!DEMOUSER111'
        );
    }
}

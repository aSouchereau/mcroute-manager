<?php

namespace App\Actions\Demo;

use App\Jobs\SyncDbRouter;
use Illuminate\Support\Facades\Artisan;

/**
 *
 */
class SeedDatabase
{
    protected array $results = [];
    private string $CLASS_NAME = 'DemoSeeder';
    private string $DATABASE = 'demo';

    function __construct()
    {
        $this->results['errors'] = null;
        $this->results['exception'] = null;
    }
    public function seed(): void
    {
        try {
            Artisan::call('db:seed', [
                '--class' => $this->CLASS_NAME,
                '--database' => $this->DATABASE,
                '--force' => true
            ]);
            SyncDbRouter::dispatchSync();
        } catch (\Exception $e) {
            $this->results['exception'] = $e;
            $this->results['errors'] = "Seeding Failed";
        }
    }
}

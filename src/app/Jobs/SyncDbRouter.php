<?php

namespace App\Jobs;

use App\Models\Route;
use App\Traits\RouteTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SyncDbRouter implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, RouteTrait;

    protected array $dbRoutes; // List of enabled routes from db
    protected mixed $routerRoutes; // Routes returned from API get request

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        $this->dbRoutes = Route::where('enabled', true)->get()->toArray();
        $domains = array_column($this->dbRoutes, 'domain_name');
        $this->dbRoutes = array_combine($domains, $this->dbRoutes);

        $this->routerRoutes = $this->getActiveRoutes()->json();
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::notice('Syncing router with database');
        $count = $this->syncRouter();
        Log::notice('Syncing Complete');
        Log::info('Corrected ' . $count . ' out-of-sync items');
    }

    /**
     * Performs a sync that modifies router to match database
     * @param bool|null $discard (true = discard excess routerRoutes), (false = add missing dbRoutes), (null = both)
     * @return int number of out-of-sync routes that were corrected
     */
    public function syncRouter(?bool $discard = null): int
    {
        $correctionCount = 0;
        if ($discard || $discard === null) {
            foreach ($this->routerRoutes as $key => $route) {
                if (!array_key_exists($key, $this->dbRoutes)) {
                    $this->deleteRoute($key);
                    $correctionCount++;
                }
            }
        }
        if ($discard === false || $discard === null) {
            foreach ($this->dbRoutes as $key => $route) {
                if (!array_key_exists($key, $this->routerRoutes)) {
                    $this->addRoute($route->domain_name, $route->host);
                    $correctionCount++;
                }
            }
        }
        return $correctionCount;
    }
}

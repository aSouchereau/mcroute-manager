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
        $removedCount = $this->removeStaleRoutes();
        $addedCount = $this->addMissingRoutes();
        Log::notice('Syncing Complete');
        Log::info('Corrected ' . $removedCount + $addedCount. ' out-of-sync items');
    }

    /**
     * Removes routes from the router if they do not exist in the database
     * @return int number of stale routes that were corrected
     */
    public function removeStaleRoutes(): int
    {
        $correctionCount = 0;
        foreach ($this->routerRoutes as $key => $route) {
            if (!array_key_exists($key, $this->dbRoutes)) {
                $this->deleteRoute($key);
                $correctionCount++;
            }
        }
        return $correctionCount;
    }

    /**
     * Adds routes from the database if they are missing from the router
     * @return int number of stale routes that were corrected
     */
    public function addMissingRoutes(): int {
        $correctionCount = 0;
        foreach ($this->dbRoutes as $key => $route) {
            if (!array_key_exists($key, $this->routerRoutes)) {
                $this->addRoute($key, $route['domain_name']);
                $correctionCount++;
            }
        }
        return $correctionCount;
    }
}

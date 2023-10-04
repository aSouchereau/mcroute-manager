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

class ResetRouter implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, RouteTrait;

    private bool $repopulate; // Whether reset job should repopulate router with enabled database entries
    protected array $dbRoutes; // List of enabled routes from db
    protected mixed $routerRoutes; // Routes returned from API get request

    /**
     * Create a new job instance.
     */
    public function __construct(bool $repopulate)
    {
        $this->repopulate = $repopulate;

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
        $this->resetRouter();
    }

    public function resetRouter() : void {
        foreach ($this->routerRoutes as $domain => $host) {
            $this->deleteRoute($domain);
        }
        if ($this->repopulate) {
            foreach ($this->dbRoutes as $domain => $host) {
                $this->addRoute($domain, $host);
            }
        }
    }
}

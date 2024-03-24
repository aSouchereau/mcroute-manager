<?php

namespace App\Actions\Installer;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Artisan;

class Migrator
{
    protected array $results = [];

    function __construct()
    {
        $this->results['errors'] = null;
        $this->results['exception'] = null;
    }
    public function migrate(): array
    {
        try {
            Artisan::call('migrate', ['--force' => true]);
        } catch (QueryException $e) {
            $this->results['exception'] = $e;
            $this->results['errors'] = "Migrations Failed";
        }

        return $this->results;
    }
}

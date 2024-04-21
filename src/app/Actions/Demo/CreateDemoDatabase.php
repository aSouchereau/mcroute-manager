<?php

namespace App\Actions\Demo;


/**
 *  Creates the demo database file.
 */
class CreateDemoDatabase
{
    private string $DEMO_DATABASE;
    private array $results = [];
    function __construct()
    {
        $this->DEMO_DATABASE = config('database.connections.demo.database');
        $this->results['errors'] = null;
        $this->results['exception'] = null;
    }

    public function create(): array {
        try {
            $file = fopen($this->DEMO_DATABASE, 'x+');
            fclose($file);
        } catch (\Exception $e) {
            $this->results['exception'] = $e;
            $this->results['errors'] = "Failed to create demo database";
        }

        return $this->results;
    }
}

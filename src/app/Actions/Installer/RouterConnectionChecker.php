<?php

namespace App\Actions\Installer;

use App\Traits\RouteTrait;
use Illuminate\Http\Client\HttpClientException;

class RouterConnectionChecker
{
    use RouteTrait;
    protected array $results = [];
    private string $testDomain = 'connection.checker.d';
    private string $testHost = '192.168.1.11';

    /**
     * Set the result array errors.
     */
    public function __construct()
    {
        $this->results['errors'] = null;
    }

    /**
     * Test the connection with the router.
     * @return array
     */
    public function check(): array
    {
        try {
            $this->addRoute($this->testDomain, $this->testHost);
            $response = $this->getActiveRoutes();
            if (!$response->json()[$this->testDomain] == $this->testHost) {
                $this->results['errors'] = 'Could not add test route';
            }
        } catch (HttpClientException $e) {
            $this->results['errors'] = $e;
        }

        return $this->results;
    }

}

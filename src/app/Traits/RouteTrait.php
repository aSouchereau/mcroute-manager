<?php

namespace App\Traits;

use App\Models\Route;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

trait RouteTrait {
    /**
     * Calls configured mc-router api to add a route.
     * @param $domainName
     * @param $host
     * @return PromiseInterface|Response
     */
    public function addRoute($domainName, $host): PromiseInterface|Response
    {
        return Http::retry(2, 100)->withHeaders([
            'Content-Type' => 'application/json'
        ])->post('http://' . config('app.mcrouter_host') . ':' . config('app.mcrouter_port') . '/routes', [
            'serverAddress' => $domainName,
            'backend' => $host
        ]);
    }

    /**
     * Calls configured mc-router api to add multiple routes
     * @param array $routes
     * @return void
     */
    public function addManyRoutes(array $routes): void
    {
        foreach ($routes as $route) {
            $this->addRoute($route->domain_name, $route->host);
        }
    }

    /**
     * Calls configured mc-router api to delete route by its domain name.
     * @param $domainName
     * @return PromiseInterface|Response
     */
    public function deleteRoute($domainName): PromiseInterface|Response
    {
       return Http::retry(2, 100)->delete('http://' . config('app.mcrouter_host') . ':' . config('app.mcrouter_port') . '/routes/' . $domainName);
    }


    /**
     * Makes different calls to mc-router api depending on its status in the db
     * @param Route $route
     * @return void
     */
    public function toggleRoute(Route $route): void
    {
        if ($route->enabled) {
            $this->deleteRoute($route->domain_name);
        } else {
            $this->addRoute($route->domain_name, $route->host);
        }
    }

    /**
     * Calls configured mc-router api to
     * @param $domainName
     * @param $newHost
     * @return void
     */
    public function replaceRoute($domainName, $newHost): void
    {
        $this->deleteRoute($domainName);
        $this->addRoute($domainName, $newHost);
    }

    /**
     * Calls configured mc-router api to set the routers default route
     * @param $destination
     * @return PromiseInterface|Response
     */
    public function setDefaultRoute($destination): PromiseInterface|Response
    {
        return Http::retry(2, 100)->post('http://' . config('app.mcrouter_host') . ':' . config('app.mcrouter_port') . '/defaultRoute', [
            'backend' => $destination
        ]);
    }

    /**
     * Calls configured mc-router api to get all routes mc-router is aware of
     * @return PromiseInterface|Response
     */
    public function getActiveRoutes(): PromiseInterface|Response
    {
        return Http::retry(2, 100)->acceptJson()->get('http://' . config('app.mcrouter_host') . ':' . config('app.mcrouter_port') . '/routes');
    }
}

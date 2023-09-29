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
    public function addRoute($domainName, $host) {
        return Http::retry(2, 100)->post('http://mcrouter:25564/routes', [
            'serverAddress' => $domainName,
            'backend' => $host
        ]);
    }

    /**
     * Calls configured mc-router api to add multiple routes
     * @param array $routes
     * @return void
     */
    public function addManyRoutes(array $routes) {
        foreach ($routes as $route) {
            $this->addRoute($route->domain_name, $route->host);
        }
    }

    /**
     * Calls configured mc-router api to delete route by its domain name.
     * @param Route $route
     * @return PromiseInterface|Response
     */
    public function deleteRoute(Route $route) {
       return Http::retry(2, 100)->delete('http://mcrouter:25564/routes/' . $route->domain_name);
    }


    /**
     * Makes different calls to mc-router api depending on its status in the db
     * @param Route $route
     * @return void
     */
    public function toggleRoute(Route $route) {
        if ($route->enabled) {
            $this->deleteRoute($route);
        } else {
            $this->addRoute($route->domain_name, $route->host);
        }
    }

    /**
     * Calls configured mc-router api to
     * @param Route $route
     * @return void
     */
    public function replaceRoute(Route $route, $formData) {
        $this->deleteRoute($route);
        $this->addRoute($formData->domain_name, $formData->host);
    }

    /**
     * Calls configured mc-router api to set the routers default route
     * @param $destination
     * @return PromiseInterface|Response
     */
    public function setDefaultRoute($destination) {
        return Http::retry(2, 100)->post('http://mcrouter:25564/defaultRoute', [
            'backend' => $destination
        ]);
    }

    /**
     * Calls configured mc-router api to get all routes mc-router is aware of
     * @return PromiseInterface|Response
     */
    public function getActiveRoutes() {
        return Http::retry(2, 100)->get('http://mcrouter:25564/routes');
    }
}

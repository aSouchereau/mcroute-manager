<?php

namespace App\Traits;

use App\Models\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

trait RouteTrait {
    /**
     * Calls configured mc-router api to add a route.
     * @param Route $route
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     */
    public function addRoute(Route $route) {
        return Http::retry(2, 100)->post('http://mcrouter:25564/routes', [
            'serverAddress' => $route->domain_name,
            'backend' => $route->host
        ]);
    }

    /**
     * Calls configured mc-router api to add multiple routes
     * @param array $routes
     * @return void
     */
    public function addManyRoutes(array $routes) {
        foreach ($routes as $route) {
            $this->addRoute($route);
        }
    }

    /**
     * Calls configured mc-router api to delete route by its domain name.
     * @param Route $route
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
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
            $this->addRoute($route);
        }
    }

    /**
     * Calls configured mc-router api to
     * @param Route $route
     * @return void
     */
    public function replaceRoute(Route $route) {
        $this->deleteRoute($route->domain_name);
        $this->addRoute($route);
    }

    /**
     * Calls configured mc-router api to set the routers default route
     * @param $destination
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     */
    public function setDefaultRoute($destination) {
        return Http::retry(2, 100)->post('http://mcrouter:25564/defaultRoute', [
            'backend' => $destination
        ]);
    }

    /**
     * Calls configured mc-router api to get all routes mc-router is aware of
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     */
    public function getActiveRoutes() {
        return Http::retry(2, 100)->get('http://mcrouter:25564/routes');
    }
}

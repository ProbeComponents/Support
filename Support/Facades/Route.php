<?php
namespace Probe\Support\Facades;

use Probe\Patterns\Facade;
use Probe\Routing\Router;
use Probe\Routing\Route as RouteObject;

/**
 * Facade to create new Routes and register them with the Router
 * @method static RouteObject endpoint(string $uri, \Closure $action)
 */
class Route extends Facade{
    protected static function getFacadeAccessor(): object{
        return Router::getInstance();
    }
}
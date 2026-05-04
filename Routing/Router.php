<?php
namespace Probe\Routing;

use Probe\Http\Request;
use Probe\Patterns\Singleton;
use Probe\Routing\Route;
use RuntimeException;

class Router extends Singleton{
    /**
     * @var Route[]
     */
    protected array $routes = [];

    public function __construct(){
        // Run default logic
        parent::__construct();
    }

    /**
     * Factory Method
     */
    public function endpoint(string $uri, \Closure $action): Route{
        $route = new Route()->endpoint($uri)->action($action);

        if (key_exists(key: $route->endpoint, array: $this->routes)){
            throw new RuntimeException("Duplicate routes detected for endpoint: {$route->endpoint}");
        }

        $this->routes[$route->endpoint][] = $route;
        $route->register();
        return $route;
    }

    /** 
     * Dispatcher Method
     */
    public function serveRoute(Request $request): void{
        /**
         * @var Route|null
         */
        $endpointIsRegistered = key_exists($request->uri(), $this->routes);
        if (!$endpointIsRegistered){
            http_response_code(404);
            echo "404 - Not found";
            exit;
        }
        
        $routeToServe = null;
        foreach($this->routes[$request->uri()] as $route){
            if($request->type === $route->method){
                $routeToServe = $route;
                break;
            }
        }

        $response = $routeToServe->execute();
        echo $response;
        return;
    }
}
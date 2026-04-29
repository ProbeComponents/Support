<?php
namespace Probe\Routing;

use Probe\Enums\HttpMethod;


class Route{
    /**
     * Flag that determines whether a route has been registered with the Applications Router
     * @var bool
     */
    protected bool $registered = false;
    public ?string $endpoint = null;
    public ?HttpMethod $method = HttpMethod::GET;
    public ?\Closure $action = null;
    public array $middleware = [];



    public function endpoint(string $uri): static{
        $this->endpoint = $uri;
        return $this;
    }
    public function method(string $httpMethod): static{
        $this->method = HttpMethod::tryFrom(strtoupper($httpMethod));
        return $this;
    }
    public function action(\Closure $action): static{
        $this->action = $action;
        return $this;
    }
    public function middleware(string $middleware): static{
        $this->middleware[] = $middleware;
        return $this;
    }


    public function execute(): mixed{
        if (is_callable($this->action)){
            return call_user_func($this->action);
        }
        // HANDLE CONTROLLERS BELOW!
        return null;
    }

    /**
     * Mark the route as registered
     * @return void
     */
    public function register(): void{
        $this->registered = true;
    }
}

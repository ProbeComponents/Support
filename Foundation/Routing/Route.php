<?php
namespace Probe\Foundation\Routing;

use Probe\Support\Enums\HttpMethod;


class Route{
    public ?string $endpoint = null;
    public ?HttpMethod $method = null;
    public ?\Closure $action = null;
    public array $middleware = [];


    /**
     * @method void endpoint()
     * @method void method()
     * @method void action()
     * @method void middleware()
     */
    public function __call($property, $args): void{
        $this->$property = $args[0];
    }

    /**
     * @method void endpoint()
     * @method void method()
     * @method void action()
     * @method void middleware()
     */
    public static function __callStatic($property, $args): void{
        
    }
}
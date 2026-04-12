<?php
namespace Probe\Foundation\Routing;

use Probe\Support\Enums\HttpMethod;

/**
 * @method void endpoint()
 * @method void method()
 * @method void action()
 * @method void middleware(string $middleware)
 * 
 * @method static void endpoint()
 * @method static void method()
 * @method static void action()
 * @method static void middleware(string $middleware)
 */
class Route{
    public ?string $endpoint = null;
    public ?HttpMethod $method = null;
    public ?\Closure $action = null;
    public array $middleware = [];

    public function __call($property, $args): void{
        $this->$property = $args[0];
    }


    public static function __callStatic($property, $args): void{
        
    }
}

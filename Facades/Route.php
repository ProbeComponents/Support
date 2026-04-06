<?php
namespace Probe\Support\Facades;

use Probe\Support\Contracts\Facade;

use Probe\Foundation\Routing\Route as RouteObj;

class Route extends Facade{
    protected static RouteObj $instance;

    public function __construct(){
        static::$instance = new RouteObj();
    }
    public function boot(): void{
        //
    }

    
}
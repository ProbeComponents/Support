<?php
namespace Probe\Support\Facades;

use Dotenv\Dotenv;
use Probe\Contracts\Facade;
use Probe\Support\Traits\Singleton;

class Env extends Facade{
    use Singleton;
    /**
     * @var \Dotenv\Dotenv
     */
    protected static ?object $instance = null;

    public function dotEnv(): Dotenv|null{
        return static::$instance;
    }
    

}
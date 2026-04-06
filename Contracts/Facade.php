<?php
namespace Probe\Support\Contracts;

use Probe\Support\Traits\Bootable;


abstract class Facade{
    /**
     * An instance of the service that is being abstracted by the facade, Examples of valid Service Providers: https://focalframework.com/docs/service-providers
     * @var object
     */
    protected static ?object $instance = null;

    /**
     * Initialise an `$instance` in here
     */
    abstract public function __construct();

    public static function instance(): object|null{
        return static::$instance;
    }

    public static function getInstance(): object|null{
        return self::instance();
    }
}
<?php
namespace Probe\Patterns;


abstract class Facade{

    protected static array $resolvedInstances = [];

    /**
     * An instance of the object that the facade should interact with or Abstract.
     */
    abstract protected static function getFacadeAccessor(): object;

    public static function getInstance(): object{
        $facadeClass = static::class;

        if (!isset(static::$resolvedInstances[$facadeClass])) {
            static::$resolvedInstances[$facadeClass] = static::getFacadeAccessor();
        }
        return static::$resolvedInstances[$facadeClass];
    }

    public static function __callStatic(string $method, array $args): mixed{
        $instance = static::getInstance();
        if (!$instance){
            throw new \RuntimeException("A Facade root has not been set.");
        }
        return $instance->$method(...$args);
    }
}
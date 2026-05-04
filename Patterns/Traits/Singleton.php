<?php
namespace Probe\Patterns\Traits;


trait Singleton{
    /**
     * @var array<string, object>
     */
    protected static array $instances = [];

    /**
     * `[NOT IMPLEMENTED]` Flag that determines whether to limit instance `overwriting` if its `true` then if `$instanceOfSelf` is `NOT` null, you cannot run `init()`
     * @var bool
     */
    protected static bool $limit = true;

    /**
     * Prevent direct instantisation
     */
    protected function __construct(){
        //
    }

    /**
     * Prevent cloning the instance.
     */
    protected function __clone(): void {}



    protected function storeInstance(): void{
        static::$instances[static::class] = $this;
    }

    /**
     * The magic method that creates the instance if it doesn't exist, or returns the cached one.
     */
    public static function getInstance(): object{
        $class = static::class;

        // If the array key doesn't exist, create the object!
        if (!isset(static::$instances[$class])) {
            static::$instances[$class] = new static();
        }

        return static::$instances[$class];
    }

    public static function instance(): static{
        return static::getInstance();
    }
}
<?php
namespace Probe\Support\Traits;

/**
 * Make sure to also implement the Singleton Contract!
 */
trait Singleton{
    protected static ?object $instanceOfSelf = null;

    /**
     * Flag that determines whether to limit instance `overwriting` if its `true` then if `$instanceOfSelf` is `NOT` null, you cannot run `init()`
     * @var bool
     */
    protected static bool $limit = true;



    protected function __construct(){
        static::$instanceOfSelf = $this;
        $this->boot();
    }
    /**
     * Modify this for custom construct logic
     * * Run after `Singleton::__construct()`
     * @return void
     */
    protected function boot(): void{}

    public static function getInstance(): object|null{
        return static::$instanceOfSelf;
    }
    public static function instance(): object|null{
        return static::getInstance();
    }
}
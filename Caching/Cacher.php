<?php
namespace Probe\Caching;

use Probe\Blueprints\Makeable;


abstract class Cacher extends Makeable{

    /**
     * Where the cached files should be stored.
     */
    abstract protected function cacheLocation(): string;

    public static function stub(): string{
        return "provider.stub";
    }

    final public static function suffix(): string{
        return "cacher";
    }

    /**
     * Logic for caching the specific resource
     * @return bool Returns `true` if the cache was successful and false otherwise
     */
    abstract public function cache(): bool;
}
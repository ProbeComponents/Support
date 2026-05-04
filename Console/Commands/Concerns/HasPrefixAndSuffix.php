<?php
namespace Probe\Console\Commands\Concerns;

/**
 * Allows for commands to be separated into two parts, great for making custom prefixed command structures, just how its done in `Probe\Blueprints\Makeable`.
 * * Implement: `protected static function prefix(): string`
 * * Implement OR abstract: `protected static function suffix(): string`
 */
trait HasPrefixAndSuffix{
    /**
     * The string that will appear `before` the colon, example: `make:view` -> `{prefix}:view`
     */
    abstract protected static function prefix(): string;
    
    /**
     * The string that will appear `after` the colon, example: `make:view` -> `make:{suffix}`
     */
    abstract protected static function suffix(): string;

    /**
     * Returns the entire command, e.g: `make:view` -> `{prefix}:{suffix}`
     */
    final public static function command(): string{
        return static::prefix() . ":" . static::suffix();
    }
}
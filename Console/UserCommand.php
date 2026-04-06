<?php
namespace Probe\Console;

/**
 * A command blueprint for custom commands
 */
abstract class UserCommand extends Command{
    /**
     * The string that will appear before the colon, example: `make:view` -> `{prefix}:view`
     * @return string
     */
    abstract protected static function prefix(): string;
    
    /**
     * The string that will appear before the colon, example: `make:view` -> `make:{suffix}`
     * @return string
     */
    abstract protected static function suffix(): string;

    /**
     * Returns the entire command, e.g: `make:view` -> `{prefix}:{suffix}`
     * @return string
     */
    final public static function command(): string{
        return static::prefix() . ":" . static::suffix();
    }
}
<?php
namespace Probe\Console\Commands\Blueprints;

/**
 * Base class for a command that accepts arguments
 */
abstract class CommandWithArgs{
    /**
     * Stores the command as a string
     * @return string
     */
    abstract public static function command(): string;

    /**
     * The `logic` that will be executed when the `command()` is called in the `CLI`
     */
    abstract public static function executeCommand(...$args): void;
}
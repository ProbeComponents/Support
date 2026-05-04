<?php
namespace Probe\Console\Commands\Blueprints;

abstract class Command{
    /**
     * Stores the command as a string
     * @return string
     */
    abstract public static function command(): string;

    /**
     * The `logic` that will be executed when the `command()` is called in the `CLI`
     * @return void
     */
    abstract public static function executeCommand(): void;
}
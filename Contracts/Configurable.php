<?php
namespace Probe\Contracts;

use InvalidArgumentException;
use Probe\Support\Str;


abstract class Configurable{
    protected static string $configPath = "";
    protected static array $configPaths = [];
    protected static bool $multiConfigMode = false;

    /**
     * Method to set a Default Config Path
     * @return void
     */
    abstract protected function defaultConfigPath(): string;

    /**
     * Bind the config or configs using either $configPath or $configPaths
     * @param string $path
     * @return void
     * @throws InvalidArgumentException When `$name` or `$path` is empty
     */
    public function bindConfig(string $name = "", string $path): void{
        if (Str::isEmpty($path)){
            throw new InvalidArgumentException('$path cannot be left empty in bindConfig() on Configurable class: ' . static::class);
        }
        if (!static::$multiConfigMode){
            static::$configPath = $path;
        }
        if (Str::isEmpty($name)){
            throw new InvalidArgumentException('$name cannot be left empty in bindConfig() whilst using multi config mode on Configurable class: ' . static::class);
        }
        static::$configPaths[$name] = $path;
    }

    /**
     * Get a binded config path by name i.e `app => /path/to/config.php`, `$name` would be `app` and the return of `Configurable::config('app')` would be `/path/to/config.php`
     * @param string $name
     * @return string
     */
    public function config(string $name = ""): string{
        return match(true){
            static::$multiConfigMode and in_array($name, static::$configPaths) => static::$configPaths[$name],
            !static::$multiConfigMode => static::$configPath,
            // If its in multi config mode and the $name provided is not in the binded configPaths
            default => throw new InvalidArgumentException("$name is not a valid Binded config for Configurable class: " . static::class),
        };
    }
}
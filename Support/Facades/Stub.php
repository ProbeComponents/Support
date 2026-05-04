<?php
namespace Probe\Support\Facades;

use Probe\Patterns\Facade;
use Probe\Managers\StubManager;

/**
 * Facade for managing Stubs
 * 
 * @method static void publish(string $destinationDir)
 * @method static string getPath(string $stub)
 */
class Stub extends Facade{
    protected static function getFacadeAccessor(): StubManager{
        return new StubManager();
    }
}
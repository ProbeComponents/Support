<?php
namespace Probe\Support\Facades;

use Probe\Managers\EnvironmentManager;
use Probe\Patterns\Facade;


/**
 * 
 * @method static void loader(string $directory)
 */
class Env extends Facade{
    protected static function getFacadeAccessor(): object{
        return EnvironmentManager::getInstance();
    }
}
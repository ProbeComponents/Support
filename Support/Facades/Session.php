<?php
namespace Probe\Support\Facades;

use Probe\Http\SessionManager;
use Probe\Patterns\Facade;

/**
 * Session Management Facade
 * 
 * 
 * @method static void start()
 * @method static void reset()
 * @method static mixed get(string $key, mixed $default = null)
 * @method static void store(string $key, mixed $value)
 * @method static void remove(string $key)
 */
class Session extends Facade{
    protected static function getFacadeAccessor(): SessionManager{
        return SessionManager::instance();
    }
}
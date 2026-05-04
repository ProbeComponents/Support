<?php
namespace Probe\Support\Facades;

use Probe\Patterns\Facade;

class Auth extends Facade{
    protected static function getFacadeAccessor(): AuthManager{
        return AuthManager::instance();
    }
}
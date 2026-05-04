<?php
namespace Probe\Support\Facades;

use Probe\Patterns\Facade;


class User extends Facade{
    protected static function getFacadeAccessor(): \Probe\Auth\Models\User{
        return new \Probe\Auth\Models\User;
    }
}
<?php
namespace Probe\Http;

use Probe\Blueprints\Makeable;

abstract class Controller extends Makeable{
    final public static function suffix(): string{
        return "controller";
    }

    public static function folder(): string{
        return "Http";
    }
}
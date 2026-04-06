<?php
namespace Probe\Foundation\Http;

use Probe\Support\Contracts\Makeable;


abstract class Controller extends Makeable{
    final public static function suffix(): string{
        return "controller";
    }

    final public static function executeCommand(): void{
        echo "Created a controller at " . __DIR__ . "/App/Http/Controllers/Controller.php";
    }
}
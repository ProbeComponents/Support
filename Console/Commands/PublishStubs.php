<?php
namespace Probe\Console\Commands;

use Probe\Console\Commands\Blueprints\InternalCommand;
use Probe\Support\Facades\Stub;
use Probe\Support\Str;


/**
 * @method static void executeCommand(string $destinationDir)
 */
class PublishStubs extends InternalCommand{
    final public static function command(): string{
        return "publish:stubs";
    }

    public static function executeCommand(): void{
        Stub::publish(destinationDir: getcwd());
    }
}

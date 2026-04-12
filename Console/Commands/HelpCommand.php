<?php
namespace Probe\Console\Commands;

use Probe\Console\InternalCommand;


class HelpCommand extends InternalCommand{
    public static function command(): string{
        return "help";
    }

    public static function executeCommand(): void{
        app()->listCommands();
    }
}
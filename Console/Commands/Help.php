<?php
namespace Probe\Console\Commands;

use Probe\Console\InternalCommand;


class Help extends InternalCommand{
    public static function command(): string{
        return "help";
    }

    public static function executeCommand(): void{
        app()->listCommands();
    }
}
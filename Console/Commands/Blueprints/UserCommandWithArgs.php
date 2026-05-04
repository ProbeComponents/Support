<?php
namespace Probe\Console\Commands\Blueprints;

use Probe\Console\Commands\Concerns\HasPrefixAndSuffix;


/**
 * Identical to `Probe\Console\Commands\Blueprints\UserCommand` however you can pass parameters into `static::executeCommand()`
 */
abstract class UserCommandWithArgs extends CommandWithArgs{
    use HasPrefixAndSuffix;
}
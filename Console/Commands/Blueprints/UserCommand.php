<?php
namespace Probe\Console\Commands\Blueprints;

use Probe\Console\Commands\Concerns\HasPrefixAndSuffix;


/**
 * A command blueprint for custom commands (For commands that contain `two parts`, a `prefix` and a `suffix`)
 */
abstract class UserCommand extends Command{
    use HasPrefixAndSuffix;
}
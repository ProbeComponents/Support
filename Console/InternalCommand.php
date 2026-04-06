<?php
namespace Probe\Console;

use Probe\Support\Application;


/**
 * Internal Command contract used for default internal commands that don't use Prefixes and Suffixes
 */
abstract class InternalCommand extends Command{
    public static Application $app;
}
<?php
namespace Probe\Support\Traits;


/**
 * Make a class require a `__tostring()` method
 */
trait Stringable{
    abstract public function __tostring(): string;
}
<?php
namespace Probe\Support\Contracts;


/**
 * Use this with the Singleton trait
 */
interface Singleton{
    /**
     * A proxy method that intercepts instantiation and returns the currently stored instance if `$limit = true` and overwrites the stored instance otherwise
     * @param mixed $properties
     * @return static
     */
    public static function init(?array $properties = null): static{
        
    }
}
<?php
namespace Probe\Contracts;

/**
 * Registry that holds important file paths.
 */
abstract class PathRegistry{
    abstract public static function basePath(): string;

    /**
     * An associative array that holds aliases that point to a file location
     * @return array
     */
    abstract public static function stubPaths(): array;

    /**
     * Path to the resources folder
     * @return array
     */
    abstract public static function resourcePaths(): ?array;
}
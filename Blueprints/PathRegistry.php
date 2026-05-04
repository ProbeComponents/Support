<?php
namespace Probe\Blueprints;

use Probe\Patterns\Singleton;

/**
 * Registry that holds important file paths.
 */
abstract class PathRegistry extends Singleton{
    abstract public function basePath(): string;

    /**
     * An associative array that holds aliases that point to a file location
     * @return array
     */
    abstract public function stubPaths(): array;

    /**
     * Path to the resources folder
     * @return array
     */
    abstract public function resourcePaths(): ?array;
}
<?php
namespace Probe\Support;

use Probe\Support\Contracts\Publishable;

/**
 * Utility class for managing Stubs
 */
class Stub extends Publishable{
    public const string VIEW = "view.stub";
    /**
     * The stub name for a blueprint for the Env generator that combines all of the binded blueprints and generates an .env file from code
     */
    public const string ENV_BLUEPRINT = "env_blueprint.stub";


    protected static function publishedFolderName(): string{
        return "stubs";
    }

    protected static function pathToResources(): string{
        return __DIR__ . "/stubs/";
    }

    /**
     * Get the path of where the stub is located
     * @param string $stub A defined Constant in the `Stub::class`
     * @return string
     * @throws \InvalidArgumentException If the `$stub` is invalid
     */
    public static function getPath(string $stub): string{
        $stubs = array_values(new \ReflectionClass(__CLASS__)->getConstants());
        if (!in_array($stub, $stubs)){
            throw new \InvalidArgumentException('Invalid $stub provided.');
        }
        return self::pathToResources() . $stubs[array_search($stub, $stubs)];
    }
}
<?php
declare(strict_types=1);
namespace Probe\Blueprints;

use InvalidArgumentException;
use function Laravel\Prompts\info;
use Probe\Support\Str;
use Symfony\Component\Filesystem\Filesystem;

use function Laravel\Prompts\error;

/**
 * Utility Class for Publishing resources
 */
abstract class Publishable{

    /**
     * Get the name of the folder to use for publishing resources.
     */
    abstract protected static function publishedFolderName(): string;

    /**
     * Get the path of the resources to publish
     */
    abstract protected static function pathToResources(): string;


    /**
     * Publish the stubs to the desired destination directory i.e the `App Root`
     * @param string $destinationDir Full path that should `NOT` end in a trailing slash
     */
    public function publish(string $destinationDir): void{
        if (Str::isEmpty($destinationDir)) throw new InvalidArgumentException('$destinationDir cannot be an empty string please provide a valid path');
        $destinationDir = rtrim($destinationDir) . "/" . static::publishedFolderName() . "/";
        $filesystem = new Filesystem();
        if (is_dir($destinationDir)){
            error("Failed to publish resources. File or Directory {$destinationDir} Exists");
            exit;
        }else{
            mkdir(directory: $destinationDir, recursive: true);
        }
        $filesystem->mirror(originDir: static::pathToResources(), targetDir: $destinationDir, options: ['override' => false]);
        info("Resources Published to {$destinationDir}");
    }

}
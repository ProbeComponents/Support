<?php
declare(strict_types=1);
namespace Probe\Contracts;

use Probe\Console\Command;
use Symfony\Component\Filesystem\Filesystem;
use function Laravel\Prompts\error;

/**
 * Utility Class for Publishing resources
 */
abstract class Publishable extends Command{

    final public static function prefix(): string{
        return "publish";
    }

    /**
     * Get the name of the folder to use for publishing resources.
     * @return string
     */
    abstract protected static function publishedFolderName(): string;

    /**
     * Get the path of the resources to publish
     * @return string
     */
    abstract protected static function pathToResources(): string;


    /**
     * Publish the stubs to the desired destination directory i.e the `App Root`
     * * Utilises LSB (late static binding)
     * @param string $destinationDir Full path that should `NOT` end in a trailing slash
     * @return void
     */
    public static function publish(string $destinationDir): void{
        $destinationDir = rtrim($destinationDir) . "/" . static::publishedFolderName() . "/";
        $filesystem = new Filesystem();
        if (is_dir($destinationDir)){
            error("Failed to publish resources. File or Directory {$destinationDir} Exists");
            exit;
        }else{
            mkdir(directory: $destinationDir, recursive: true);
        }
        $filesystem->mirror(originDir: static::pathToResources(), targetDir: $destinationDir, options: ['override' => false]);
    }

}
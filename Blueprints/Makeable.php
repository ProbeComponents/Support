<?php
namespace Probe\Blueprints;

use Probe\Concerns\HasStub;
use Probe\Console\Commands\Blueprints\UserCommandWithArgs;
use Probe\Support\Facades\File;
use function Laravel\Prompts\error;
use function Laravel\Prompts\info;



/**
 * Base class that should be extended to allow a Blueprint to be makeable from stub
 * * Children must Implement: `suffix()`, `stub()`, `namespace()` and `folder()`
 * * Uses: `Probe\Support\Traits\HasStub`
 */
abstract class Makeable extends UserCommandWithArgs{
    use HasStub;

    final protected static function prefix(): string{
        return "make";
    }

    public static function executeCommand(...$args): void{
        /** The provided name when the command was run */
        $className = $args[0];
        $destinationDir = getcwd() . "/" . trim(static::folder(), "/");

        $stub = File::read(fileName: stubPath() . static::stub());
        if (!$stub){
            error("Failed to create from stub: " . static::stub() . " - as it does not exist in " . stubPath());
            exit;
        }
        
        $parseRules = [
            "{{ name }}" => $className,
            "{{ namespace }}" => static::namespace(),
        ];

        foreach($parseRules as $placeholder => $translation){
            $stub = str_replace($placeholder, $translation, $stub);
        }
        $parsedStub = $stub;

        if (!is_dir($destinationDir)){
            mkdir(directory: $destinationDir, recursive: true);
        }
        $filePath = "{$destinationDir}/{$className}.php";

        if (file_exists($filePath)){
            error("{$filePath} already exists.");
            exit;
        }
        
        $file = new File(fileName: $filePath, mode: "w");
        $file->write($parsedStub);
        $file->close();
        if (file_exists($filePath)){
            info("Successfully created from stub: " . static::stub() . ", You can find it here: {$filePath}");
        }else{
            error("Failed to make from Stub, Permission denied in: {$destinationDir}");
        }
    }
}
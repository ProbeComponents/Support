<?php
namespace Probe\Contracts;

use Probe\Console\UserCommand;
use Probe\Support\Facades\File;
use Probe\Support\Traits\HasStub;

use Probe\Templating\Glyph;



abstract class Makeable extends UserCommand{
    use HasStub;

    final protected static function prefix(): string{
        return "make";
    }

    public static function executeCommand(): void{
        $stub = File::read(fileName: static::stub());
        Glyph::parse(stub: $stub);
    }
}
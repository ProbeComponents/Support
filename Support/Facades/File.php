<?php
namespace Probe\Support\Facades;

use Exception;
use InvalidArgumentException;


/**
 * File manipulation facade
 */
class File{

    protected $file;

    /**
     * @param mixed $fileName
     * @param mixed $mode Please use the `fopen()` documentation for all of the valid modes: https://www.php.net/manual/en/function.fopen.php
     */
    public function __construct(string $fileName, string $mode = "r"){
        $this->file = fopen($fileName, $mode);
        if (!$this->file){
            throw new Exception("Could not open stream: {$fileName}");
        }
    }

    /**
     * Read the contents of a file
     * @param string $fileName Full path to file or relative path, `/dir1/dir2/file.txt` OR `./file.txt`
     * @return bool|string Returns False if the file does not exist and a string of contents if it does and its not empty
     */
    public static function read(string $fileName): bool|string{
        return file_get_contents($fileName);
    }

    public function createFromStub(string $stubFileName): void{
        if (!stub($stubFileName)){
            throw new InvalidArgumentException("{$stubFileName} is not a valid stub");
        }
        $contents = self::read(stub($stubFileName));
        fwrite($this->file, $contents);
    }

    public function write(string $data): void{
        fwrite($this->file, $data);
    }

    public function __destruct(){
        $this->close();
    }

    /**
     * Close the currently opened file.
     */
    public function close(): void{
        if (is_resource($this->file)){
            fclose($this->file);
        }
    }
}
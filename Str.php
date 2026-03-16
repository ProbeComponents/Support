<?php
namespace Probe\Support;
use Probe\Support\Traits\Stringable;

/**
 * String helper class.
 * * Inspired by the Laravel Str Facade: https://laravel.com/docs/12.x/strings
 * * Also Inspired by the Java String API https://docs.oracle.com/javase/8/docs/api/java/lang/String.html
 */
class Str{
    use Stringable;

    /**
     * Create a new Str instance
     * @param string $string
     */
    public function __construct(protected string $string){}

    public function __toString(): string{
        return $this->string;
    }
    /**
     * Check whether the stored `$this->string` is `VALID` JSON.
     * @return bool
     */
    public function isJSON(): bool{
        return JSON::validate($this->string);
    }
    /**
     * @throws \InvalidArgumentException If `$json` is invalid
     * @return JSON
     */
    public function toJSON(): JSON{
        return JSON::fromJSON($this->string);
    }
    /**
     * Checks whether the string property is the same as a provided string
     * @param string $string
     * @return bool
     */
    public function is(string $string): bool{
        return Str::areEqual($this->string, $string);
    }
    /**
     * Checks whether the string property is the same as a provided string
     * * Alias of `Str::is()`
     * @param string $string
     * @return bool
     */
    public function equalTo(string $string): bool{
        return $this->is($string);
    }
    /**
     * Checks whether the string property is the same as a provided string
     * * Alias of `Str::is()`
     * @param string $string
     * @return bool
     */
    public function isEqualTo(string $string): bool{
        return $this->is($string);
    }

    public function toArray(): array{
        return self::toArrayFormat($this->string);
    }
    /**
     * Turns a string to an array
     * * Alias of `Str::toArray()`, Made simply to fit more into the Java String API
     * @param string $string
     * @return string[]
     */
    public function toCharArray(): array{
        return self::toArrayFormat($this->string);
    }

    /** STATIC HELPER METHODS */
    
    public static function startsWith(string $haystack, string $needle): string{
        return str_starts_with($haystack, $needle);
    }
    public static function endsWith(string $haystack, string $needle): string{
        return str_ends_with($haystack, $needle);
    }
    public static function contains(string $haystack, string $needle): string{
        return str_contains($haystack, $needle);
    }

    /**
     * Turns a string to an array
     * @param string $string
     * @return string[]
     */
    public static function toArrayFormat(string $string): array{
        return str_split($string);
    }

    /**
     * Checks whether strings are the same
     * * `count(array_unique($array))` should return `1` if all of the strings are the same.
     * @param string[] $strings
     * @return bool
     */
    public static function areEqual(string ...$strings): bool{
        return count(array_unique($strings)) === 1;
    }

    /**
     * Check whether a string is empty
     * * The method uses the `trim()` function and compares it to an empty string and returns the result
     * @param string $string
     * @return bool
     */
    public static function isEmpty(string $string){
        return trim($string) === "";
    }
}
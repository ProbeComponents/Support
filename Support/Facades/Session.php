<?php
namespace Probe\Support\Facades;

use Probe\Support\Arr;



/**
 * Session Management Facade
 */
class Session{

    /**
     * Start or resume a session (by default)
     */
    public function __construct(){
        static::start();
    }

    /**
     * Start or resume a session
     * @return void
     */
    public static function start(): void{
        session_start();
    }

    /**
     * Destroy the current session and spin up a new one.
     */
    public function reset(): void{
        static::end();
        static::start();
    }

    /**
     * End / Destroy an active session
     * @return void
     */
    public static function destroy(): void{
        session_destroy();
    }
    public static function end(): void{
        return static::destroy();
    }


    /**
     * Store an item in the session, to store nested items use dot notation, E.g: `Session::store("user.name", "john johnson") = $_SESSION["user"]["name"] = "john johnson"`
     */
    public static function store(string $key, mixed $value): void{
        $segments = explode(separator: ".", string: $key);
        $reference = &$_SESSION;
        foreach($segments as $segment){
            if (!isset($reference[$segment]) || !is_array($reference[$segment])){
                $reference[$segment] = [];
            }
            $reference = &$reference[$segment];
        }
        $reference = $value;
    }

    /**
     * Fetch an item stored in the session, to access nested items use dot notation, E.g: `user.name = $_SESSION["user"]["name"]`
     * @param string $key Example: `user.name`
     * @param mixed $default Value to return if the `$key` does not exist in `$_SESSION`
     */
    public static function get(string $key, mixed $default = null): mixed{
        return Arr::multiDimensionalSearch(array: $_SESSION, key: $key) ?? $default;
    }
}
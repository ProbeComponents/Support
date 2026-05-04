<?php
namespace Probe\Http;

use Probe\Patterns\Singleton;
use Probe\Support\Arr;



/**
 * Session Management Abstraction Layer
 */
class SessionManager extends Singleton{

    /**
     * Start or resume a session
     */
    public function __construct(){
        static::start();
    }

    /**
     * Start or resume a session
     */
    public function start(): void{
        session_start();
    }

    /**
     * Destroy the current session and spin up a new one.
     */
    public function reset(): void{
        $this->end();
        $this->start();
    }

    /**
     * End / Destroy an active session
     * @return void
     */
    public function destroy(): void{
        session_destroy();
    }
    public function end(): void{
       $this->destroy();
    }

    /**
     * Fetch all of the currently set session variables
     */
    public function all(): array{
        $this->start();
        return $_SESSION;
    }


    /**
     * Store an item in the session, to store nested items use dot notation, E.g: `Session::store("user.name", "john johnson") = $_SESSION["user"]["name"] = "john johnson"`
     */
    public function store(string $key, mixed $value): void{
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
    public function get(string $key, mixed $default = null): mixed{
        return Arr::multiDimensionalSearch(array: $_SESSION, key: $key) ?? $default;
    }
    /**
     * Alias for `SessionManager::get()`
     */
    public function fetch(string $key, mixed $default = null){
        return $this->get(key: $key, default: $default);
    }

    public function remove(){}
    public function discard(){}
    public function exterminate(){}
}
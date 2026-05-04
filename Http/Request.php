<?php
namespace Probe\Http;

use Probe\Patterns\Singleton;
use Probe\Support\Arr;
use Probe\Enums\HttpMethod;
use Probe\Support\Facades\File;
use Probe\Support\JSON;

class Request extends Singleton{

    /**
     * Use this `ONLY` for `mocking` requests, For capturing requests use `Request::capture()`
     * @param HttpMethod $type Request type
     * @param array $parameters GET Parameters
     * @param array $payload Any data sent along with the request: `POST, PUT, PATCH or DELETE`
     */
    public function __construct(public string $endpoint, public HttpMethod $type, protected array $parameters, protected array $payload){}

    /**
     * Capture the incoming request
     * @return Request
     */
    public static function capture(): static{
        return new static(endpoint: $_SERVER['REQUEST_URI'] ,type: HttpMethod::tryFrom(value: strtoupper($_SERVER['REQUEST_METHOD'])), parameters: $_GET, payload: static::incomingData());
    }
    
    public function hostname(): string{
        return $_SERVER['HTTP_HOST'];
    }
    public function domain(): string{
        return static::hostname();
    }

    /**
     * Returns the URI being accessed, i.e: `/dashboard/123`
     * @return string
     */
    public function uri(): string{
        return rtrim($_SERVER['REQUEST_URI'], "/");
    }
    public function path(): string{
        return static::uri();
    }
    public function uriPath(): string{
        return static::uri();
    }

    public function url(): string{
        return static::domain() . static::uri();
    }

    /**
     * Get all of the incoming data.
     */
    public static function incomingData(): array{
        return JSON::decode(json: File::read(fileName: "php://input")) ?? [];
    }

    /**
     * @param string $key Example: `"user" = $_GET["user"]`
     */
    final public static function get(string $key): mixed{
        return Arr::multiDimensionalSearch(array: $_GET, key: $key);
    }

    /**
     * @param string $key Example: `"user" = $_POST["user"]`
     */
    final public static function post(string $key): mixed{
        return Arr::multiDimensionalSearch(array: $_POST, key: $key);
    }



    public function isGet(): bool{
        return $this->type === HttpMethod::GET;
    }
    public function isPost(): bool{
        return $this->type === HttpMethod::POST;
    }
    public function isDelete(): bool{
        return $this->type === HttpMethod::DELETE;
    }
    public function isPatch(): bool{
        return $this->type === HttpMethod::PATCH;
    }
    public function isPut(): bool{
        return $this->type === HttpMethod::PUT;
    }
}
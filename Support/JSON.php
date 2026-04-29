<?php
namespace Probe\Support;

use Probe\Support\Traits\Stringable;


class JSON{
    use Stringable;

    /**
     * @param string $json A Valid JSON string
     */
    protected function __construct(protected string $json){}

    /**
     * Create a `JSON::class` instance from a `VALID` JSON string
     * @param string $json
     * @throws \InvalidArgumentException If `$json` is invalid
     * @return JSON
     */
    public static function fromJSON(string $json): JSON{
        if (!self::validate(json: $json)) throw new \InvalidArgumentException(message: '$json must be valid JSON');
        return new self(json: $json);
    }

    public static function fromArray(array $data): JSON{
        return self::fromJSON(json_encode($data));
    }

    /**
     * Returns an associative array that is returned by `json_decode()`
     * @return array
     */
    public function toArray(): array{
        return json_decode(json: $this->json, associative: 1);
    }
    public function toObject(): array{
        return json_decode(json: $this->json, associative: 0);
    }

    public function __tostring(): string{
        return $this->json;
    }

    public static function validate(string $json): bool{
        return json_validate($json);
    }

    public static function encode(array $data): bool|string{
        return json_encode($data);
    }

    /**
     * Decodes to an associative array by default
     * * Looking to decode to object? use `JSON::decodeToObject()`
     * @return array
     */
    public static function decode(string $json): array|null{
        return json_decode(json: $json, associative: 1);
    }
    public static function decodeToObject(string $json): array|null{
        return json_decode($json, 0);
    }


    // FUNction
    public static function isTheBest(): void{
        echo "NO, PHP IS BETTER!!!";
    }
}

<?php
namespace Probe\Support;

use Probe\Support\Auth\Enums\HttpErrorResponseCode;
use Probe\Support\Auth\Enums\HttpResponseCode;
use Probe\Support\Traits\Stringable;

class JSONResponse{
    use Stringable;
    public function __toString(): string{
        header('Content-Type: application/json; charset=utf-8');
        return JSON::encode([
            "code" => $this->responseCode->value,
            "message" => $this->message,
            $this->body,
        ]);
    }
    public function __construct(protected HttpResponseCode|HttpErrorResponseCode $responseCode = HttpResponseCode::OK, protected ?string $message = null, protected ?array $body = null){}
}
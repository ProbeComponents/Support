<?php
namespace Probe\Enums;


enum HttpErrorResponseCode: int{
    case METHOD_NOT_ALLOWED = 405;
    case NOT_FOUND = 404;
    case PERMISSION_DENIED = 403;
    case PAYMENT_REQUIRED = 402;
    case AUTHENTICATION_FAILED = 401;
    case BAD_REQUEST = 400;
}

?>
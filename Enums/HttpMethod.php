<?php
namespace Probe\Enums;

enum HttpMethod: string{
    // Fetch a resource
    case GET = "GET";
    // Create a new resource
    case POST = "POST";
    // A full replacement of a resource
    case PUT = "PUT";
    // Partial Update to a resource
    case PATCH = "PATCH";
    // Delete a resource
    case DELETE = "DELETE";
}
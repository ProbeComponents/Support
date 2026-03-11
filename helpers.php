<?php
use Probe\Support\JSON;
use Probe\Support\Arr;


function isFocalApp(): bool{
    return class_exists(\Probe\Core\Application::class);
}


if (isFocalApp()){
    require_once __DIR__ . "/focal_helpers.php";
}

// PHP 8.5 ARRAY FUNCTIONS FOR PHP VERSIONS LOWER THAN 8.5
if (version_compare(PHP_VERSION, "8.5.0", "<")){
    function array_first(array $array):mixed{
        return Arr::first($array);
    }
    function array_last(array $array):mixed{
        return Arr::last($array);
    }
}
function array_remove_keys(array $array, array $keys){
    return Arr::removeKeys($array, $keys);
}

/**
 * Helper function to fetch Environment variables
 * * Can be run: `Anywhere`
 * @param string $key
 * @throws Exception
 * @return int|bool|string
 */
function env(string $key): int|bool|string{
    if (isFocalApp()){
        if (!(app()->booted())){
            throw new Exception("Cannot fetch environment variable value because the App is not booted/ bootstrapped." . 'Run app()->boot()');
        }
    }
    if (!array_key_exists(key: $key, array: $_ENV)){
        throw new Exception("$key is not a valid environment variable");
    }
    return $_ENV[$key];
}

function isValidJSON(string $json): bool{
    return JSON::validate($json);
}
function isJson(string $json){
    return isValidJSON($json);
}
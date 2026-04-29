<?php
namespace Probe\Support;

use InvalidArgumentException;


abstract class Arr{
    public static function first(array $array): mixed{
        return array_values($array)[0];
    }
    public static function last(array $array): mixed{
        return array_values($array)[self::count($array) -  1];
    }
    public static function count(array $array): int{
        return count($array);
    }

    /**
     * Remove $values from each array in $arrays
     * @param array[array] $arrays An array of arrays
     * @param array $values An array of values to remove
     * @return array[array] Returns a multi dimensional array
     */
    public static function multiDiff(array $arrays, array $values): array{
        if ($arrays === []) throw new InvalidArgumentException(message: '$arrays must be a two dimensional array, an empty array given');
        foreach($arrays as &$array){
            array_diff(array: $array, arrays: $values);
        }
        return $arrays;
    }

    /**
     * Remove specific `$keys` from each `array` in `$arrays`
     * @param array[array] $arrays A `two dimensional` array
     * @param array $keys Either an `array of indices` or `string keys for associative arrays`
     * @return array[array]
     */
    public static function multiKeyDiff(array $arrays, array $keys): array{
        if ($arrays === []) throw new InvalidArgumentException(message: '$arrays must be a two dimensional array, an empty array given');
        foreach($arrays as &$array){
            array_diff_key(array: $array, arrays: $keys);
        }
        return $arrays;
    }

    /**
     * Remove `$keys` from the `$array`
     * @param array $array
     * @param array $keys
     * @return array
     */
    public static function removeKeys(array $array, array $keys): array{
        foreach($keys as $key){
            unset($array[$key]);
        }
        return $array;
    }

    /**
     * Search a multi dimensional associative array and get its value if it exists null otherwise
     * @param mixed $key Example: `"user.name"` will search for `$array["user"]["name"]`
     */
    public static function multiDimensionalSearch(array $array, $key): mixed{
        $segments = explode(separator: '.', string: $key);
        $current = $_SESSION;
        foreach ($segments as $segment){
            if (!isset($current[$segment])){
                return null;
            }
            $current = $current[$segment];
        }
        return $current;
    }
}
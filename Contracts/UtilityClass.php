<?php
namespace Probe\Contracts;


/**
 * Makes a class non-instanceable (Cannot be constructed)
 */
class UtilityClass{
    /**
     * Any Child class `SHOULD NOT` be instantised
     */
    final protected function __construct(){}
}
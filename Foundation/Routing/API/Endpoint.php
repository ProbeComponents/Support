<?php
namespace Probe\Foundation\Routing\API;

use Exception;
use Probe\Support\Enums\HttpMethod;


/**
 * Middleware to assert API specifications
 * * Restricting which parameters are accepted on each request
 */
abstract class Endpoint{
    /**
     * Flag to only accept JSON
     * @var bool
     */
    protected bool $jsonOnly = false;


    /**
     * Hook that holds the required parameters that each request is required to have based on HTTP method
     * @return array
     */
    protected function requiredParameters(): array{
        return [
            HttpMethod::GET->value => [],
            HttpMethod::POST->value => [],
            HttpMethod::PUT->value => [],
            HttpMethod::PATCH->value => [],
            HttpMethod::DELETE->value => [],
        ];
    }
    /**
     * Hook that holds the optional parameters that the endpoint accepts
     * @return array
     */
    protected function optionalParameters(): array{
        return [
            HttpMethod::GET->value => [],
            HttpMethod::POST->value => [],
            HttpMethod::PUT->value => [],
            HttpMethod::PATCH->value => [],
            HttpMethod::DELETE->value => [],
        ];
    }

    /**
     * Returns the list of accepted parameters by the endpoint.
     * @return array{required: array, optional: array}
     */
    final public function acceptedParameters(): array{
        foreach($this->optionalParameters() as $HttpMethod => $parameters){
            // Get the intersecting values if any exist.
            $intersectingValues = array_intersect($parameters, $this->requiredParameters()[$HttpMethod]);
            if ($intersectingValues > 0){
                throw new Exception('You cannot have the following parameters to be optional and required at the same time: ' . implode(array: $intersectingValues) . ". Please check the following hooks: " . __CLASS__ . '::optionalParameters() and ' . __CLASS__ . '::requiredParameters() and remove any duplicates');
            }
        }
        return ["required" => $this->requiredParameters(), "optional" => $this->optionalParameters()];
    }
}
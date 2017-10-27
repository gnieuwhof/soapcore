<?php

/**
 * @file
 * @brief This file contains the class SoapInvalidTypeException.
 */

/**
 * @brief Class used for invalid argument types to a SOAP method.
 */
class SoapInvalidTypeException extends SoapArgumentException
{
    
    /**
     * @brief Constructs a SoapInvalidTypeException.
     * 
     * @param string $argument Name of the parameter.
     */
    public function __construct( $argument, $expectedType, $actualType )
    {
        parent::__construct(
            "Argument must be of type: $expectedType, $actualType given.",
            $argument,
            'InvalidTypeException'
            );
    }
    
}

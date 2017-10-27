<?php

/**
 * @file
 * @brief This file contains the class SoapArgumentNullException.
 */

/**
 * @brief Class used for null arguments to a SOAP method.
 */
class SoapArgumentNullException extends SoapArgumentException
{
    
    /**
     * @brief Constructs a SoapArgumentNullException.
     * 
     * @param string $argument Name of the parameter.
     */
    public function __construct( $argument )
    {
        parent::__construct(
            'Argument may not be null.',
            $argument,
            'ArgumentNullException'
            );
    }
    
}

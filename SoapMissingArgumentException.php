<?php

/**
 * @file
 * @brief This file contains the class SoapMissingArgumentException.
 */

/**
 * @brief Class used for a missing arguments to a SOAP method.
 */
class SoapMissingArgumentException extends SoapArgumentException
{
    
    /**
     * @brief Constructs a SoapMissingArgumentException.
     * 
     * @param string $argument Name of the parameter.
     */
    public function __construct( $argument )
    {
        parent::__construct(
            'Argument can not be found.',
            $argument,
            'SoapMissingArgumentException'
            );
    }
    
}

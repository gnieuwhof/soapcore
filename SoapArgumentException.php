<?php

/**
 * @file
 * @brief This file contains the class SoapArgumentException.
 */

/**
 * @brief Base class for SOAP argument exceptions.
 */
class SoapArgumentException extends SoapException
{
    
    protected $exceptionType = 'ArgumentException';
    
    /**
     * @brief Constructs a SoapArgumentException.
     * 
     * @param string $message Error message.
     * @param string $argument Name of the parameter.
     */
    public function __construct( $message, $argument, $exceptionType = null )
    {
        // Remove $ from argument.
        $argument = ltrim( $argument, '$' );
        
        if( $exceptionType !== null )
        {
            $this->exceptionType = $exceptionType;
        }
        
        parent::__construct(
            $this->exceptionType . ': ' . $message . PHP_EOL .
            'Parameter: ' . $argument
            );
    }
    
}

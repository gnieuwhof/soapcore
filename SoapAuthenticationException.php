<?php

/**
 * @file
 * @brief This file contains the class SoapAuthenticationException.
 */

/**
 * @brief Base class for SOAP authentication exceptions.
 */
class SoapAuthenticationException extends SoapException
{
    
    /**
     * @brief Constructs a SoapAuthenticationException.
     * 
     * @param string $message Error message.
     */
    public function __construct( $message )
    {
        parent::__construct( 'AuthenticationException: ' . $message );
    }
    
}

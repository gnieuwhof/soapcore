<?php

/**
 * @file
 * @brief This file contains the class CallWrapper.
 */

/**
 * @brief This class is used to catch SoapExceptions
 *   in all SOAP calls and throw them as Faults.
 */
class CallWrapper
{

    /**
     * @brief All SOAP calls should go through this function.
     * 
     * This function is automagically called, if the called function does not
     * exists. Since this is the only function, this will always be called...
     * The call will be relayed to the SoapWrapper. If a SoapException
     * is thrown it will be caught here and a SOAP Fault is thrown.
     * 
     * @param string $method
     * @param array $args
     * @return mixed
     */
    public function __call( $method, array $args)
    {
        try
        {
            return call_user_func_array(
                array( Config::SOAP_WRAPPER_CLASS_NAME, $method ),
                $args
                );
        }
        catch(SoapException $se)
        {
            FaultManager::ThrowSoapFault($se);
        }
    }
    
}

<?php

/**
 * @file
 * @brief This file contains the class FaultManager.
 */

/**
 * @brief Helper class to handle SOAP faults.
 */
class FaultManager
{

    /**
     * @brief Throw Exception converted to SOAP fault.
     *
     * @param SoapException $exception SOAP exception to convert and throw.
     * @throws SoapFault
     */
    public static function ThrowSoapFault( $exception )
    {
        $faultcode = 'Receiver';
        $faultstring = $exception->getMessage();
        $faultactor = $exception->GetFaultactor();
        $detail = $exception->GetDetail();
        
        throw new SoapFault(
            $faultcode,
            $faultstring,
            $faultactor,
            $detail
            );
    }

}

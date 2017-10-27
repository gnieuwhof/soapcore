<?php

/**
 * @file
 * @brief This file contains the class SoapException.
 */

/**
 * @brief Custom Exception, adds faultactor & detail to Exception.
 */
class SoapException extends Exception
{

    private $detail = '';
    
    public function GetFaultactor()
    {
        return 'http://' . $_SERVER[ 'HTTP_HOST' ] . $_SERVER[ 'REQUEST_URI' ];
    }
    
    public function GetDetail()
    {
        return $this->detail;
    }
    
    public function SetDetail( $detail )
    {
        $this->detail = $detail;
    }

}

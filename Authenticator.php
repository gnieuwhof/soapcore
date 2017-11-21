<?php

class Authenticator
{

    private $level;    
    private $authTimestamp;
    private $authTokenId;
    private $authToken;
    

    public function Authenticate( $methodName )
    {
        $this->level =
            array_key_exists( $methodName, AuthAccess::$methodLevel ) ?
            AuthAccess::$methodLevel[ $methodName ] :
            'full';
        
        if( $this->level == 'all' )
        {
            // No authentication required.
            return;
        }
        
        $this->ProcessHeaders();
        
        $this->AuthenticateRequest();
    }
    
    
    private function ProcessHeaders()
    {
        foreach( getallheaders() as $name => $value )
        {
            switch( strtolower( $name ) )
            {
                case 'auth_timestamp':
                    $this->authTimestamp = $value;
                    break;
                case 'auth_token_id':
                    $this->authTokenId = $value;
                    break;
                case 'auth_token':
                    $this->authToken = strtolower( $value );
                    break;
            }
        }
        
        if( !isset( $this->authTimestamp ) )
            throw new SoapAuthenticationException( 'No timestamp header found.' );
        if( !isset( $this->authTokenId ) )
            throw new SoapAuthenticationException( 'No token ID header found.' );
        if( !isset( $this->authToken ) )
            throw new SoapAuthenticationException( 'No token header found.' );
    }
    
    private function AuthenticateRequest()
    {
        $timestamp = round( microtime( true ) * 1000 );
        
        if( abs( $timestamp - $this->authTimestamp ) > 60000 )
        {
            throw new SoapAuthenticationException(
                'Timestamp offset too large.' );
        }
        
		$database = new Database(new nl\gn\Sygnis\MySqlDatabase());
        
        $row = $database->GetToken( $this->authTokenId );
        
        if( !$row )
        {
            throw new SoapAuthenticationException( 'Token not found.' );
        }
        
        $token = $row[ 0 ];
        $level = $row[ 1 ];
        $accessed = $row[ 2 ];
        
        if( $accessed >= $this->authTimestamp )
        {
            throw new SoapAuthenticationException(
                'Timestamp must be larger than previous timestamp.' );
        }
        
        if( ( $level == 'full' ) || ( $this->level == 'readonly' ) )
        {
            if( $this->authToken != $this->ExpectedToken( $token ) )
            {
                throw new SoapAuthenticationException( 'Invalid token.' );
            }
            
            $database->SaveTimestamp(
                $this->authTokenId, $this->authTimestamp );

            return;
        }
        
        throw new SoapAuthenticationException( 'Invalid level' );
    }
    
    private function ExpectedToken( $token )
    {
        return hash( 'sha256', $this->authTimestamp . ':' . $token );
    }
    
}

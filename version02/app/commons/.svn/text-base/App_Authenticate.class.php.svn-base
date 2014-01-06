<?php

/**
 * @author Revan
 */
class App_Authenticate {
    
    public static function getLoggedInUser( CAC_Client_Request $http ){
        
        $cookies = $http->getCookies();
        
        if( isset( $cookies['ak'] ) ){
            
            $token = new Auth_Token( $cookies['ak'] );
            try {
                $tokenNode = new TokenNode( new GraphKey( $token->string() ) );
                $userNode = new UserNode( new GraphKey( $tokenNode->getUserKey() ) );
                return $userNode;
            } catch( KoreException $e ){
                throw new APP_AUTH_EXCEPTION('Could Not Acquire UserNode');
            }
            
        } else {
            throw new APP_AUTH_NO_COOKIE('Cookie Not Set');
        }
        
    }
    
    public static function requireLoggedOut( CAC_Client_Request $http ){
        
        try {
            $userNode = static::getLoggedInUser($http);
        } catch( KoreException $e ){
            return true;
        }
        
        throw new APP_AUTH_MUST_BE_LOGGED_OUT('User is logged in, but should not be');
        
    }
    
    public static function userBannerData( UserNode $userNode ){
        return array('disp'=>$userNode->getDispHandle(), 'key'=>$userNode->getKeyString() );
    }
    
    
    
}

?>

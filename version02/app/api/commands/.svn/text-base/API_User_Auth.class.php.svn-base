<?php

/**
 * @author Revan
 */
class API_User_Auth extends CAC_API_Command {
	
	public function doExecute( CAC_Client_Request $http ) {
		
        $params = $http->getUrlParams();
        
        if( array_search('login', $params) ){
            
            
            
            
            try {
                
                $userNode = App_Authenticate::getLoggedInUser($http);
                
                $this->status( CAC_API_Command::FAIL );
                $this->reason( 'alreadyloggedin' );
                
            } catch( APP_AUTH_EXCEPTION $e ){
                // No one logged in, allow proceed
                $this->getResponse()->headers()->setCookie('ak', 'thisismytoken1340550976');
                $this->status( CAC_API_Command::SUCCESS );

            }
            
		} elseif( array_search('logout', $params) ){
            
            try {
                
                $userNode = App_Authenticate::getLoggedInUser($http);
                $this->getResponse()->headers()->expireCookie('ak');
                $this->status( CAC_API_Command::SUCCESS );
                
            } catch( APP_AUTH_EXCEPTION $e ){
                
                // No Logged In User, cannot log out
                $this->status( CAC_API_Command::FAIL );
                $this->reason( 'notloggedin' );
                
            }
            
        }
        
	}
}

?>

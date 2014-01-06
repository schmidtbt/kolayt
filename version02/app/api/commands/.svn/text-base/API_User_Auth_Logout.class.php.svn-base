<?php

/**
 * @author Revan
 */
class API_User_Auth_Logout extends CAC_API_Command {
    
   
    public function doExecute(CAC_Client_Request $http) {
        
        $params = $http->getAllParams();
        
        try {
            
            $userNode = App_Authenticate::getLoggedInUser($http);
            $cookies = $http->getCookies();
            $token = new Auth_Token( $cookies['ak'] );
            
            $tokenNode = new TokenNode( new GraphKey( $token->string(), true ) );
            $tokenNode->deleteToken();
            $userNode->invalidateToken($token);
            
            
            $this->getResponse()->headers()->expireCookie('ak');
            $this->status( CAC_API_Command::SUCCESS );
            
        }  catch( APP_AUTH_MUST_BE_LOGGED_OUT $e ){
            $this->status( CAC_API_Command::FAIL );
            $this->info('cannot be logged in');
        } catch( APP_AUTH_EXCEPTION $e ){
            $this->status( CAC_API_Command::FAIL );
            $this->reason( CAC_API_Command::NOUSER );
        } catch( APP_MISSING_PARAMS $e ){
            $this->status( CAC_API_Command::FAIL );
            $this->reason( CAC_API_Command::MISSINGPARAM );
        } catch( APP_AUTH_BAD_CREDS $e ){
            $this->status( CAC_API_Command::FAIL );
            $this->info( 'bad credentials');
        } catch( GRAPH_EXCEPTION $e ){
            $this->status( CAC_API_Command::FAIL );
            $this->info( 'graph failure');
        } catch( KoreException $e ){
            var_dump( $e );
            $this->status( CAC_API_Command::FAIL );
            $this->reason( CAC_API_Command::UNKNOWN );
        }
    }
}

?>

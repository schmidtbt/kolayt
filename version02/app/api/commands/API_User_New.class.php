<?php

/**
 * @author Revan
 */
class API_User_New extends CAC_API_Command {
    
    public function doExecute(CAC_Client_Request $http) {
        
        $params = $http->getAllParams();
        
        try {
            
            App_Authenticate::requireLoggedOut( $http );
            App_Params::requireParams( $params, array('handle') );
            
            $handle     = $params['handle'];
            $first      = $params['first'];
            $last       = $params['last'];
            $email      = $params['email'];
            $password   = Auth_Password::genereate( $params['password'] );
            $password   = $password->getPassString();
            
            $userNode = UserNodeBuilder::create( $handle, $first, $last, $email, $password );
            
            if( $userNode instanceof UserNode ){
                $this->add('handle', $userNode->getKeyString() );
                $this->add('handle_disp', $userNode->getDispHandle() );
            }
            
        } catch( APP_AUTH_MUST_BE_LOGGED_OUT $e ){
            $this->status( CAC_API_Command::FAIL );
            $this->info('cannot be logged in');
        } catch( APP_MISSING_PARAMS $e ){
            $this->status( CAC_API_Command::FAIL );
            $this->reason( CAC_API_Command::MISSINGPARAM );
        } catch( GRAPH_EXCEPTION $e ){
            $this->status( CAC_API_Command::FAIL );
            $this->info( 'graph failure');
        } catch( KoreException $e ){
            $this->status( CAC_API_Command::FAIL );
            $this->reason( CAC_API_Command::UNKNOWN );
        }
        
    }
}

?>

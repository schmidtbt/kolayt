<?php

/**
 * @author Revan
 */
class API_User_Auth_Login extends CAC_API_Command {
    
    public function doExecute(CAC_Client_Request $http) {
        
        $params = $http->getAllParams();
        
        try {
            
            $userNode = App_Authenticate::requireLoggedOut($http);
            App_Params::requireParams( $params, array( 'email', 'password' ) );
            
            $email      = $params['email'];
            $password   = $params['password'];
            
            $emailNode  = new EmailNode( new GraphKey( $email ) );
            $userNode   = $emailNode->getUserNode();
            $isValid    = $userNode->validatePassword( Auth_Password::genereate( $password ) );
            
            if( !$isValid ){
                throw new APP_AUTH_BAD_CREDS('Username/Password Invalid');
            }
            
            $newToken = Auth_Token::generateToken();
            TokenNodeBuilder::create( $newToken->string(), $userNode->getKeyString() );
            $userNode->insertToken($newToken);
            
            $this->getResponse()->headers()->setCookie( 'ak', $newToken->string() );
            $this->getResponse()->headers()->setLocation('/boot');
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

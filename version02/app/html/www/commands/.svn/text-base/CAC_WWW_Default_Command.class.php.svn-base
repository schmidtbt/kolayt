<?php

/**
 * @author Revan
 */
class CAC_WWW_Default_Command extends CAC_Command {
    
    
    public function doExecute(CAC_Client_Request $http) {
        
        try {
            
            $user = App_Authenticate::getLoggedInUser($http);
            $this->getResponse()->headers()->setLocation( '/boot/?p=stream&user='.$user->getKeyString());
            
        } catch( KoreException $e ){
            
            $this->getResponse()->headers()->setLocation( '/boot/?p=tag&tag=popular');

        }
        
    }
    
}

?>

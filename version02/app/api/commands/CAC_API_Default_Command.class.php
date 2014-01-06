<?php

/**
 * @author Revan
 */
class CAC_API_Default_Command extends CAC_API_Command {
    
    public function doExecute(CAC_Client_Request $http) {
        $this->setResponse( new Api_EmptyResponse() );
    }
    
}

?>

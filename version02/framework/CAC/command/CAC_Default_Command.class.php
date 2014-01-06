<?php

/**
 * @author Revan
 */
class CAC_Default_Command extends CAC_Command {
    
    public function doExecute(CAC_Client_Request $http) {
        echo 'CAC_Default_Command:: Default Command Invoked';
    }
}

?>

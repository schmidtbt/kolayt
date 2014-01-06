<?php

/**
 * @author Revan
 */
class CAC_Noheaders_Controller extends CAC_Controller {
    
    protected function __construct(){}
    
    protected function handleHeaders(CAC_Response $response){
        $response->headers()->executeHeaders(true);
    }
    
}

?>

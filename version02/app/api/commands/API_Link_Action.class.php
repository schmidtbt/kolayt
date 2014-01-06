<?php

/**
 * 
 * @author Revan
 */
class API_Link_Action extends CAC_Command {
	
	public function doExecute(CAC_Client_Request $http) {
		
        $params = $http->getUrlParams();
        
        if( array_search('like', $params) ){
			
            echo 'attempting like';
			
		} elseif( array_search('upload', $params) ){
            
            echo 'attempting upload';
            
        }
	}
	
}

?>

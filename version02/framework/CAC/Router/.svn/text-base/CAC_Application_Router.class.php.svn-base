<?php

/**
 * @author Revan
 */
class CAC_Application_Router {
    
    /**
     *
     * @param CAC_Client_Request $http 
     * @return CAC_App_Map
     */
    public static function route( CAC_Client_Request $http ){
        
        $isWWW = true;
        
        $params = $http->getUrlParams();
        if( is_array( $params ) && sizeof( $params ) > 0 ){
            
            $keys = array_keys( $params );
            
            if(strcasecmp( 'api', $params[$keys[0]] ) === 0 ){
                $isWWW = false;
                $http->unsetURLParam('api');
            }
        }
        
        // Create switch conditions for different applications based upon client request
        if( $isWWW ){
            return new Kore_Web_Map();
        } else {
            return new Kore_Api_Map();
        }
        
    }
    
    
}

?>

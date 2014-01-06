<?php

/**
 * @author Revan
 */
class App_Params {
    
    public static function requireParams( array $sentParams, array $requiredParams ){
        
        $sentParamKeys = array_keys( $sentParams );
        
        foreach( $requiredParams as $param ){
            
            if( array_search( $param, $sentParamKeys ) === false ){
                throw new APP_MISSING_PARAMS('Missing Required Param');
            }
            
        }
        
        
    }
    
}

?>

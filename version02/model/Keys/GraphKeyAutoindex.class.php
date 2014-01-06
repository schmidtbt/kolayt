<?php

/**
 * @author Revan
 */
class GraphKeyAutoindex extends GraphKey {
    
    protected static $rowIndexes = array( 'urls' );
    
    
    public static function keyNormalize($keyString) {
        if( array_search( $keyString, static::$rowIndexes ) === false ){
            throw new GRAPH_LOGIC_EXCEPTION('Invalid Key for AutoIndex');
        }
        return parent::keyNormalize($keyString);
    }
    
    
}

?>

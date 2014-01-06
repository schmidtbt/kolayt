<?php

/**
 * @author Revan
 */
class GraphKeySHA256 extends GraphKey {
    
    public static function keyNormalize($keyString) {
        return hash( 'sha256', $keyString);
    }
    
}

?>

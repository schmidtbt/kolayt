<?php
/**
 * @author Revan
 */
class GraphKeySHA512 extends GraphKey {
    
    public static function keyNormalize($keyString) {
        return hash( 'sha512', $keyString );
    }
    
}

?>

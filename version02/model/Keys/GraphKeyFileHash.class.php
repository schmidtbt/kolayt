<?php

/**
 * @author Revan
 */
class GraphKeyFileHash extends GraphKey {
    
    public function __construct( $filePath , $isAuthoratative = false) {
        if( $isAuthoratative ){
            $hash = $filePath;
        } else {
            $hash = hash_file( 'sha256', $filePath );
        }
        parent::__construct( $hash, true );
    }
}

?>

<?php

/**
 * 
 * Example usage:
 * $autoIdx = new AutoIndexNode( new GraphKeyAutoindex(AutoIndexNode::TypeURL) );
 * 
 * @author Revan
 */
class AutoIndexNode extends Node {
    
    const TypeURL = 'urls';
    
    public function __construct( GraphKeyAutoindex $key) {
        parent::__construct($key);
    }
    
    /**
     * Returns a base 26 version of the counter
     * @return type 
     */
    public function getNextBase26Index(){
        $number = $this->incrementAttribute( 'index', 'auto' );
        return base_convert($number, 10, 26);
    }
    
    public function getNextIndex(){
        $number = $this->incrementAttribute( 'index', 'auto' );
        return $number;
    }
    
}

?>

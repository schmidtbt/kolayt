<?php

/**
 * 
 * @author Revan
 */
class ShortenerNode extends Node {
    
    public function getURLKey(){
        $value = $this->getAttributeValue( Node::NODE, 'url');
        return $value;
    }
    
    public function getNumClicks(){
        $value = $this->getAttribute( Node::NODE, 'numclicks' )->asCounter();
        return $value;
    }
    
    public function addClick(){
        $this->incrementAttribute( Node::NODE, 'numclicks' );
    }
    
    /// UTIL methods
    
    public function getURLNode(){
        $value = $this->getURLKey();
        return new URLNode( new GraphKeySHA256( $value, true ) );
    }
    
}

?>

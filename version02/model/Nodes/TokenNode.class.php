<?php
/**
 * 
 * @author Revan
 */
class TokenNode extends Node {
    
    public function getUserKey(){
        return $this->getAttributeValue( Node::NODE, 'userkey' );
    }
    
    public function deleteToken(){
        return $this->removeRow();
    }
    
}

?>

<?php
/**
 * 
 * @author Revan
 */
class EmailNode extends Node {
    
    public function getUserKey(){
        $value = $this->getAttributeValue( Node::NODE, 'user');
        return $value;
    }
    
    public function getUserNode(){
        $value = $this->getUserKey();
        return new UserNode( new GraphKey( $value, true ) );
    }
    
}

?>

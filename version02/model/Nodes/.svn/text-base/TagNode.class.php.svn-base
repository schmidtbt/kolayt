<?php

/**
 * 
 * @author Revan
 */
class TagNode extends Node {
    
    const TAG       = 'tag';
    const COUNTER   = 'counter';
    
    ///// GETS
    
    public function getDispName(){
        return $this->getAttributeValue( Node::NODE, 'tag' );
    }
    public function getNumFollowers(){
        return $this->getAttribute( Node::NODE, 'followers' )->asCounter();
    }
    public function getNumPages(){
        return $this->getAttribute( Node::NODE, 'usages' )->asCounter();
    }
    
    ///// MODS
    
    public function addTagUsage(){
        $this->incrementAttribute( Node::NODE, 'usages' );
    }
    public function addFollower(){
        $this->incrementAttribute( Node::NODE, 'followers' );
    }
    public function removeFollower(){
        $this->incrementAttribute( Node::NODE, 'followers', -1 );
    }
    
}

?>

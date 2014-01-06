<?php

/**
 * @author Revan
 */
class UserTagEdge extends UserEdge {
    
    public function delete(){
        $this->to()->removeFollower();
        $tagUser = new TagUserEdge( $this->to(), $this->from() );
        $tagUser->delete();
        $this->removeRow();
    }
    
    public function getTagKey(){
        return $this->getAttributeValue(Edge::TONODE,    'tag');
    }
    
    protected function setTo( TagNode $to ) {
        parent::setTo($to);
    }
    public static function generate( $fromKey, $toKey, $label = '' ) {
        $from       = new UserNode( new GraphKey( $fromKey, true ) );
        $to         = new TagNode( new GraphKeySHA256( $toKey, true) );
        return new UserTagEdge( $from, $to, $label );
    }
    protected static function executeCreate( UserNode $from, TagNode $to, $label = '') {
        
        $key = static::assembleKey( $from, $to, $label );
        
        $updater = static::gStorage(__CLASS__)->create()->createRow($key);
        
        $updater->add( Edge::FROMNODE,  'user', $from->getKeyString() );
        $updater->add( Edge::TONODE,    'tag',  $to->getKeyString() );
        
        $updater->update($key);
        
        TagUserEdge::create($to, $from);
        
        $to->addFollower();
        
        $class = __CLASS__;
        return new $class( $from, $to );
        
    }
    
}

?>

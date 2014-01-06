<?php

/**
 * @author Revan
 */
class TagTagEdge extends TagEdge {
    
    
    public function incrementStrength(){
        $this->incrementAttribute( Edge::EDGE, 'strength' );
    }
    
    
    protected function setTo(TagNode $to) {
        parent::setTo($to);
    }
    public static function generate($fromKey, $toKey, $label ) {
        $from    = new TagNode( new GraphKey( $fromKey, true ) );
        $to      = new TagNode( new GraphKey( $toKey, true ) );
        return new TagTagEdge( $from, $to, $label );
    }
    protected static function executeCreate(TagNode $from, TagNode $to ) {
        
        $key = static::assembleKey( $from, $to );
        
        $updater = static::gStorage(__CLASS__)->create()->createRow($key);
        
        $updater->add( Edge::FROMNODE, 'tag',   $from->getKeyString() );
        $updater->add( Edge::TONODE, 'tag',     $to->getKeyString() );
        
        $updater->update($key);
        
        $class = __CLASS__;
        return new $class( $from, $to );
        
    }
    
}

?>

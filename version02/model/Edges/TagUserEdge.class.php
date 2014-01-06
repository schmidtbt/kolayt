<?php

/**
 * @author Revan
 */
class TagUserEdge extends TagEdge {
    
    public function delete(){
        $this->removeRow();
    }
    
    protected function setTo( UserNode $to) {
        parent::setTo($to);
    }
    public static function generate($fromKey, $toKey ) {
        $from    = new TagNode( new GraphKey( $fromKey, true ) );
        $to      = new UserNode( new GraphKey( $toKey, true ) );
        return new TagUserEdge( $from, $to );
    }
    protected static function executeCreate(TagNode $from, UserNode $to ) {
        
        $key = static::assembleKey( $from, $to );
        
        $updater = static::gStorage(__CLASS__)->create()->createRow($key);
        
        $updater->add( Edge::FROMNODE, 'tag',   $from->getKeyString() );
        $updater->add( Edge::TONODE, 'user',     $to->getKeyString() );
        
        $updater->update($key);
        
        $class = __CLASS__;
        return new $class( $from, $to );
        
    }
    
}

?>

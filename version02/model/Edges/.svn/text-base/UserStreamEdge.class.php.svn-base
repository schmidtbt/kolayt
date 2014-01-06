<?php

/**
 * @author Revan
 */
class UserStreamEdge extends UserEdge {
    
    public function delete(){
        $this->removeRow();
    }
    
    protected function setTo(URLNode $to) {
        parent::setTo($to);
    }
    
    public static function generate($fromKey, $toKey, $label = '' ) {
        $from    = new UserNode( new GraphKey( $fromKey, true ) );
        $to      = new URLNode( new GraphKeySHA256($toKey, true) );
        return new UserStreamEdge( $from, $to, $label );
    }
    
    protected static function executeCreate( UserNode $from, URLNode $to ) {
        
        $key = static::assembleKey( $from, $to );
        
        $updater = static::gStorage(__CLASS__)->create()->createRow($key);
        $updater->add( Edge::EDGE,          'exists',   'true' );
        $updater->update($key);
        
        return true;
    }
    
}

?>

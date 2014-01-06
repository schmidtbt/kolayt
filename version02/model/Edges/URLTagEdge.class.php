<?php

/**
 * @author Revan
 */
class URLTagEdge extends URLEdge implements iAtomic {
    
    
    
    
    public function getTagKey(){
        return $this->getAttributeValue( Edge::TONODE, 'tag' );
    }
    
    ///// ATOMIC LOCKOUT SYSTEM
    public function getExpiration(){
        return $this->getAttributeValue( GraphEntity::LOCKOUT, 'expires' );
    }
    public function currentIntervalIndex(){
        return $this->getAttributeValue( GraphEntity::LOCKOUT, 'index' );
    }
    public function counterOne(){
        return $this->getAttributeValue( GraphEntity::LOCKOUT, 'count1' );
    }
    public function counterTwo(){
        return $this->getAttributeValue( GraphEntity::LOCKOUT, 'count2' );
    }
    public function setExpiration( $unixTime ){
        return $this->modAttribute( GraphEntity::LOCKOUT , 'expires',  $unixTime );
    }
    public function setIntervalIndex( $index ){
        return $this->modAttribute( GraphEntity::LOCKOUT , 'index',  $index );
    }
    public function incrementAtomicCounter( $idx, $step = 1 ){
        if(  !( $idx === 0 || $idx === 1 ) ){ throw new GRAPH_EXCEPTION('Bad Atomic Index Number'); }
        return $this->incrementAttribute( GraphEntity::LOCKOUT, 'count'.$idx, $step );
    }
    ///// END ATOMIC LOCKOUT SYSTEM
    
    
    
    protected function setTo(TagNode $to) {
        parent::setTo($to);
    }
    public static function generate($fromKey, $toKey) {
        $urlNode    = new URLNode( new GraphKeySHA256( $fromKey, true ) );
        $tagNode    = new TagNode( new GraphKey( $toKey, true) );
        return new URLTagEdge( $urlNode, $tagNode );
    }
    protected static function executeCreate(URLNode $url, TagNode $tag, $label = '') {

        $key = static::assembleKey( $url, $tag );
        
        $updater = static::gStorage(__CLASS__)->create()->createRow($key);

        $updater->add( Edge::FROMNODE, 'urlkey', $url->getKeyString() );
        $updater->add( Edge::TONODE, 'tag', $tag->getDispName() );

        $updater->update($key);

        return new URLTagEdge( $url, $tag );
        
    }
    
}

?>

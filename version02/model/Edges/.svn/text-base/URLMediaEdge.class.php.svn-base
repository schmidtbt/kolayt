<?php

/**
 * @author Revan
 */
class URLMediaEdge extends URLEdge {
    
    public function getMediaKey(){
        return $this->getAttributeValue( Edge::TONODE, 'media');
    }
    
    
    protected function setTo( MediaNode $to ) {
        parent::setTo($to);
    }
    public static function generate($fromKey, $toKey) {
        $urlNode    = new URLNode( new GraphKeySHA256( $fromKey, true ) );
        $mediaNode  = new MediaNode( new GraphKeyFileHash( $toKey, true) );
        return new URLMediaEdge( $urlNode, $mediaNode );
    }
    protected static function executeCreate(URLNode $url, MediaNode $media, $label = '') {

        $key = static::assembleKey( $url, $media );
        
        $updater = static::gStorage(__CLASS__)->create()->createRow($key);

        $updater->add( Edge::FROMNODE, 'urlkey', $url->getKeyString() );
        $updater->add( Edge::TONODE, 'media', $media->getKeyString() );

        $updater->update($key);

        $class = __CLASS__;
        return new $class( $url, $media );
        
    }
    
}

?>

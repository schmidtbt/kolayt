<?php

/**
 * @author Revan
 */
class MediaURLEdge extends MediaEdge {
    
    public function getMediaKey(){
        return $this->getAttributeValue( Edge::FROMNODE, 'media');
    }
    
    public static function assembleKey(Node $from, Node $to, $label = '') {
        if( $label === '' ){
            return parent::assembleKey( $from, $to, GraphKey::invertTime(time()) );
        } else {
            return parent::assembleKey( $from, $to, $label);
        }
    }
    protected function setTo( URLNode $to ) {
        parent::setTo($to);
    }
    public static function generate($fromKey, $toKey, $label ) {
        $mediaNode  = new MediaNode( new GraphKeyFileHash( $fromKey, true) );
        $urlNode    = new URLNode( new GraphKeySHA256( $toKey, true ) );
        return new MediaURLEdge( $mediaNode, $urlNode, $label );
    }
    protected static function executeCreate( MediaNode $media, URLNode $url, $label = '') {

        $key = static::assembleKey( $media, $url );
        $updater = static::gStorage(__CLASS__)->create()->createRow($key);
        $updater->add( Edge::FROMNODE, 'media', $media->getKeyString() );
        $updater->add( Edge::TONODE, 'urlkey', $url->getKeyString() );
        $updater->update($key);

        $class = __CLASS__;
        return new $class( $media, $url );
        
    }
    
}

?>

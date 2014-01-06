<?php

/**
 * 
 * @author Revan
 */
class MediaImageNode extends MediaNode {
    
    public function __construct() {}
    
    public function getOriginalSourceURL(){
        return $this->getAttributeValue( Node::NODE , 'origsource' );
    }
    public function getThumbPath(){
        return $this->getAttributeValue( Node::NODE , 'thumb' );
    }
    public function getFullPath(){
        return $this->getAttributeValue( Node::NODE , 'full' );
    }
    /**
     * For now, CDN version is the source link
     */
    public function getCDNURL(){
        return $this->getOriginalSourceURL();
    }
}

?>

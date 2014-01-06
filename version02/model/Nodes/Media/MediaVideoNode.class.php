<?php

/**
 * 
 * @author Revan
 */
class MediaVideoNode extends MediaNode {
    
    public function __construct() {}
    
    public function getProvider(){
        return $this->getAttributeValue( Node::NODE, 'vidtype' );
    }
    public function getEmbedURL() {
        return $this->getAttributeValue( Node::NODE, 'embed' );
    }
    public function getImgURL(){
        return $this->getAttributeValue( Node::NODE, 'vidimg' );
    }
    public function getVidKey(){
        return $this->getAttributeValue( Node::NODE, 'vidkey' );
    }
    public function getThumbPath(){
        return $this->getImgURL();
    }
    
}

?>

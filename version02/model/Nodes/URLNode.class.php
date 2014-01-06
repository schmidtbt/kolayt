<?php

/**
 * 
 * @author Revan
 */
class URLNode extends Node {
    
    const HTML = 'html';
    
    /**
     * Enforce the SHA256 Key for this structure
     * @param GraphKeySHA256 $key 
     */
    public function __construct( GraphKeySHA256 $key ) {
        parent::__construct($key);
    }
    
    
    //// URL
    public function getTitle(){
        return strlen( $this->getOGTitle() ) > 0 ? $this->getOGTitle() : $this->getReTitle();
    }
    public function getOGTitle(){
        return $this->getAttributeValue( Node::NODE, 'ogtitle' );
    }
    public function getReTitle(){
        return $this->getAttributeValue( Node::NODE, 'retitle' );
    }
    
    public function getURLLink(){
        return $this->getAttributeValue( Node::NODE, 'url' );
    }
    public function getDomain(){
        return $this->getAttributeValue( Node::NODE, 'domain' );
    }
    public function getShortIdx(){
        return $this->getAttributeValue( Node::NODE, 'shortidx' );
    }
    
    public function getOGDescribe(){
        return $this->getAttributeValue( Node::NODE, 'ogdescribe' );
    }
    
    public function incrementViews(){
        $this->incrementAttribute( Node::NODE, 'views' );
    }
    public function getNumberViews(){
        return $this->getAttribute( Node::NODE, 'views' )->asCounter();
    }
    
    
    //// HTML
    public function getRawHTML(){
        return $this->getAttributeValue( URLNode::HTML, 'raw' );
    }
    public function getReadabilityHTML(){
        return $this->getAttributeValue( URLNode::HTML, 'readparsed' );
    }
    public function getShortDescription(){
        return $this->getAttributeValue( Node::NODE, 'short' );
    }
    
    
    public static function stripDescription( $parsedHTML, $maxSize = 550 ){
        $content = strip_tags( $parsedHTML);
        $content = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $content);
        $content = ereg_replace(" {2,}", ' ',$content);
        if( strlen( $content ) > $maxSize ){
            $content = substr( $content, 0, $maxSize );
        }
        return $content;
    }
}

?>

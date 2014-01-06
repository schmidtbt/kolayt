<?php

/**
 * @author Revan
 */
class TagURLEdge extends TagEdge implements iURLEntityEdge {
    
    public function getMediaType(){
        return $this->getAttributeValue( Edge::TONODE, 'media_type' );
    }
    
    public function getMediaData(){
        
        $array = array();
        
        switch( $this->getMediaType() ){
            case "none":
                $array['type'] = 'none';
                break;
            case "img":
                $array['type'] = 'img';
                $array['thumb'] = $this->getImg();
                $array['full'] = $this->getFullImg();
                break;
            case "vid":
                $array['type'] = 'vid';
                $array['thumb'] = $this->getImg();
                $array['embed'] = $this->getEmbedLink();
                $array['vidkey'] = $this->getVideoKey();
                $array['provider'] = $this->getVidProvider();
                break;
            default:
                break;
        }
        
        return $array;
        
    }
    public function getImg(){
        return $this->getAttributeValue( Edge::TONODE, 'media_img' );
    }
    public function getFullImg(){
        return $this->getAttributeValue( Edge::TONODE, 'media_img_full' );
    }
    public function getVidProvider(){
        return $this->getAttributeValue( Edge::TONODE, 'media_provider' );
    }
    public function getEmbedLink(){
        return $this->getAttributeValue( Edge::TONODE, 'media_embed' );
    }
    public function getShortIdx(){
        return $this->getAttributeValue( Edge::TONODE, 'shortidx' );
    }
    public function getMediaThumb(){
        return $this->getAttributeValue( Edge::TONODE, 'media' );
    }
    public function getOGDescribe(){
        return $this->getAttributeValue( Edge::TONODE, 'ogdescribe' );
    }
    public function getTag(){
        return $this->getAttributeValue( Edge::FROMNODE, 'tag' );
    }
    public function getTitle(){
        return $this->getAttributeValue( Edge::TONODE, 'title' );
    }
    public function getDomain(){
        return $this->getAttributeValue( Edge::TONODE, 'host' );
    }
    public function getVideoKey(){
        return $this->getAttributeValue( Edge::TONODE, 'vidkey' );
    }
    
    public static function assembleKey(Node $from, Node $to, $label = '') {
        if( $label === '' ){
            return parent::assembleKey( $from, $to, GraphKey::invertTime(time()) );
        } else {
            return parent::assembleKey( $from, $to, $label);
        }
        
    }
    protected function setTo(URLNode $to) {
        parent::setTo($to);
    }
    public static function generate($fromKey, $toKey, $label ) {
        $tagNode    = new TagNode( new GraphKey( $fromKey, true ) );
        $urlNode    = new URLNode( new GraphKeySHA256( $toKey, true) );
        return new TagURLEdge( $tagNode, $urlNode, $label );
    }
    protected static function executeCreate(TagNode $tag, URLNode $url, $label = '') {
        
        $key = static::assembleKey( $tag, $url );
        
        $updater = static::gStorage(__CLASS__)->create()->createRow($key);
        
        $updater->add( Edge::FROMNODE, 'tag', $tag->getDispName() );
        
        App_List_Data::generateTagListEntry( $updater, $url );
        
        $updater->update($key);
        
        $class = __CLASS__;
        return new $class( $tag, $url );
        
    }
    
}

?>

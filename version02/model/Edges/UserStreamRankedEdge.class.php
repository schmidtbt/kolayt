<?php

/**
 * @author Revan
 */
class UserStreamRankedEdge extends UserEdge implements iURLEntityEdge {
    
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
    
    
    
    public static function assembleKey(Node $from, Node $to, $label = '') {
        
        $fromKeyString  = $from->getKeyString();
        $toKeyString    = $to->getKeyString();
        if( $label == '' ){
            $key = GraphKey::assemble( array( $fromKeyString, GraphKey::invertTime(time()), $toKeyString ) );
        } else {
            $key = GraphKey::assemble( array( $fromKeyString, $label, $toKeyString ) );
        }
        return $key;
        
    }
    
    protected function setTo(URLNode $to) {
        parent::setTo($to);
    }
    
    public static function generate($fromKey, $toKey, $label = '' ) {
        $from    = new UserNode( new GraphKey( $fromKey, true ) );
        $to      = new URLNode( new GraphKeySHA256($toKey, true) );
        return new UserStreamRankedEdge( $from, $to, $label );
    }
    
    protected static function executeCreate( UserNode $from, URLNode $to ) {
        
        // Try to create a new relation between these two for this user. If exists,
        // throw error and stop system
        UserStreamEdge::create( $from, $to );
        
        $key = static::assembleKey( $from, $to );
        
        $updater = static::gStorage(__CLASS__)->create()->createRow($key);
        $updater->add( Edge::FROMNODE,          'user',   $from->getKeyString() );
        
        App_List_Data::generateTagListEntry( $updater, $to );
        
        $updater->update($key);
        
        return true;
    }
    
    
    
}

?>

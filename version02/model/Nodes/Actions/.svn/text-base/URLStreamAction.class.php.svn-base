<?php

/**
 * @author Revan
 */
class URLStreamAction extends Action {
    
    protected $_short;
    protected $_title;
    protected $_key;
    
    public function __construct( $key, $title, $short ) {
        $this->_key = $key;
        $this->_title = $title;
        $this->_short = $short;
    }
    
    public static function create( URLNode $url ){
        return new URLStreamAction( $url->getKeyString(), $url->getTitle(), $url->getOGDescribe() );
    }
    
    public function update( HBase_Update $updater ){
        
        $updater->add( GraphEntity::ACTION,     'type',     get_class() );
        $updater->add( GraphEntity::ACTION,     'title',    $this->_title );
        $updater->add( GraphEntity::ACTION,     'short',    $this->_short );
        $updater->add( GraphEntity::ACTION,     'key',      $this->_key );
        return $updater;
    }
    
    public function getShort(){
        return $this->_short;
    }
    public function getTitle(){
        return $this->_title;
    }
    public function getKey(){
        return $this->_key;
    }
}

?>

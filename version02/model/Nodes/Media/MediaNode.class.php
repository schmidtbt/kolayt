<?php

/**
 * 
 * @author Revan
 */
class MediaNode extends Node {
    
    const HISTORY = 'history';
    
    public function __construct( GraphKey $key) {
        parent::__construct($key);
    }

    public function getSubType(){
        
        switch( $this->getType() ){
            
            case 'MediaImageNode':
                $return = new MediaImageNode();
                break;
            case 'MediaVideoNode':
                $return = new MediaVideoNode();
                break;
            case 'avatar':
                $return = new MediaImageAvatarNode();
                break;
            default:
                throw new GRAPH_COMPLIANCE_EXCEPTION( 'Invalid Media Sub-Type:'.$this->getType() );
        }
        
        $return->setRecordData( $this->_recordData );
        $return->setKey( $this->_key );
        
        return $return;
        
    }
    
    public function getType(){
        return $this->getAttributeValue( Node::NODE , 'type' );
    }
    
    public function getEmbedURL(){
        return $this->getAttributeValue( Node::NODE , 'embedurl' );
    }
    
    /**
     * This fetches the primary URL associated with this link 
     */
    public function getAssocURL(){
        return $this->getAttributeValue( Node::NODE , 'url' );
    }
    
    public function getAllURLS(){}
    public function addNewAssocURL( Pipe_URL $url ){}
}

?>

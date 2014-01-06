<?php

/**
 * @author Revan
 */
class GraphKeyDomain extends GraphKey {
    
    
    protected $_domain;
    
    public function __construct( Pipe_Domain $domain) {
        parent::__construct($domain->getPrimaryAndTLDAddress() );
        $this->_domain = $domain;
    }
    
    public function getDomain(){
        return $this->_domain;
    }
    
    public static function keyNormalize( $keyString ) {
        return parent::keyNormalize($keyString);
    }
    
    
}

?>

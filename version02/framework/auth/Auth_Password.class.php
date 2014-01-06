<?php

/**
 * @author Revan
 */
class Auth_Password {
    
    protected $_passHash;
    
    /**
     * Hashed password
     * @param type $passHash 
     */
    public function __construct( $passHash ) {
        $this->_passHash = $passHash;
    }
    public function getHash(){
        return $this->_passHash;
    }
    
    public function isValid( Auth_Password $testPass ){
        return $this->isEqual( $testPass->getHash() );
    }
    public function isEqual( $testPasswordHash ){
        if( $testPasswordHash === $this->_passHash ){
            return true;
        } else {
            return false;
        }
    }
    public static function hash( $rawPassword ){
        return hash( 'sha256', $rawPassword );
    }
    /**
     * Give Raw, un-hashed password
     * @param type $rawPassword
     * @return \Auth_Password 
     */
    public static function genereate( $rawPassword ){
        return new Auth_Password( static::hash($rawPassword));
    }
    
}

?>

<?php

/**
 * @author Revan
 */
class Auth_Token {
    
    protected $tokenString;
    
    public function __construct( $tokenString ){
        $this->tokenString = $tokenString;
    }
    public function string(){
        return $this->tokenString;
    }
    public static function generateToken(){
        $value = rand(1, 10000) * rand(1, 55);
        $value += time();
        $value .= time();
        $str    = hash( 'sha256', $value );
        return new Auth_Token( $str );
    }
    
}

?>

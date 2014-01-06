<?php
/**
 * @ingroup ModelIf
 */
class Kore_Domain_Token implements iKore_Domain_Token {
	
	protected static $encrString = "awlskjj239a02";
	protected static $IV = "23456783";
	
	public static function genTokenFromHandle( $handle ){
		$ip = $_SERVER['REMOTE_ADDR'];
			
		return openssl_encrypt( $ip .'.'. $handle .'.'. time(), 'aes256', static::$encrString, false, static::strtohex( static::$IV ) );
	}
	
	/**
	 * @return FALSE on failure
	 */
	public static function convertTokenToHandle( $token ){
		return openssl_decrypt( $token, 'aes256', static::$encrString, false, static::strtohex( static::$IV ) );
	}
	
	public static function validateToken( $token, $email ){}
	
	public static function strtohex($x) 
    {
        $s='';
        foreach (str_split($x) as $c) $s.=sprintf("%02X",ord($c));
        return($s);
    } 
	
}

?>
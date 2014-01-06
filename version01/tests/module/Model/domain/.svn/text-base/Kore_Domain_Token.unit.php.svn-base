<?php
require_once('Kore_autoload.php');
require_once('autorun.php');

class unit_Kore_Domain_Token extends UnitTestCase {
	
	function test_Token(){
		$str = Kore_Domain_Token::genTokenFromHandle( 'Revan' );
		echo $str . "<br />";
		echo Kore_Domain_Token::convertTokenToHandle( $str );
	}
}
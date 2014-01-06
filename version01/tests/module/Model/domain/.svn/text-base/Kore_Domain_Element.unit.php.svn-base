<?php
require_once('Kore_autoload.php');
require_once('autorun.php');

class unit_Kore_Domain_Element extends UnitTestCase {
	
	function test_Element(){
		$e = new Kore_Domain_Element();
		$url = new Kore_Domain_URL();
		$url->fetchURL( 'http://techcrunch.com/2012/01/15/things-entrepreneurs-should-avoid-when-raising-capital/' );
		
		$s = new Kore_Domain_Section();
		$s->getSectionMain( 'Default' );
		
		$user = new Kore_Domain_User();
		$user->loginByHandlePassword ('Revan', 'Pass');
		//$e->newElement( $user, $url, $s );
	}
	
	function test_get_element(){
		$e = new Kore_Domain_Element();
		var_dump( $e->fetchElement( 'Default', 'http://techcrunch.com/2012/01/15/things-entrepreneurs-should-avoid-when-raising-capital/' ) );
		echo $e->getTitle();
		echo $e->getSectionName() . "<br />";
		var_dump( $e->hasThumb() );
		var_dump( $e->getThumbEmbed() );
		echo $e->getCreated();
	}
	
}
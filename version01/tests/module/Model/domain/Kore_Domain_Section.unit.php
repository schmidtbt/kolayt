<?php
require_once('Kore_autoload.php');
require_once('autorun.php');

class unit_Kore_Domain_Section extends UnitTestCase {
	
	function test_Section(){
		$s = new Kore_Domain_Section();
	}
	
	function test_section_create(){
		$s = new Kore_Domain_Section();
		//$s->newSection( "Default", new Kore_Domain_User() );
		
		
		var_dump( $s->getSectionMain( "Default" ) );
		//echo $s->getCreatedAt();
		$s->addSubscriber() . ' ';
		$s->addSubscriber() . ' ';
		$s->removeSubscriber();
		var_dump( $s->getNumberOfSubscribers() );
	}
	
	function test_new_section(){
		$s = new Kore_Domain_Section();
		//$user = new Kore_Domain_User();
		//$user->loginByHandlePassword( "Revan" , "pass" );
		//$s->newSection( "Default2", $user );
	}
}

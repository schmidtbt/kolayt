<?php
require_once('Kore_autoload.php');
require_once('autorun.php');

class unit_Kore_Domain_User extends UnitTestCase {
	
	
	function test_Domain_User(){
		$du = new Kore_Domain_User();
		$this->assertTrue( $du->loginByHandlePassword( 'Revan' , 'Pass' ) );
	}
	
	
	function test_section_list(){
		$du = new Kore_Domain_User();
		$du->loginByHandlePassword( 'Revan' , 'Pass' );
		$secList = $du->getSectionList();
		var_dump( $secList );
		var_dump( $du->addSectionToList( 'My_New_Section4' ) );
		$secList = $du->getSectionList();
		var_dump( $secList );
		var_dump( $du->removeSectionFromList( 'My_New_Section3' ) );
		
		$du->setToken( 'newToken' );
	}
	
	function test_new_user_exists(){
		$du = new Kore_Domain_User();
		//$this->expectException('Kore_Domain_User_Exception');
		//$du->newUser( '', '', '', 'Revan' );
	}
	
	function test_new_user(){
		$du = new Kore_Domain_User();
		//$du->newUser( 'schmidt.bt@gmail.com', 'Benjy', 'Schmidt', 'Revan3' );
	}
	
	function test_token_login(){
		$du =  new Kore_Domain_User();
		var_dump( $du->loginByToken( 'y1/e0pTyM4me5yrwvAF3zg==' ) );
	}
	
	function test_meta_values(){
		$du = new Kore_Domain_User();
		$du->loginByHandlePassword( 'Revan' , 'Pass' );
		echo $du->getHandle();
		echo $du->getEmailAddress();
		echo $du->getHandle();
		echo $du->getFirst();
		echo $du->getLast();
	}
	
	
}

?>
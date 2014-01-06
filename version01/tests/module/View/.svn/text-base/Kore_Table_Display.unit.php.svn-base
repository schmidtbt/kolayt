<?php
require_once('Kore_autoload.php');
require_once('autorun.php');

class unit_Kore_Table_Display extends UnitTestCase {
	
	function test_table(){
		$t = new Kore_Table_Display();
		$t->generate();
		//$t->disp();
	}
	
	function test_populate(){
		
		$section = new Kore_Domain_Section();
		$section->getSectionMain( "Default" );
		
		$sl = new Kore_Domain_Section_List( $section );
		$sl->setOrder( Kore_Domain_Section_List::TIMEORDER )->getElements( 50 );
		//$sl->setOrder( Kore_Domain_Section_List::SCOREORDER );
		
		
		$t = new Kore_Table_Display( 3,2, 2, 30);
		$t->generate();
		$t->setElementWeights( $sl );
		$t->overlayContent();
		echo $t->testStyle()->disp();
	}
}

?>
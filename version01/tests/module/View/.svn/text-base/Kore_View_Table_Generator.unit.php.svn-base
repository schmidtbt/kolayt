<?php
require_once('Kore_autoload.php');
require_once('autorun.php');

class unit_Kore_View_Table_Generator extends UnitTestCase {
	
	function test_table(){
		
		$section = new Kore_Domain_Section();
		$section->getSectionMain( "Default" );
		
		$sl = new Kore_Domain_Section_List( $section );
		$elements = $sl->setOrder( Kore_Domain_Section_List::TIMEORDER )->getElements( 50 );
		
		
		$tvg = new Kore_View_Table_Generator( $sl );
		//$tvg->setElementWeights( $sl );
		
		$sl->setOrder( Kore_Domain_Section_List::SCOREORDER );
		$tvg->setElementWeights( $sl );
	}
	
}

?>
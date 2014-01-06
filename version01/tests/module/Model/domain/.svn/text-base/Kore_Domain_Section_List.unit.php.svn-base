<?php
require_once('Kore_autoload.php');
require_once('autorun.php');

class unit_Kore_Domain_Section_List extends UnitTestCase {
	
	function test_Section_List(){
		
		$section = new Kore_Domain_Section();
		$section->getSectionMain( "Default" );
		
		$sl = new Kore_Domain_Section_List( $section );
		$elements = $sl->setOrder( Kore_Domain_Section_List::TIMEORDER )->getElements( 5 );
		// Returns array of elements
		$this->assertTrue( ! empty($elements ),						"Elements should be populated from storage" );
		// Returns populated
		$this->assertTrue( $sl->isPopulated(),						"Should now return that it is populated" );
		$this->assertTrue( $sl->getNumberElements() === 5,			"Returns 5 elements"  );
		$this->assertTrue( $sl->isOrganizedByTime(), 				"Should be oranized by time" );
		$this->assertFalse( $sl->isOrganizedByScore(), 				"Should not be oranized by score" );
		$this->assertTrue( $sl->elementList() instanceof IterElementList, "Returns a IterElementList" );
		
	}
	
}



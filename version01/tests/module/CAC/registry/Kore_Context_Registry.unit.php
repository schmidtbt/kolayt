<?php
require_once('Kore_autoload.php');
require_once('autorun.php');

class unit_Context_Registry extends UnitTestCase {
	
	function test_Context(){
		// Test code here
		$req = Kore_Context_Registry::ctxt();
		$this->assertTrue( $req instanceof Kore_Context );
	}
	
}

?>

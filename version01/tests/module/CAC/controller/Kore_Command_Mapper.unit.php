<?php
require_once('Kore_autoload.php');
require_once('autorun.php');

class unit_Command_Mapper extends UnitTestCase {
	
	function test_Command_Mapper(){
		$ctxt = Kore_Context_Registry::ctxt();
		$ctxt->setProperty('method', 'method2');
		var_dump( Kore_Command_Mapper::getCommand( $ctxt ) );
		echo $ctxt->getMessageString();
		
	}
	
}

?>

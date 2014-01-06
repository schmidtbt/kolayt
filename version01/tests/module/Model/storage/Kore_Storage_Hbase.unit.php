<?php
require_once('Kore_autoload.php');
require_once('autorun.php');

class unit_Kore_Storage_Hbase extends UnitTestCase {
	
	function test_Storage_Hbase(){
		$shbase = new Kore_Storage_Hbase();
		$shbase->setTable( 'temp_table' );
		$result = ( $shbase->fetchRecordValueOnKey( 'row-2' ) );
		var_dump( $result[0]->columns );
	}
	
}

?>

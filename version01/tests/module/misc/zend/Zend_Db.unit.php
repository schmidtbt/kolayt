<?php
require_once('autoload.php');
require_once('autorun.php');

class unit_Zend_db extends UnitTestCase {
	
	function test_zend_db(){
		
		$db = new Zend_Db_Adapter_Pdo_Mysql( array(
			'host' => 'localhost',
			'username' => 'root',
			'password' => '',
			'dbname' => 'index_feed'
		));
		$db->setFetchMode( Zend_Db::FETCH_OBJ );
		$result = $db->fetchAll( 'SELECT * FROM feeds WHERE feeds_idx = ?', 2);
		//var_dump( $result ); 
		
		$obj = ( $result[0] );
		//echo $obj->feeds_idx;
		
		
		
	}
	
	function test_data(){
		
		$u = new Kore_User();
		$u->userName( 'Benjamin Schmidt' );
		var_dump( $u->userName() );
		
	}
	
	
	function test_zend_s3_file(){
		$s3 = new Zend_Service_Amazon_S3("AKIAIZXAK3UGYV7DS5MA", "qP5vLitlbuKO7Jl7id0r61oSJa17OIGw39/OEjVN");
		$s3->registerStreamWrapper();
		
		$contents = file_get_contents('s3://kolayt.udata/0_1');
		echo $contents;
	}
	
	
}

?>

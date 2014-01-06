<?php
require_once('autoload.php');
require_once('autorun.php');

class unit_s3 extends UnitTestCase {
	
	function test_s3 (){
		new AmazonS3();
	}
	
}

?>
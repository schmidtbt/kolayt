<?php
require_once('Kore_autoload.php');
require_once('autorun.php');

class unit_HTTP_Request extends UnitTestCase {
	
	function test_HTTP_Request(){
		new Kore_HTTP_Request();
	}
	
	function test_get_method(){
		// Returns string HTTP method
		$req = new Kore_HTTP_Request();
		$this->assertTrue( is_string( $req->httpMethod() ) );
	}
	
	function test_cookies(){
		// Returns an array
		$req = new Kore_HTTP_Request();
		$this->assertTrue( is_array( $req->getCookies() ) );
	}
	
	function test_url_params(){
		// Returns an array
		$req = new Kore_HTTP_Request();
		$this->assertTrue( is_array( $req->getUrlParams() ) );
	}
	
	function test_post_data(){
		// Returns an array
		$req = new Kore_HTTP_Request();
		$this->assertTrue( is_array( $req->getPostData() ) );
	}
	
}

?>

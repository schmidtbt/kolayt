<?php
require_once('Kore_autoload.php');
require_once('autorun.php');

class unit_Context extends UnitTestCase {
	
	function test_Context(){
		// Test code here
		$req = new Kore_Context();
	}
	
	function test_Context_HTTP_Request(){
		// Returns Kore_HTTP_Request
		$ctxt = new Kore_Context();
		$this->assertTrue( $ctxt->httpRequest() instanceof Kore_HTTP_Request );
	}
	
	function test_add_Command(){
		// Returns array
		$ctxt = new Kore_Context();
		$ctxt->addToCommandStack( '0', new log_cmd() );
		$this->assertTrue( is_array( $ctxt->getCommandStack() ) );
	}
	
	function test_add_object(){
		// Returns object by key
		$ctxt = new Kore_Context();
		$ctxt->setObject( 'key', new stdClass() );
		$this->assertTrue( $ctxt->getObject( 'key' ) instanceof stdClass );
	}
	
	function test_messages(){
		// saved messages are stored
		$ctxt = new Kore_Context();
		$ctxt->setMessage( 'New Message' );
		$this->assertTrue( is_array( $ctxt->getMessages() ) );
		$this->assertTrue( is_string( $ctxt->getMessageString() ) );
	}
	
	function test_properties(){
		// Set and get values are same
		$ctxt = new Kore_Context();
		$ctxt->setProperty(  'key', 'myvalue' );
		$this->assertEqual( $ctxt->getProperty( 'key' ), 'myvalue' );
	}
	
	function test_override_property(){
		// Internal message set when overriding value
		$ctxt = new Kore_Context();
		$ctxt->setProperty( 'key', 'myvalue' );
		$ctxt->setProperty( 'key', 'myvalue2' );
		$this->assertEqual( $ctxt->getProperty( 'key' ), 'myvalue2' );
		$this->assertTrue( $ctxt->getMessageString() !== "" );
	}
	
	function test_override_object(){
		// Internal message set when overriding value
		$ctxt = new Kore_Context();
		$ctxt->setObject( 'key', 'myvalue' );
		$ctxt->setObject( 'key', 'myvalue2' );
		$this->assertEqual( $ctxt->getObject( 'key' ), 'myvalue2' );
		$this->assertTrue( $ctxt->getMessageString() !== "" );
	}
	
	function test_view(){
		$ctxt = new Kore_Context();
		$ctxt->setView( 'NewView' );
		$view = $ctxt->getView();
		$this->assertEqual( 'NewView', $view );
	}
}

?>

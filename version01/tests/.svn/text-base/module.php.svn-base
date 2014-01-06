<?php

ob_start();
session_save_path('/tmp');
session_start();
error_reporting(E_ALL ^ E_DEPRECATED);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
require_once('autoload.php');
require_once('simpletest/autorun.php');

//require_once('autoload.php');

/**
 * @note These modules are referenced from the server root's /coretest directory, not from the
 * directory within the /php/includes module. This means that changes there must either be updated
 * to the SVN or copied over before they'll be reflected in the testing suites.
 * 
 */
 
class alltests extends TestSuite {
    function __construct() {
        
        // call the parent constructor of the simpletest module
        parent::__construct();
		$module = isset( $_GET['mod'] ) ? $_GET['mod'] : 'domain/Kore_Feed';
		
		$modulePath = $_SERVER{'DOCUMENT_ROOT'} . '/kore/trunk/unit/module/';
		$executionFile = $module . '.unit.php';
		print( $executionFile . '   ');
		
		// Sanity check -- display date
		date_default_timezone_set('America/New_York');
		echo date('l jS \of F Y h:i:s A');
		
		echo "<h1>" . $module . "</h1>";
		
		// Name the suite
        $this->TestSuite('Module Test');
		
        /** ADD MODULES UNIT TESTS HERE **/
		$this->addFile( $executionFile );
    }
}


/**
assertTrue($x)	                Fail unless $x evaluates true
assertFalse($x)	                Fail unless $x evaluates false
assertNull($x)	                Fail unless $x is not set
assertNotNull($x)	        	Fail unless $x is set to something
assertIsA($x, $t)	        	Fail unless $x is the class or type $t
assertNotA($x, $t)	        	Fail unless $x is not the class or type $t
assertEqual($x, $y)	        	Fail unless $x == $y is true
assertNotEqual($x, $y)	        Fail unless $x == $y is false
assertWithinMargin($x, $y, $margin)	Fail unless $x and $y are separated less than $margin
assertOutsideMargin($x, $y, $margin)	Fail unless $x and $y are sufficiently different
assertIdentical($x, $y)	        Fail unless $x === $y for variables, $x == $y for objects of the same type
assertNotIdentical($x, $y)		Fail unless $x === $y is false, or two objects are unequal or different types
assertReference($x, $y)	        Fail unless $x and $y are the same variable
assertCopy($x, $y)	        	Fail unless $x and $y are the different in any way
assertSame($x, $y)	        	Fail unless $x and $y are the same objects
assertClone($x, $y)	        	Fail unless $x and $y are identical, but separate objects
assertPattern($p, $x)	        Fail unless the regex $p matches $x
assertNoPattern($p, $x)	        Fail if the regex $p matches $x
expectError($e)	                Triggers a fail if this error does not happen before the end of the test
expectException($e)	        	Triggers a fail if this exception is not thrown before the end of the test

*/

?>

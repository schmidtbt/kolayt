<?php
ob_start();
require_once('autoload.php');
error_reporting(E_ALL ^ E_DEPRECATED);
ini_set('display_errors', 1);
require_once('simpletest/autorun.php');
//require_once('autoload.php');







/**
 * @note These modules are referenced from the server root's /coretest directory, not from the
 * directory within the /php/includes module. This means that changes there must either be updated
 * to the SVN or copied over before they'll be reflected in the testing suites.
 */
class alltests extends TestSuite {
    	
		
	function dir_tree($dir) {
	   $path = '';
	   $stack[] = $dir;
	   while ($stack) {
	       $thisdir = array_pop($stack);
	       if ($dircont = scandir($thisdir)) {
	           $i=0;
	           while (isset($dircont[$i])) {
	               if ($dircont[$i] !== '.' && $dircont[$i] !== '..') {
	                   $current_file = "{$thisdir}/{$dircont[$i]}";
	                   if (is_file($current_file)) {
	                       $path[] = "{$thisdir}/{$dircont[$i]}";
	                   } elseif (is_dir($current_file)) {
	                        $path[] = "{$thisdir}/{$dircont[$i]}";
	                       $stack[] = $current_file;
	                   }
	               }
	               $i++;
	           }
	       }
	   }
	   return $path;
	}
			
		
		
    function __construct() {
        // call the parent constructor of the simpletest module
        parent::__construct();
		
		
		
		$modules = array();
		$all = ( $this->dir_tree( '/var/www/html/kore/trunk/unit/module' ) );
		foreach( $all as $a ){
			
			if( preg_match('/.unit.php/', $a) == true  && preg_match('/.svn/', $a) == false
			&& preg_match('/.zend\//', $a) == false ){
				$modules[] = $a;
			}
			
		}
		
		
		// Name the suite
        $this->TestSuite('All tests');
		
        //var_dump( file_exists( $_SERVER{'DOCUMENT_ROOT'} . '/coretest/module/Cell.unit.php' ) );
		//echo $_SERVER{'DOCUMENT_ROOT'};
		//var_dump( file_get_contents('module/Cell.unit.php') );
		
        /** ADD MODULES UNIT TESTS HERE **/
       foreach( $modules as $mod ){
       		$this->addFile($mod);
       }
        
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

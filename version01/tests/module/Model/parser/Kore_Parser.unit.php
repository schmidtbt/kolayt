<?php
require_once('Kore_autoload.php');
require_once('autorun.php');

class unit_Kore_Parser extends UnitTestCase {
	
	function test_Kore_Parser(){
		$kp = new Kore_Parser( "http://techcrunch.com/2012/01/02/chrome-edging-out-firefox/" );
		/*
		echo $kp->getTitle();
		echo $kp->getContent();
		echo $kp->getHostName();
		echo $kp->getSnippet();
		$kp->getImages();
		*/
	}
	
	function test_bad_Url(){
		$this->expectException("Kore_Parser_Exception");
		$kp = new Kore_Parser( "afwefslkj/.safe" );
	}
	
	function test_Kore_Parser2(){
		$kp = new Kore_Parser( "http://www.nytimes.com/2012/01/14/business/global/euro-zone-downgrades-expected.html?hp" );
		
		var_dump( $kp->getTitle() );
		echo $kp->getContent();
		echo $kp->getHostName();
		echo $kp->getSnippet();
		$kp->getImages();
	}
	
}

?>
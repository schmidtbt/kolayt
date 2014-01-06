<?php


class Kore_Domain_Tools implements iKore_Domain_Tools {
	
	
	private function __construct(){}
	
	public static function convertStringToHbaseKey( $string ){}
	public static function convertStringToHTMLUrl( $string ){}
	
	
	public static function isValidSectionName( $section_name ){
		if( is_string( $section_name ) & strlen( $section_name ) > 0 ){
			return true;
		} else {
			return false;
		}
	}
}

?>

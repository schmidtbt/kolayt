<?php

class Kore_Storage_Hbase_Element extends Kore_Storage_Hbase{
	
	protected $table = "elements";
	
	public function newElement( $section_name, $url, $title, $handle, $snippet, $imgArray = NULL ){
		
		// Check for existing User
		if( $this->checkKeyValueExists( self::compoundKey($section_name, $url) ) ){
			throw new Kore_Storage_Hbase_Exception( "Kore_Storage_Hbase_Element::newElement Element already exists" );
		}
		
		$changeRows = array(
			array( 'colfamily' => 'element', 'col' => 'url', 'value'	 	=> $url ),
			array( 'colfamily' => 'element', 'col' => 'title', 'value' 	=> $title ),
			array( 'colfamily' => 'element', 'col' => 'created', 'value' 	=> "" ),
			array( 'colfamily' => 'element', 'col' => 'creator', 'value' 	=> $handle ),
			array( 'colfamily' => 'element', 'col' => 'caption', 'value' 	=> $snippet ),
			array( 'colfamily' => 'element', 'col' => 'section', 'value' 	=> $section_name ),
		);
		
		// Populate Images
		if( is_array( $imgArray ) ){
			foreach( $imgArray as $img ){
				$changeRows[] = array( 'colfamily' => 'thumb', 'col' => $img, 'value' => "" ); 
			}
		}
		
		return $this->insertMultiColumns( self::compoundKey( $section_name , $url), $changeRows );
		
	}
	
	public static function compoundKey( $section_name, $url ){
		return $section_name . '+' . $url; 
	}
}

?>

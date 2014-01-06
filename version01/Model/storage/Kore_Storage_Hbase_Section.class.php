<?php

class Kore_Storage_Hbase_Section extends Kore_Storage_Hbase{
	
	protected $table = "sections";
	
	public function newSection( $section_name, $handle ){
		
		// Check for existing User
		if( $this->checkKeyValueExists( $section_name ) ){
			throw new Kore_Storage_Hbase_Exception( "Kore_Storage_Hbase_Section::newSection Section already exists: ".$section_name );
		}
		
		$changeRows = array(
			array( 'colfamily' => 'meta', 'col' => 'title', 'value' => $section_name ),
			array( 'colfamily' => 'meta', 'col' => 'creator', 'value' => $handle ),
			array( 'colfamily' => 'meta', 'col' => 'created', 'value' => "" )
		);
		
		return $this->insertMultiColumns( $section_name, $changeRows );
	}
	
	public function addSubscriber( $section_name ){
		return $this->incrementColumn( $section_name , "meta", 'subscribers', 1 );
	}
	
	public function removeSubscriber( $section_name ){
		return $this->incrementColumn( $section_name , "meta", 'subscribers', -1 );
	}
	
}

?>

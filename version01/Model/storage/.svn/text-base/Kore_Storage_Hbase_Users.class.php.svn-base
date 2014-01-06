<?php

class Kore_Storage_Hbase_Users extends Kore_Storage_Hbase {
	
	protected $table = "users";
	
	public function appendSectionList( $handle, $section_name, $value = "" ){
		return $this->insertColumnRecord( $handle, 'section_list', $section_name, '' );
	}
	
	public function removeSectionList( $handle, $section_name ){
		return $this->removeColumnRecord( $handle, 'section_list', $section_name );
	}
	
	public function changeToken( $handle, $newToken ){
		return $this->insertColumnRecord( $handle, 'meta', 'token', $newToken );
	}
	
	public function insertNewUser( $email, $first, $last, $handle ){
		
		// Check for existing User
		if( ( $this->checkKeyValueExists($handle) ) ){
			throw new Kore_Storage_Hbase_Exception( "Kore_Storage_Hbase_Users::insertNewUser Handle Already Exists: ".$handle );
		}
		
		$changeRows = array(
			array( 'colfamily' => 'meta', 'col' => 'email', 'value' => $email ),
			array( 'colfamily' => 'meta', 'col' => 'first', 'value' => $first ),
			array( 'colfamily' => 'meta', 'col' => 'last', 'value' => $last ),
		);
		
		return $this->insertMultiColumns( $handle, $changeRows );
	}
	
}

?>

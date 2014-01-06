<?php

class Kore_Storage_Hbase_List_Time extends Kore_Storage_Hbase_Element_List {
	
	protected $table = "list_time";
	
	public function newHistoryRecord( $url, $title, $section_name, $snippet, $handle, $imgArray ){
		
		$changeRows = array(
			array( 'colfamily' => 'element', 'col' => 'url', 'value'	 	=> $url ),
			array( 'colfamily' => 'element', 'col' => 'title', 'value' 		=> $title ),
			array( 'colfamily' => 'element', 'col' => 'created', 'value' 	=> "" ),
			array( 'colfamily' => 'element', 'col' => 'creator', 'value' 	=> $handle ),
			array( 'colfamily' => 'element', 'col' => 'caption', 'value' 	=> $snippet ),
			array( 'colfamily' => 'element', 'col' => 'section', 'value' 	=> $section_name ),
		);
		
		// Populate First Image Only
		if( is_array( $imgArray ) & sizeof( $imgArray ) > 0 ){
			$changeRows[] = array( 'colfamily' => 'element', 'col' => 'thumb', 'value' => $imgArray[0] );
		}
		
		return $this->insertMultiColumns( self::compoundKey( $section_name , time()), $changeRows );
	}
	
	/**
	 * @param $rand Allow another append to the key in the event two elements are uploaded with the same time-stamp. Reduces over-write collision chances
	 */
	public static function compoundKey( $section_name, $time, $rand = "" ){
		
		if( ! Kore_Domain_Tools::isValidSectionName($section_name) ){
			throw new Kore_Storage_Hbase_Exception("Kore_Storage_Hbase_List_Time::compoundKey Attempted to genereate key using invalid section name: >" . $section_name . "<" );
		}
			
		$key = $section_name . '+' . self::invertTime($time);
		
		if( $rand !== "" ){
			$key .= '+' . $rand;
		}
		
		return $key;
	}
	
}

?>

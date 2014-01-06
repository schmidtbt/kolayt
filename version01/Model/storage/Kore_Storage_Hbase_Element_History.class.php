<?php

class Kore_Storage_Hbase_Element_History extends Kore_Storage_Hbase {
	
	protected $table = "element_history";
	
	/**
	 * @param $vote BOOL
	 */
	public function newVote( $section_name, $url, $handle, $vote ){
		
		if( !is_bool( $vote ) ){
			$vote = true;
		}
		
		$vote = $vote ? 1 : 0;
		
		$changeRows = array(
			array( 'colfamily' => 'type', 'col' => 'type', 'value'	 	=>  $vote ),
			array( 'colfamily' => 'meta', 'col' => 'handle', 'value' 		=> $handle )
		);
		
		return $this->insertMultiColumns( self::compoundKey( $section_name , $url, time() ), $changeRows );
		
	}
	
	public static function compoundKey( $section_name, $url, $time, $rand = "" ){
		
		if( ! Kore_Domain_Tools::isValidSectionName($section_name) ){
			throw new Kore_Storage_Hbase_Exception("Kore_Storage_Hbase_Element_History::compoundKey Attempted to genereate key using invalid section name: >" . $section_name . "<" );
		}
		
		$key = $section_name . '+' . $url . '+' . self::invertTime($time);
		
		if( $rand !== "" ){
			$key .= '+' . $rand;
		}
		
		return $key;
	}
	
}

?>

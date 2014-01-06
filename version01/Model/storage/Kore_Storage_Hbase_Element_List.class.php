<?php

class Kore_Storage_Hbase_Element_List extends Kore_Storage_Hbase {
	
	protected $section_name;
	
	public function setSection( $section_name ){
		$this->section_name = $section_name;
	}
	public function getNumRows( $numRows ){
		return $this->scanRowsPrefix( $this->section_name, array(), $numRows);
	}
}

?>

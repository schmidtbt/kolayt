<?php

class Kore_Domain_Section_List extends Kore_Domain {
	
	protected $elementList;
	protected $section;
	protected $defaultElementCount;
	
	const TIMEORDER 	= 0;
	const SCOREORDER 	= 1;
	
	/**
	 * @brief Organized by and set default
	 */
	protected $organizedBy = 'time';
	
	
	public function __construct( Kore_Domain_Section $section ){
		$this->section = $section;
		// Use Config to set default element count
		$this->defaultElementCount = Kore_Config::getConfig()->sections->defaultelementcount;
	}
	
	/**
	 * @warning This function does not check for correct order types
	 */
	public function setOrder( $orderType ){
		$this->organizedBy = $orderType;
		return $this;
	}
	
	
	public function getElements( $numRows = 0, $startIdx = 0){
		
		$numRows = ( is_numeric( $numRows ) & $numRows > 0 ) ? $numRows : $this->defaultElementCount;
		
		switch( $this->organizedBy ){
			case Kore_Domain_Section_List::TIMEORDER:
				$hbase = new Kore_Storage_Hbase_List_Time();
				break;
			case Kore_Domain_Section_List::SCOREORDER:
				$hbase = new Kore_Storage_Hbase_List_Score();
				break;
			default:
				throw new Kore_Domain_Section_List_Exception("Kore_Domain_Section_List::getElements Invalid OrganizedBy paramter: " . $this->organizedBy);
		}
		
		$hbase->setSection( $this->section->getSectionName() );
		
		$this->elementList = $hbase->getNumRows( $numRows );
		return $this->elementList;
	}
	
	/**
	 * @return IterElementList for dynamic creation of Kore_Domain_Element objects from TRowResult objects returned
	 */
	public function elementList(){
		if( $this->isPopulated() ){
			$iel = new IterElementList( $this->elementList );
			return $iel;
		} else {
			throw new Kore_Domain_Section_List_Exception("Kore_Domain_Section_List::elementList Attempted to access unitilialized list");
		}
	}
	
	public function getNumberElements(){
		if( $this->isPopulated() ){
			return sizeof( $this->elementList );
		} else {
			throw new Kore_Domain_Section_List_Exception("Kore_Domain_Section_List::getNumberElements Attempted to access unitilialized list");
		}
	}
	
	public function isOrganizedByTime(){
		return( $this->organizedBy === self::TIMEORDER );
	}
	public function isOrganizedByScore(){
		return( $this->organizedBy === self::SCOREORDER );
	}
	
	
	public function isPopulated(){
		if( is_array($this->elementList) ){
			$valid = true;
			
			foreach( $this->elementList as $el ){
				if( !( $el instanceof TRowResult ) ){
					$valid = false;
					break; 
				}
			}	
			
			return $valid;
		} else {
			return false;
		}
	}
	
}



class IterElementList extends ArrayIterator{
	
	public function current( ){
		$val = parent::current();
		//var_dump( $val );
		$e = new Kore_Domain_Element();
		$e->populate($val );
		return $e;
		 
	}
	
	public function offsetGet( $index ){
		$val = parent::offsetGet( $index );
		//var_dump( $val );
		$e = new Kore_Domain_Element();
		$e->populate($val );
		return $e;
	}
	
}


?>
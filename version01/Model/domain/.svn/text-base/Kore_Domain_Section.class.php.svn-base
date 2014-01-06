<?php
/**
 * @todo Remove the compoundKey dependency
 * 
 * @ingroup ModelIf
 */
class Kore_Domain_Section extends Kore_Domain implements iKore_Domain_Section {
	
	protected $data;
	protected $section_name;
	
	/**
	 * @todo Change to allow the Kore_Domain_Section::setSection() method to be called on construction
	 * @todo Remove the config
	 */
	public function __construct(){}
	public function setSection( $section_name ){
		$this->section_name;
	}
	/**
	 * @return Section Name
	 */
	public function getSectionName(){
		if( $this->isPopulated() ){
			return static::getColValue( $this->data, "meta:title");
		}
	}
	public function getCreator(){
		if( $this->isPopulated() ){
			return static::getColValue( $this->data, "meta:creator");
		}
	}
	public function getCreatedAt(){
		if( $this->isPopulated() ){
			return static::getColValueTs( $this->data, "meta:created");
		}
	}
	public function getNumberOfSubscribers(){
		if( $this->isPopulated() ){
			$btyeCounter = static::getColValue( $this->data, "meta:subscribers");
			return static::btyeArrayToInt( $btyeCounter );
		}
	}
	public function addSubscriber(){
		if( isset( $this->section_name ) ){
			$hbase = new Kore_Storage_Hbase_Section();
			$raw = $hbase->addSubscriber( $this->compoundKey( $this->section_name ) );
		}
	}
	public function removeSubscriber(){
		if( isset( $this->section_name ) ){
			$hbase = new Kore_Storage_Hbase_Section();
			$raw = $hbase->removeSubscriber( $this->compoundKey( $this->section_name ) );
		}
	}
	public function newSection( $sectionName, Kore_Domain_User $creator ){
		$hbase = new Kore_Storage_Hbase_Section();
		return $hbase->newSection( $sectionName, $creator->getHandle() );
	}
	
	/**
	 * @return Populate this Kore_Domain_Section from Hbase
	 * @todo Change to not require $section_name as a param (use built-in variable)
	 */
	public function getSectionMain( $section_name ){
		$hbase = new Kore_Storage_Hbase_Section();
		$raw = $hbase->fetchRecordValueOnKey( $this->compoundKey( $section_name ) );
		if( isset( $raw[0] ) ){
			$this->data = $raw[0];
			$this->section_name = $section_name;
			if( $this->isPopulated() ){ return true; }
		}
	}
		
	
	/**
	 * @name Section Utilities
	 */
	//@{
	protected function compoundKey( $section_name ){
		return $section_name;
	}
	
	
	public function isPopulated(){
		if( $this->data instanceof TRowResult ){
			return true;
		} else {
			return false;
		}
	}
	//@}
}

?>
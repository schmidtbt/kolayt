<?php
/**
 * @brief Stores and Sub-sequently retrieves URL basic data in HBase
 * 
 * Use for generating content onto more specific "Section" objects (Kore_Domain_Section)
 *
 * @ingroup Model
 */
class Kore_Domain_URL extends Kore_Domain implements iKore_Domain_URL {
	
	protected $url;
	protected $data;
	
	public function __construct(){}
	
	/**
	 * @return NULL on no URL found
	 */
	public function fetchURL( $url ){
		$hbase = new Kore_Storage_Hbase_URLs();
		$raw = $hbase->fetchRecordValueOnKey( $url );
		if( isset( $raw[0] ) ){
			$this->data = $raw[0];
			if( $this->isPopulated() ){ return true; }
		}
	}
	
	public function getRawContent(){
		if( $this->isPopulated() ){
			return static::getColValue( $this->data, "raw:html");
		}
	}
	public function getParsedContent(){
		if( $this->isPopulated() ){
			return static::getColValue( $this->data, "parsed:html");
		}
	}
	public function getParsedSnippet(){
		return "TO DO";
	}
	public function getURL(){
		if( $this->isPopulated() ){
			return static::getColValue( $this->data, "meta:url");
		}
	}
	public function getTitle(){
		if( $this->isPopulated() ){
			return static::getColValue( $this->data, "meta:title");
		}
	}
	public function getHostDomain(){
		if( $this->isPopulated() ){
			return static::getColValue( $this->data, "meta:host");
		}
	}
	public function getImages(){
		if( $this->isPopulated() ){
			$family = static::getColFamily( $this->data, "thumbs");
			return static::getColNamesWithinFamily( $family );
		}
	}
	
	/**
	 * @todo Security Check for invalid URLs and internal URLs
	 * @throws Kore_Domain_Exception If URL already exists
	 * @throws Kore_Domain_Exception If fail to parse url (stacked with Kore_Parser_Exception)
	 */
	public function insertNewURL( $url ){
		$hbase = new Kore_Storage_Hbase_URLs();
		
		if( $hbase->checkKeyValueExists($url) ){
			throw new Kore_Domain_Exception( "Kore_Domain_URL::insertNewURL URL already exists" );
		}
		
		// Generate and use the parser
		try{
			$parser = new Kore_Parser( $url );
		} catch ( Kore_Parser_Exception $e ){
			throw Kore_Domain_Exception("Kore_Domain_URL::insertNewURL Failed to Parse URL ",0, $e );
		}
		
		return $hbase->newURL($url, $parser->getTitle(), $parser->getContent(), $parser->getImages() );
	}
	
	public function isPopulated(){
		if( $this->data instanceof TRowResult ){
			return true;
		} else {
			return false;
		}
	}
	
}

?>

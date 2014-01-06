<?php

class Kore_Storage_Hbase_URLs extends Kore_Storage_Hbase {
	
	protected $table = "urls";
	
	/**
	 * @todo Remove the $url reliance and instead pass the individual fields. This method should perform processing. That 
	 * is the realm of the Domain objects
	 */
	public function newURL( $url, $title, $content, $thumbs ){
		
		
		// Check for existing User
		if( $this->checkKeyValueExists($url) ){
			throw new Kore_Storage_Hbase_Exception( "Kore_Storage_Hbase_URLs::newURL URL already exists... This should have been checked already" );
		}
		/*
		try{
			$parser = new Kore_Parser( $url );
		} catch ( Kore_Parser_Exception $e ){
			throw Kore_Storage_Hbase_Exception("Kore_Storage_Hbase_URLs::newURL Failed to Parse URL ",0, $e );
		}
		
		*/
		$changeRows = array(
			array( 'colfamily' => 'meta', 'col' => 'url', 'value' => $url ),
			array( 'colfamily' => 'meta', 'col' => 'title', 'value' => $title ),
			array( 'colfamily' => 'meta', 'col' => 'uploadedAt', 'value' => "" ),
			array( 'colfamily' => 'raw', 'col' => 'html', 'value' => "" ),	// replace with $parser->getRaw() to store massive amts of data
			array( 'colfamily' => 'parsed', 'col' => 'html', 'value' => $content )
		);
		
		if( is_array( $thumbs ) && sizeof( $thumbs ) > 0 ){
			foreach( $thumbs as $thumb ){
				$changeRows[] = array( 'colfamily' => 'thumbs', 'col' => $thumb, 'value' => "" );
			}
		}
		return $this->insertMultiColumns( $url, $changeRows );
	}
	
}

?>

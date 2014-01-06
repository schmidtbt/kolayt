<?php

class KoreException extends Exception {
	
	public function printRecursive(){
		$string = "ERROR: " . $this->getMessage() . "\n" ;
		if( $this->getPrevious() ){
			$string .= $this->getPrevious()->getMessage() . "\n";
		}
		echo $string;
		return $this;
	}
	
	public function log(){
		error_log( $this->getMessage() );
	}
	
}

class Kore_Pipe_Exception extends KoreException{}

class Kore_Data_Exception extends KoreException{}
class Kore_Data_S3_Exception extends Kore_Data_Exception{}

class Kore_Command_Mapper_Exception extends KoreException{}


class Kore_Domain_Exception extends KoreException{}
class Kore_Domain_User_Exception extends Kore_Domain_Exception{}
class Kore_Domain_URL_Exception extends Kore_Domain_Exception{}
class Kore_Domain_Section_List_Exception extends Kore_Domain_Exception{}

class Kore_Storage_Exception extends KoreException{}
class Kore_Storage_S3_Exception extends Kore_Storage_Exception{}
class Kore_Storage_Hbase_Exception extends KoreException{}

class Kore_Parser_Exception extends KoreException{}

class Kore_View_Exception extends KoreException{}








function CatchableError( $errno, $errstr, $errfile, $errline ){
	if ( E_RECOVERABLE_ERROR===$errno ) {
	  	throw new KoreException($errstr );
	  	// return true;
  	}
	return false;
}

set_error_handler( "CatchableError" );


?>
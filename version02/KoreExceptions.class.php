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

class APP_EXCEPTION extends KoreException{}
class APP_AUTH_EXCEPTION extends APP_EXCEPTION{}
class APP_AUTH_BAD_CREDS extends APP_EXCEPTION{}
class APP_AUTH_NO_TOKEN extends APP_AUTH_EXCEPTION{}
class APP_AUTH_NO_COOKIE extends APP_AUTH_EXCEPTION{}
class APP_AUTH_MUST_BE_LOGGED_OUT extends APP_AUTH_EXCEPTION{}
class APP_API_EXCEPTION extends APP_EXCEPTION{}
class APP_MISSING_PARAMS extends APP_EXCEPTION{}


class UNINITIALIZED extends KoreException{}
class RECORD_EXISTS extends KoreException{}
class RECORD_DOES_NOT_EXIST extends KoreException{}
class ENTRY_EXISTS extends KoreException{}

class GRAPH_EXCEPTION extends KoreException{}
class GRAPH_LOGIC_EXCEPTION extends GRAPH_EXCEPTION{}
class GRAPH_COMPLIANCE_EXCEPTION extends GRAPH_EXCEPTION{}
class GRAPH_STORAGE_EXCEPTION extends GRAPH_EXCEPTION{}
class GRAPH_ENTITY_DOES_NOT_EXIST extends GRAPH_EXCEPTION{}
class GRAPH_ENTITY_EXISTS extends GRAPH_EXCEPTION{}
class GRAPH_TRANSACTION_FAILURE extends GRAPH_EXCEPTION{}

class GRAPH_ACTION_EXCEPTION extends GRAPH_EXCEPTION{}

class HBASE_EXCEPTION extends KoreException{}

class CAC_EXCEPTION extends KoreException{}
class CAC_ROUTE_FAILURE extends CAC_EXCEPTION{}

class PUBSUB_EXCEPTION extends KoreException{}
class PUBSUB_QUIT extends PUBSUB_EXCEPTION {}
class PUBSUB_RETRY extends PUBSUB_EXCEPTION {}

class PIPE_EXCEPTION extends KoreException {}
class PIPE_BAD_URL extends PIPE_EXCEPTION {}

class AMAZON_S3_EXCEPTION extends KoreException{}

class Cmd_Exception extends KoreException{}
class CmdE_MissingParam extends KoreException{}
class CmdE_BadParamValue extends KoreException{}
class CmdE_NotLoggedIn extends KoreException{}
class CmdE_BadToken extends KoreException{}
class CmdE_BadAPIAccess extends KoreException{}
class CmdE_IsLoggedIn extends KoreException{}
class CmdE_LoginCredFailure extends KoreException{}
class CmdE_FailURLUpload extends KoreException{}
class CmdE_AlreadyValidated extends KoreException{}
class CmdE_UserValidationFailed extends KoreException{}
class CmdE_AlreadyLoggedIn extends KoreException{}


class CmdE_SectionNotExist extends KoreException{}
class CmdE_ElementNotExist extends KoreException{}
class CmdE_UserNotExist extends KoreException{}

class Kore_Set_Exception extends KoreException{}
class Kore_Auth_Exception extends KoreException{}

class Kore_Pipe_Exception extends KoreException{}

class Kore_Data_Exception extends KoreException{}
class Kore_Data_S3_Exception extends Kore_Data_Exception{}

class Kore_Command_Mapper_Exception extends KoreException{}

class Kore_Hbase_Exception extends KoreException{}

class Kore_Domain_Exception extends KoreException{}
class Kore_Domain_User_Exception extends Kore_Domain_Exception{}
class Kore_Domain_User_Handle_Exists extends Kore_Domain_User_Exception{}
class Kore_Domain_User_Email_Exists extends Kore_Domain_User_Exception{}

class Kore_Domain_URL_Exception extends Kore_Domain_Exception{}
class Kore_Domain_Section_List_Exception extends Kore_Domain_Exception{}

class Kore_Storage_Exception extends KoreException{}
class Kore_Storage_S3_Exception extends Kore_Storage_Exception{}
class Kore_Storage_Hbase_Exception extends KoreException{}

class Kore_Parser_Exception extends KoreException{}

class Kore_View_Exception extends KoreException{}

class Kore_Context_Exception extends KoreException{}


assert_options(ASSERT_ACTIVE, 1);
function KoreAssertHandler($file, $line, $code){
	echo "<hr>Assertion Failed:
        File '$file'<br />
        Line '$line'<br />
        Code '$code'<br /><hr />";
}
assert_options(ASSERT_CALLBACK, 'KoreAssertHandler');

/**
 * Send message to the kore logs on this system
 * 
 * @note Appends a \n to each message
 */
function elog( $msg = "" ){
	error_log( date("m.d.y h:i:s A") . session_id() . ": " . $msg . "\n", 3, 'var/log/httpd/kore.log' );
}

function CatchableError( $errno, $errstr, $errfile, $errline ){
	if ( E_RECOVERABLE_ERROR===$errno ) {
	  	throw new KoreException( $errstr );
	  	// return true;
  	}
	return false;
}

set_error_handler( "CatchableError" );

?>